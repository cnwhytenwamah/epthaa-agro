<?php

namespace App\Repositories\Interface;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function __construct(Order $model);
    public function all();
    public function paginate($perPage = 15);
    public function find($id);
    public function findByOrderNumber($orderNumber);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getByStatus($status);
    public function getByUser($userId);
    public function updateStatus($id, $status);
    public function updatePaymentStatus($id, $status, $reference = null);
    public function getTotalRevenue();
    public function getRecentOrders($limit = 5);
    
}
