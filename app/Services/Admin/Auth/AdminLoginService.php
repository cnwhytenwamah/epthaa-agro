<?php

namespace App\Services\Admin\Auth;

use stdClass;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Admin\AdminLoginFormRequest;


class AdminLoginService extends BaseService
{
    /**
     * Handle login request.
     */
    public function login(AdminLoginFormRequest $request): stdClass
    {
        $request->authenticate();

        Auth::guard('admin')->user();

        return $this->successMsg('Login successful');
    }

    /**
     * Handle logout.
     */
    public function logout(): stdClass
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->successMsg('You have been logged out.');
    }
}
