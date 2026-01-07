<?php

namespace App\Services\Admin;

use Exception;
use App\Services\Admin\AdminBaseService;
use App\Repositories\Interface\OrderRepositoryInterface;

class OrderService extends AdminBaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OrderRepositoryInterface $orders
    ) {}

    /**
     * Get filtered orders for admin listing
     */
    public function getAdminOrders(array $filters)
    {
        return $this->orders->paginateWithFilters($filters);
    }

    /**
     * Get a single order with relations
     */
    public function getOrder($order)
    {
        return $this->orders->find($order->id);
    }

    /**
     * Update order status (ADMIN ACTION)
     */
    public function updateOrderStatus($order, string $status)
    {
        if ($order->order_status === 'cancelled') {
            throw new Exception('Cancelled orders cannot be updated');
        }

        return $this->orders->updateStatus($order->id, $status);
    }

    /**
     * Mark order as paid (CALLED BY PAYMENT MODULE)
     */
    public function markOrderAsPaid($orderId, string $reference = null)
    {
        DB::transaction(function () use ($orderId, $reference) {
            $this->orders->updatePaymentStatus(
                $orderId,
                'paid',
                $reference
            );

            // Auto move to processing after payment
            $this->orders->updateStatus($orderId, 'processing');
        });
    }
}
