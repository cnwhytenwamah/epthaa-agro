<?php

namespace App\Enum;

enum PaymentMethod: string
{
    case Paystack      = 'paystack';
    case Flutterwave   = 'flutterwave';
    case BankTransfer  = 'bank_transfer';
    case Wallet        = 'wallet';
    case Cash          = 'cash';

    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Paystack     => 'Paystack',
            self::Flutterwave  => 'Flutterwave',
            self::BankTransfer => 'Bank Transfer',
            self::Wallet       => 'Wallet',
            self::Cash         => 'Cash',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn(self $method) => [
                'value' => $method->value,
                'label' => $method->label(),
            ],
            self::cases()
        );
    }
}
