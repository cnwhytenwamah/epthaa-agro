<?php

namespace App\Http\Controllers\FrontPages;

use Exception;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Payments\PaymentService;
use App\Services\Factories\PaymentServiceFactory;

class PaymentController extends BaseController
{
    /**
     * Verify payment callback from any gateway
     */
    public function verifyPayment(Request $request)
    {
        $reference = $request->query('reference');

        if (!$reference) {
            return redirect()->route('checkout.index')->with('error', 'Payment reference not provided.');
        }

        // Find order by reference
        $order = Order::where('reference', $reference)->firstOrFail();

        // Create service for correct gateway
        $paymentService = new PaymentService(PaymentServiceFactory::make($order->payment_method));

        $verified = $paymentService->verify($reference, $order->total);

        if ($verified) {
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'processing',
            ]);

            return redirect()->route('checkout.success', $order->order_number)->with('success', 'Payment successful!');
        }

        return redirect()->route('checkout.index')->with('error', 'Payment verification failed.');
    }
}
