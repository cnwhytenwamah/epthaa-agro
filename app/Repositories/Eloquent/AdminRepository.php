<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Interface\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected Admin $model
    ){}

    public function create(array $data):?Admin
    {
        return $this->model->create($data);
    }
}
