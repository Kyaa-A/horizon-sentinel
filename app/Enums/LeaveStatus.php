<?php

namespace App\Enums;

enum LeaveStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Denied = 'denied';
    case Cancelled = 'cancelled';

    /**
     * Get the human-readable label for the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Denied => 'Denied',
            self::Cancelled => 'Cancelled',
        };
    }

    /**
     * Get the badge color class for UI display.
     */
    public function badgeClass(): string
    {
        return match ($this) {
            self::Pending => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            self::Approved => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            self::Denied => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            self::Cancelled => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
        };
    }

    /**
     * Get the border color class for UI display.
     */
    public function borderClass(): string
    {
        return match ($this) {
            self::Pending => 'border-yellow-500',
            self::Approved => 'border-green-500',
            self::Denied => 'border-red-500',
            self::Cancelled => 'border-gray-500',
        };
    }

    /**
     * Check if this status can be cancelled.
     */
    public function canBeCancelled(): bool
    {
        return match ($this) {
            self::Pending, self::Approved => true,
            default => false,
        };
    }

    /**
     * Check if this status can be edited.
     */
    public function canBeEdited(): bool
    {
        return $this === self::Pending;
    }

    /**
     * Check if this status can be reviewed (approved/denied).
     */
    public function canBeReviewed(): bool
    {
        return $this === self::Pending;
    }

    /**
     * Check if this is a final status.
     */
    public function isFinal(): bool
    {
        return match ($this) {
            self::Denied, self::Cancelled => true,
            default => false,
        };
    }

    /**
     * Get all status values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all statuses as an array for dropdowns.
     */
    public static function toArray(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $status) => $status->label(), self::cases())
        );
    }
}
