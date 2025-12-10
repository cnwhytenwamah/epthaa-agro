<?php

namespace App\Http\Controllers\FrontPages\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Services\User\Auth\PasswordResetService;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;

class UserForgotPasswordController extends BaseController
{
    public function __construct(
        protected PasswordResetService $passwordResetService,
    ){}

    public function showForgotPasswordForm():View
    {
        $title = 'Forgot Password';
        $description = 'Reset your password via email';
        $keywords = 'forgot password, reset, email';

        return view('user.auth.forgot-password', compact('title', 'description', 'keywords'));
    }

    public function sendResetLink(ForgotPasswordFormRequest $request):RedirectResponse
    {
        $response = $this->passwordResetService->forgotPassword($request);
        if ($response->status === 200) {
            return redirect()->back()->with('success', $response->message);
        }
        return redirect()->back()->withErrors(['email' => $response->message]);
    }
}
