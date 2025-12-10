<?php

namespace App\Http\Controllers\FrontPages\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\BaseController;
use App\Services\User\Auth\RegisterService;
use App\Http\Requests\Auth\User\RegisterFormRequest;

class UserRegisterController extends BaseController
{
    public function __construct(
        protected RegisterService $registerService,
    ){}

    public function showRegisterForm():View
    {
        $title = 'Eptha-Agro Limited | User Login';
        $description = 'Eptha-Agro Limited admin login page';
        $keywords = 'login, signin, user account, Eptha-Agro';

        return view('front-pages.auth.register', compact('title', 'description', 'keywords'));
    }

    public function register(RegisterFormRequest $request):RedirectResponse
    {
        $response = $this->registerService->register($request);
        if ($response->status) {
            return redirect()->route('login')->with('success', $response->message);
        }
        return redirect()->back()->withErrors(['email' => $response->message]);
    }
}
