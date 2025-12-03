<?php

namespace App\Services\User;

use App\Models\Deposit;
use App\Models\User;
use App\Services\User\UserBaseService;
use Illuminate\Support\Facades\DB;

class DepositService extends UserBaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    /**
     * Get all deposits (Admin only)
     */
    public function getAllDeposits($status = null)
    {
        $query = Deposit::with(['user'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate(20);
    }

    /**
     * Get deposits by user
     */
    public function getUserDeposits(User $user)
    {
        return Deposit::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    /**
     * Get deposit by ID
     */
    public function getDepositById($id)
    {
        return Deposit::with(['user'])->findOrFail($id);
    }

    /**
     * Create a new deposit (User action)
     */
    public function createDeposit(User $user, array $data)
    {
        return DB::transaction(function () use ($user, $data) {
            return Deposit::create([
                'user_id' => $user->id,
                'plan' => $data['plan'],
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'] ?? null,
                'status' => 'pending',
                'transaction_id' => $this->generateTransactionId(),
            ]);
        });
    }

    /**
     * Approve deposit (Admin action)
     */
    public function approveDeposit($depositId, User $admin)
    {
        return DB::transaction(function () use ($depositId, $admin) {
            $deposit = Deposit::findOrFail($depositId);

            if ($deposit->status !== 'pending') {
                throw new \Exception('Only pending deposits can be approved');
            }

            $deposit->update([
                'status' => 'approved',
                'approved_by' => $admin->id,
                'approved_at' => now(),
            ]);

            // Credit user's account
            $this->creditUserAccount($deposit);

            return $deposit;
        });
    }

    /**
     * Reject deposit (Admin action)
     */
    public function rejectDeposit($depositId, User $admin, $reason = null)
    {
        return DB::transaction(function () use ($depositId, $admin, $reason) {
            $deposit = Deposit::findOrFail($depositId);

            if ($deposit->status !== 'pending') {
                throw new \Exception('Only pending deposits can be rejected');
            }

            $deposit->update([
                'status' => 'rejected',
                'rejected_by' => $admin->id,
                'rejected_at' => now(),
                'rejection_reason' => $reason,
            ]);

            return $deposit;
        });
    }

    /**
     * Credit user's account after approval
     */
    protected function creditUserAccount(Deposit $deposit)
    {
        $user = $deposit->user;
        
        // Calculate bonus based on plan
        $bonus = $this->calculateBonus($deposit->plan, $deposit->amount);
        $totalCredit = $deposit->amount + $bonus;

        // Update user balance
        $user->increment('balance', $totalCredit);

        // Log transaction
        $user->transactions()->create([
            'type' => 'deposit',
            'amount' => $totalCredit,
            'description' => "Deposit approved: {$deposit->plan}",
            'reference' => $deposit->transaction_id,
        ]);
    }

    /**
     * Calculate bonus based on plan
     */
    protected function calculateBonus($plan, $amount)
    {
        $bonusPercentages = [
            'Starter Plan' => 0.10,
            'Basic Plan' => 0.15,
            'Pro Plan' => 0.20,
            'Executive Plan' => 0.25,
        ];

        $percentage = $bonusPercentages[$plan] ?? 0;
        return $amount * $percentage;
    }

    /**
     * Generate unique transaction ID
     */
    protected function generateTransactionId()
    {
        return 'DEP-' . strtoupper(uniqid()) . '-' . time();
    }

    /**
     * Get deposit statistics (Admin)
     */
    public function getDepositStats()
    {
        return [
            'total_deposits' => Deposit::count(),
            'pending_deposits' => Deposit::where('status', 'pending')->count(),
            'approved_deposits' => Deposit::where('status', 'approved')->count(),
            'rejected_deposits' => Deposit::where('status', 'rejected')->count(),
            'total_amount' => Deposit::where('status', 'approved')->sum('amount'),
        ];
    }
}