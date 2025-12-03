<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Admin\Auth\AdminLoginService;
use App\Http\Requests\Auth\Admin\AdminLoginFormRequest;


class AdminLoginController extends Controller
{
    public function __construct(
        protected AdminLoginService $loginService
    ){}

    public function showLoginForm():View
    {
        $title = 'EPTHAA AGRO LIMITED | Admin Login';
        $description = 'Ken admin login page';
        $keywords = 'login, signin, account';

        return view('admin.auth.login', compact('title', 'description', 'keywords'));
    }

    public function login(AdminLoginFormRequest $request):RedirectResponse
    {
        $response = $this->loginService->login($request);
        if ($response->status) {
            return redirect()->intended(route('admin.dashboard'))->with('success', $response->message);
        }
        return back()->withInput($request->only('email'))->with('error', $response->message);
    }
}
