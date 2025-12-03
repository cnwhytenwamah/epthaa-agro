<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Auth\PasswordResetService;
use App\Http\Requests\Auth\ResetPasswordFormRequest;
use App\Services\Auth\Admin\AdminPasswordResetService;

class AdminResetPasswordController extends Controller
{
    public function __construct(
        protected AdminPasswordResetService $passwordResetService,
    ){}

    public function showResetPasswordForm(string $token):View
    {
        $title = 'Reset Password';
        $description = 'Choose a new password';
        $keywords = 'reset password, new password';

        return view('admin.auth.reset-password', compact('title', 'description', 'keywords', 'token'));
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
