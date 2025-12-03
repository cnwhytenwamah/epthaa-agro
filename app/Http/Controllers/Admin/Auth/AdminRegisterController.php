<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


use App\Services\Admin\Auth\AdminRegisterService;
use App\Http\Requests\Auth\Admin\AdminRegisterFormRequest;

class AdminRegisterController extends Controller
{
    public function __construct(
        protected AdminRegisterService $registerService,
    ){}

    public function showRegisterForm():View
    {
        $title = "EPTHAA AGRO LIMITED | Admin Registration";
        $description = "EPTHAA AGRO LIMITED | Admin registration page";
        $keywords = "blog, news, ken, technologies, religion, health";

        return view('admin.auth.register', compact('title', 'description', 'keywords'));
    }

    public function register(AdminRegisterFormRequest $request):RedirectResponse
    {
        $response = $this->registerService->register($request);
        if ($response->status) {
            return redirect()->route('admin.login')->with('success', $response->message);
        }
        return redirect()->back()->withErrors(['email' => $response->message]);
    }
}
