<?php

namespace App\Enums;

enum SchoolCategory: string
{
    case ELEMENTARY = 'elementary';
    case JUNIOR_HIGH = 'junior_high';
    case SENIOR_HIGH = 'senior_high';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::ELEMENTARY => 'Elementary',
            self::JUNIOR_HIGH => 'Junior High',
            self::SENIOR_HIGH => 'Senior High',
            self::OTHER => 'Other',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return array_map(fn ($case) => $case->label(), self::cases());
    }
}
