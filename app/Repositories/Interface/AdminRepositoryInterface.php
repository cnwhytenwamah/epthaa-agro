<?php

namespace App\Repositories\Interface;

use App\Models\Admin;

interface AdminRepositoryInterface
{
    public function create(array $data):?Admin;
}
