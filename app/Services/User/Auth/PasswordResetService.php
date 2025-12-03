<?php

namespace App\Services\User\Auth;

use stdClass;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ResetPasswordFormRequest;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;

class PasswordResetService extends BaseService
{
    /**
     * Handle forgot password (send reset link to email).
     */
    public function forgotPassword(ForgotPasswordFormRequest $request): stdClass
    {
        $validated = $request->validate();
        $email = $validated['email'];
        $status = Password::broker('users')->sendResetLink(['email' => $email]);

        if ($status === Password::RESET_LINK_SENT) {
            return $this->successMsg(__($status));
        }

        return $this->errorMsg(__($status), 422);
    }

    /**
     * Handle reset password (using token + new password).
     */
    public function resetPassword(ResetPasswordFormRequest $request): stdClass
    {
        $data = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::broker('users')->reset(
            $data,
            function (User $user, string $password) {
                $this->updatePassword($user, $password);
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return $this->successMsg(__($status));
        }

        return $this->errorMsg(__($status), 422);
    }

    /**
     * Update user password.
     */
    private function updatePassword($user, string $password): void
    {
        $user->forceFill([
            'password'       => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));
    }
}
