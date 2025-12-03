<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;

class AdminBaseService extends BaseService
{
    protected $admin;
    protected $adminId;

    public function __construct()
    {
        $this->admin = $this->getAdmin();
        $this->adminId = $this->admin->id;
    }

    protected function getAdmin():Admin
    {
        return Auth::guard('admin')->user()??Auth::user();
    }

}
