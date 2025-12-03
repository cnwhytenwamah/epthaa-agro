<?php

namespace App\Services\User;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;

class UserBaseService extends BaseService
{
    protected $user;
    protected $userId;
   
    public function __construct()
    {
        $this->user = $this->getUser();
        $this->userId = $this->user->id;
    }

    protected function getUser():User
    {
        return Auth::guard('user')->user() ?? Auth::user();
    }

    
}
