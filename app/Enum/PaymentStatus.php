<?php

namespace App\Enum;

enum PaymentStatus: string
{
    case Pending    = 'pending';
    case Processing = 'processing';
    case Success    = 'success';
    case Failed     = 'failed';
    case Cancelled  = 'cancelled';
    case Refunded   = 'refunded';

    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Pending    => 'Pending',
            self::Processing => 'Processing',
            self::Success    => 'Success',
            self::Failed     => 'Failed',
            self::Cancelled  => 'Cancelled',
            self::Refunded   => 'Refunded',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn(self $status) => [
                'value' => $status->value,
                'label' => $status->label(),
            ],
            self::cases()
        );
    }

    public function isFinal(): bool
    {
        return in_array($this, [
            self::Success,
            self::Failed,
            self::Cancelled,
            self::Refunded,
        ]);
    }
}
