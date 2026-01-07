<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('items')->get();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->with(['items.product', 'user'])->findOrFail($id);
    }

    public function findByOrderNumber($orderNumber)
    {
        return $this->model->with(['items.product'])->where('order_number', $orderNumber)->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $order = $this->find($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        $order = $this->find($id);
        return $order->delete();
    }

    public function getByStatus($status)
    {
        return $this->model->where('order_status', $status)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getByUser($userId)
    {
        return $this->model->where('user_id', $userId)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function updateStatus($id, $status)
    {
        $order = $this->find($id);
        $order->update(['order_status' => $status]);
        return $order;
    }

    public function updatePaymentStatus($id, $status, $reference = null)
    {
        $order = $this->find($id);
        $data = ['payment_status' => $status];
        
        if ($reference) {
            $data['payment_reference'] = $reference;
        }
        
        $order->update($data);
        return $order;
    }

    public function getTotalRevenue()
    {
        return $this->model->where('payment_status', 'paid')->sum('total');
    }

    public function getRecentOrders($limit = 5)
    {
        return $this->model->with('items')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function paginateWithFilters(array $filters, $perPage = 15)
    {
        $query = $this->model->with('items');

        if (!empty($filters['status'])) {
            $query->where('order_status', $filters['status']);
        }

        if (!empty($filters['payment_status'])) {
            $query->where('payment_status', $filters['payment_status']);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
}
