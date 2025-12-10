<?php

namespace App\Http\Controllers\FrontPages\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Services\User\Auth\PasswordResetService;
use App\Http\Requests\Auth\ResetPasswordFormRequest;

class UserResetPasswordController extends BaseController
{
    public function __construct(
        protected PasswordResetService $passwordResetService,
    ){}

    public function showResetPasswordForm(string $token):View
    {
        $title = 'Reset Password';
        $description = 'Choose a new password';
        $keywords = 'reset password, new password';

        return view('user.auth.reset-password', compact('title', 'description', 'keywords', 'token'));
    }

    public function resetPassword(ResetPasswordFormRequest $request):RedirectResponse
    {
        $response = $this->passwordResetService->resetPassword($request);
        if ($response->status) {
            return redirect()->route('login')->with('success', $response->message);
        }
        return back()->with('error', $response->message)->withInput();
    }
}
