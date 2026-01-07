<?php

namespace App\Services\Admin\Auth;

use stdClass;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Admin\AdminLoginFormRequest;


class AdminLoginService extends BaseService
{
    /**
     * Handle admin login request.
     */
    public function login(AdminLoginFormRequest $request): stdClass
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (! Auth::guard('admin')->attempt($credentials, $remember)) {
            return $this->errorMsg('Invalid admin credentials');
        }

        $request->session()->regenerate();

        return $this->successMsg('Login successful');
    }

    /**
     * Handle admin logout.
     */
    public function logout(): stdClass
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->successMsg('You have been logged out.');
    }
}
