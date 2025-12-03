<?php

namespace App\Services\User\Auth;

use stdClass;
use App\Services\BaseService;
use App\Http\Requests\Auth\User\LoginFormRequest;
use Illuminate\Support\Facades\Auth;

class LoginService extends BaseService
{
    /**
     * Handle login request.
     */
    public function login(LoginFormRequest $request): stdClass
    {
        $request->authenticate();

        Auth::guard('user')->user();

        return $this->successMsg('Login successful');
    }

    /**
     * Handle logout.
     */
    public function logout(): stdClass
    {
        Auth::guard('user')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->successMsg('You have been logged out.');
    }
}
