<?php

namespace App\Repositories\Eloquent\Payments;

use stdClass;
use App\Models\Order;
use InvalidArgumentException;
use Illuminate\Support\Facades\Http;
use App\Repositories\Interface\PaymentRepositoryInterface;

class FlutterwaveRepository implements PaymentRepositoryInterface
{
    protected object $config;

    public function __construct()
    {
        $this->config = (object) config('services.flutterwave');
    }

    /**
     * Initialize Flutterwave payment
     */
    public function initialize(object $data): stdClass
    {
        if (! $data instanceof Order) {
            throw new InvalidArgumentException('Expected instance of Order');
        }

        $order = $data;

        $response = Http::withToken($this->config->secret_key)
            ->post("{$this->config->base_url}/payments", [
                'tx_ref' => $order->reference,
                'amount' => $order->total,
                'currency' => 'NGN',
                'redirect_url' => route('payment.verify'),
                'customer' => [
                    'email' => $order->customer_email,
                    'name'  => $order->customer_name,
                ],
                'customizations' => [
                    'title' => 'EPTHAA Agro',
                    'description' => 'Order Payment',
                ],
            ])
            ->object();

        return (object) [
            'status' => ($response->status ?? null) === 'success',
            'payment_url' => $response->data->link ?? null,
            'raw' => $response, // optional (very useful for debugging)
        ];
    }

    /**
     * Verify payment
     */
    public function verify(string $reference, int $amount): bool
    {
        $response = Http::withToken($this->config->secret_key)
            ->get("{$this->config->base_url}/transactions/verify_by_reference", [
                'tx_ref' => $reference,
            ])
            ->object();

        return (
            ($response->status ?? null) === 'success' &&
            ($response->data->status ?? null) === 'successful' &&
            (int) ($response->data->amount ?? 0) === (int) $amount
        );
    }

    /**
     * Refund payment (optional)
     */
    public function refund(string $reference, ?int $amount = null): stdClass
    {
        return new stdClass();
    }
}
