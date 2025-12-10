<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected User $model
    ){}

    public function create(array $data):?User
    {
        return $this->model->create($data);
    }
}
