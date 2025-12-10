<?php

namespace App\Http\Controllers\FrontPages\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Services\User\Auth\LoginService;
use App\Http\Requests\Auth\User\LoginFormRequest;

class UserLoginController extends BaseController
{
    public function __construct(
        protected LoginService $loginService
    ){}

    public function showLoginForm():View
    {
        $title = 'Eptha-Agro Limited | User Login';
        $description = 'Eptha-Agro Limited admin login page';
        $keywords = 'login, signin, user account, Eptha-Agro';

        return view('front-pages.auth.login', compact('title', 'description', 'keywords'));
    }

    public function login(LoginFormRequest $request):RedirectResponse
    {
        $response = $this->loginService->login($request);
        if ($response->status) {
            return redirect()->intended(route('user.profile'))->with('success', $response->message);
        }
        return back()->withInput($request->only('email'))->with('error', $response->message);
    }
}
