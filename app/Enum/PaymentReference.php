<?php

namespace App\Enum;

enum PaymentReference: string
{
    case Internal    = 'internal';
    case Paystack    = 'paystack';
    case Flutterwave = 'flutterwave';
    case Manual      = 'manual';

    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Internal    => 'Internal',
            self::Paystack    => 'Paystack',
            self::Flutterwave => 'Flutterwave',
            self::Manual      => 'Manual',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn(self $ref) => [
                'value' => $ref->value,
                'label' => $ref->label(),
            ],
            self::cases()
        );
    }
}
