<?php

namespace App\Services\Payments;


use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Interface\PaymentRepositoryInterface;

class PaymentService
{
    public function __construct(
        protected PaymentRepositoryInterface $payments
    ) {}

    /**
     * Initialize payment (Paystack / Flutterwave / etc.)
     */
    public function initialize(Order $order): RedirectResponse
    {
        $response = $this->payments->initialize($order);
        dd($response);
        if (!isset($response->status) || $response->status !== true) {
            abort(500, 'Unable to initialize payment');
        }

        return redirect()->away($response->payment_url);
    }

    /**
     * Verify payment
     */
    public function verify(string $reference, int $amount): bool
    {
        return $this->payments->verify($reference, $amount);
    }
}
