<?php

namespace App\Services\User;

use stdClass;
use Exception;
use App\Dto\WithdrawalDto;
use App\Http\Requests\WithdrawalFormRequest;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Interfaces\WithdrawalRepositoryInterface;

class WithdrawalService extends UserBaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected WithdrawalRepositoryInterface $withdrawalsRepository
    ){}

    /**
     * Handle new withdrawal request
     */
    public function create(WithdrawalFormRequest $request): stdClass
    {
        try {
            $user = $request->user();
            $validated = $request->validated();
            $WithdrawalDto = WithdrawalDto::formData($request);

            $available_balance = $user->available_balance ?? 0;
            $amount = $WithdrawalDto->amount;

            // Basic validation logic
            if ($amount < 50) {
                return $this->errorMsg("Minimum withdrawal amount is $50.00", 422);
            }

            if ($amount > $available_balance) {
                return $this->errorMsg("Insufficient balance. Available: $" . number_format($available_balance, 2), 422);
            }

            $data = array_merge($WithdrawalDto->toArray(), [
                'user_id' => $user->id,
                'status' => 'pending',
            ]);

            $response = $this->withdrawalsRepository->create($data);

            if (!$response) {
                return $this->errorMsg("An error occurred while processing your withdrawal request, please try again.", 422);
            }

            // Deduct amount from user's available balance (if logic is handled here)
            $user->available_balance -= $amount;
            $user->pending_withdrawals += $amount;
            $user->save();

            return $this->successMsg("Withdrawal request submitted successfully and is pending approval.");

        } catch (HttpException $e) {
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            return $this->errorMsg("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }

    /**
     * Update withdrawal status or details
     */
    public function update(WithdrawalFormRequest $request): stdClass
    {
        try {
            $validated = $request->validated();
            $id = $validated['id'];

            // $withdrawal = $this->withdrawalsRepository->find($id);
            // if (!$withdrawal) {
            //     return $this->errorMsg("Invalid withdrawal ID, please check and try again.", 422);
            // }

            $WithdrawalDto = WithdrawalDto::formData($request);
            $data = $WithdrawalDto->toArray();

            // $response = $this->withdrawalsRepository->update($withdrawal, $data);

            // if (!$response) {
            //     return $this->errorMsg("An error occurred while updating the withdrawal request, please try again.", 422);
            // }

            return $this->successMsg("Withdrawal request updated successfully.");

        } catch (HttpException $e) {
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            return $this->errorMsg("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }

    /**
     * List all withdrawals (admin or user view)
     */
    // public function list(): stdClass
    // {
    //     $withdrawals = $this->withdrawalsRepository->listWithdrawals();
    //     return $this->successMsg("Withdrawals retrieved successfully", $withdrawals);
    // }

    /**
     * List withdrawals belonging to a single user
     */
    public function listUserWithdrawals(?int $userId = null): Collection
    {
        $userId = $userId ?? $this->userId;
        return $this->withdrawalsRepository->listUserWithdrawals($userId);
    }

    /**
     * Single withdrawal details
     */

    // public function singleWithdrawal(int $id): Withdrawal
    // {
    //     return $this->withdrawalsRepository->find($id);
    // }

    /**
     * Total withdrawal records (for dashboard stats)
     */

    // public function totalRecords(): int
    // {
    //     return $this->withdrawalsRepository->totalRecords();
    // }


    public function listAllWithdrawals(): Collection
    {
        return $this->withdrawalsRepository->listAllWithdrawals();
    }

    /**
     * Get withdrawal by ID (admin access)
     */
    public function getWithdrawalById(int $id): ?object
    {
        return $this->withdrawalsRepository->find($id);
    }

    /**
     * Approve withdrawal request (admin only)
     */
    public function approveWithdrawal(int $id): stdClass
    {
        try {
            $withdrawal = $this->withdrawalsRepository->find($id);
            
            if (!$withdrawal) {
                return $this->errorMsg("Withdrawal request not found.", 404);
            }

            if ($withdrawal->status !== 'pending') {
                return $this->errorMsg("Only pending withdrawals can be approved.", 422);
            }

            // Update withdrawal status to approved
            $updated = $this->withdrawalsRepository->update($withdrawal, [
                'status' => 'approved',
                'approved_at' => now(),
            ]);

            if (!$updated) {
                return $this->errorMsg("Failed to approve withdrawal request.", 422);
            }

            return $this->successMsg("Withdrawal request approved successfully.");

        } catch (HttpException $e) {
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            return $this->errorMsg("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }

    /**
     * Reject withdrawal request (admin only)
     */
    public function rejectWithdrawal(int $id, ?string $reason = null): stdClass
    {
        try {
            $withdrawal = $this->withdrawalsRepository->find($id);
            
            if (!$withdrawal) {
                return $this->errorMsg("Withdrawal request not found.", 404);
            }

            if ($withdrawal->status !== 'pending') {
                return $this->errorMsg("Only pending withdrawals can be rejected.", 422);
            }

            // Get the user to refund the amounts
            $user = $withdrawal->user;
            
            // Refund the amounts back to user
            $user->available_balance += $withdrawal->amount;
            $user->pending_withdrawals -= $withdrawal->amount;
            $user->save();

            // Update withdrawal status to rejected
            $updated = $this->withdrawalsRepository->update($withdrawal, [
                'status' => 'rejected',
                'rejected_at' => now(),
                'rejection_reason' => $reason,
            ]);

            if (!$updated) {
                return $this->errorMsg("Failed to reject withdrawal request.", 422);
            }

            return $this->successMsg("Withdrawal request rejected and funds refunded to user.");

        } catch (HttpException $e) {
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            return $this->errorMsg("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }

    /**
     * Mark withdrawal as completed (admin only)
     */
    public function completeWithdrawal(int $id, ?string $transactionHash = null): stdClass
    {
        try {
            $withdrawal = $this->withdrawalsRepository->find($id);
            
            if (!$withdrawal) {
                return $this->errorMsg("Withdrawal request not found.", 404);
            }

            if ($withdrawal->status !== 'approved') {
                return $this->errorMsg("Only approved withdrawals can be marked as completed.", 422);
            }

            // Get the user to update pending withdrawals
            $user = $withdrawal->user;
            $user->pending_withdrawals -= $withdrawal->amount;
            $user->save();

            // Update withdrawal status to completed
            $updated = $this->withdrawalsRepository->update($withdrawal, [
                'status' => 'completed',
                'completed_at' => now(),
                'transaction_hash' => $transactionHash,
            ]);

            if (!$updated) {
                return $this->errorMsg("Failed to complete withdrawal request.", 422);
            }

            return $this->successMsg("Withdrawal marked as completed successfully.");

        } catch (HttpException $e) {
            return $this->errorMsg($e->getMessage(), $e->getStatusCode());
        } catch (Exception $e) {
            return $this->errorMsg("An unexpected error occurred: " . $e->getMessage(), 500);
        }
    }

    /**
     * Get withdrawal statistics (admin dashboard)
     */
    public function getWithdrawalStats(): array
    {
        try {
            $stats = [
                'total_withdrawals' => $this->withdrawalsRepository->countByStatus(),
                'pending_amount' => $this->withdrawalsRepository->sumByStatus('pending'),
                'approved_amount' => $this->withdrawalsRepository->sumByStatus('approved'),
                'completed_amount' => $this->withdrawalsRepository->sumByStatus('completed'),
                'rejected_amount' => $this->withdrawalsRepository->sumByStatus('rejected'),
            ];

            return $stats;

        } catch (Exception $e) {
            return [];
        }
    }
}
