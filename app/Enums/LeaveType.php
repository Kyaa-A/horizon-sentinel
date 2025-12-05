<?php

namespace App\Enums;

enum LeaveType: string
{
    case PaidTimeOff = 'paid_time_off';
    case UnpaidLeave = 'unpaid_leave';
    case SickLeave = 'sick_leave';
    case Vacation = 'vacation';

    /**
     * Get the human-readable label for the leave type.
     */
    public function label(): string
    {
        return match ($this) {
            self::PaidTimeOff => 'PTO',
            self::UnpaidLeave => 'Unpaid Leave',
            self::SickLeave => 'Sick Leave',
            self::Vacation => 'Vacation',
        };
    }

    /**
     * Get the full descriptive name.
     */
    public function description(): string
    {
        return match ($this) {
            self::PaidTimeOff => 'Paid Time Off',
            self::UnpaidLeave => 'Unpaid Leave',
            self::SickLeave => 'Sick Leave',
            self::Vacation => 'Vacation',
        };
    }

    /**
     * Get the color class for UI display.
     */
    public function colorClass(): string
    {
        return match ($this) {
            self::PaidTimeOff => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            self::UnpaidLeave => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
            self::SickLeave => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            self::Vacation => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        };
    }

    /**
     * Check if this leave type affects balance.
     */
    public function affectsBalance(): bool
    {
        return match ($this) {
            self::UnpaidLeave => false,
            default => true,
        };
    }

    /**
     * Get all leave types as an array for dropdowns.
     */
    public static function toArray(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $type) => $type->description(), self::cases())
        );
    }

    /**
     * Get all leave type values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
