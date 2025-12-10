<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Repositories\Interface\OrderRepositoryInterface;

class MyOrderController extends BaseController
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getByUser(auth()->id());
        
        return view('users.orders.my-orders', compact('orders'));
    }

    public function show($id)
    {
        $order = $this->orderRepository->find($id);
        
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to order');
        }
        
        return view('users.orders.show', compact('order'));
    }
}
