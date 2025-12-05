<?php

namespace App\Enums;

enum UserRole: string
{
    case Employee = 'employee';
    case Manager = 'manager';
    case HRAdmin = 'hr_admin';

    /**
     * Get the human-readable label for the role.
     */
    public function label(): string
    {
        return match ($this) {
            self::Employee => 'Employee',
            self::Manager => 'Manager',
            self::HRAdmin => 'HR Admin',
        };
    }

    /**
     * Get the badge color class for UI display.
     */
    public function badgeClass(): string
    {
        return match ($this) {
            self::Employee => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            self::Manager => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
            self::HRAdmin => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
        };
    }

    /**
     * Check if this role can approve leave requests.
     */
    public function canApproveLeave(): bool
    {
        return match ($this) {
            self::Manager, self::HRAdmin => true,
            default => false,
        };
    }

    /**
     * Check if this role has admin access.
     */
    public function isAdmin(): bool
    {
        return $this === self::HRAdmin;
    }

    /**
     * Check if this role requires a manager.
     */
    public function requiresManager(): bool
    {
        return $this === self::Employee;
    }

    /**
     * Get all role values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all roles as an array for dropdowns.
     */
    public static function toArray(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $role) => $role->label(), self::cases())
        );
    }
}
