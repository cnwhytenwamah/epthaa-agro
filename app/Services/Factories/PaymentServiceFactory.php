<?php

namespace App\Services\Factories;

use Exception;
use App\Repositories\Eloquent\Payments\PaystackRepository;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Eloquent\Payments\FlutterwaveRepository;

class PaymentServiceFactory
{
    /**
     * @param string|null $gateway The payment gateway to use. If null, fallback to env.
     */
    public static function make(?string $gateway = ''): PaymentRepositoryInterface
    {
        $paymentGateway = $gateway ?? env('PAYMENT_GATEWAY');

        return match ($paymentGateway) {
            'paystack'    => app(PaystackRepository::class),
            'flutterwave' => app(FlutterwaveRepository::class),
            default       => throw new Exception('No valid payment gateway found'),
        };
    }
}
