<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Admin\OrderService;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    public function index(Request $request)
    {
        $orders = $this->orderService->getAdminOrders(
            $request->only(['status', 'payment_status'])
        );

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order = $this->orderService->getOrder($order);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // dd($request->method(), $request->all());
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $this->orderService->updateOrderStatus(
            $order,
            $request->order_status
        );

        return back()->with('success', 'Order status updated successfully');
    }

    public function invoice(Order $order)
    {
        $order = $this->orderService->getOrder($order);
        return view('admin.orders.invoice', compact('order'));
    }
}