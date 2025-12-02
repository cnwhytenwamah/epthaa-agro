<?php

namespace App\Enum;

enum Status:string
{
    case Draft = 'draft';
    case Published = 'published';
    case Inactive = 'inactive';
    case Deleted = 'deleted';

    public static function values(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Published => 'Published',
            self::Inactive => 'Inactive',
            self::Deleted => 'Deleted',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn(self $status) => ['value' => $status->value, 'label' => $status->label()],
            self::cases()
        );
    }
}