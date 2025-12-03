<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\ForgotPasswordFormRequest;
use App\Services\Auth\Admin\AdminPasswordResetService;

class AdminForgotPasswordController extends Controller
{
    public function __construct(
        protected AdminPasswordResetService $passwordResetService,
    ){}

    public function showForgotPasswordForm():View
    {
        $title = 'Forgot Password';
        $description = 'Reset your password via email';
        $keywords = 'forgot password, reset, email';

        return view('admin.auth.forgot-password', compact('title', 'description', 'keywords'));
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
