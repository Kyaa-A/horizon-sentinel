<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class NotificationBell extends Component
{
    public bool $showDropdown = false;

    /**
     * Get the count of unread notifications.
     */
    #[Computed]
    public function unreadCount(): int
    {
        return auth()->user()->unreadNotifications()->count();
    }

    /**
     * Get the recent unread notifications (max 5).
     */
    #[Computed]
    public function notifications()
    {
        return auth()->user()
            ->unreadNotifications()
            ->take(5)
            ->get();
    }

    /**
     * Toggle the dropdown visibility.
     */
    public function toggleDropdown(): void
    {
        $this->showDropdown = !$this->showDropdown;
    }

    /**
     * Close the dropdown.
     */
    public function closeDropdown(): void
    {
        $this->showDropdown = false;
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(string $notificationId): void
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $notificationId)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        // Force recomputation of cached properties
        unset($this->unreadCount, $this->notifications);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): void
    {
        auth()->user()->unreadNotifications->markAsRead();

        // Force recomputation of cached properties
        unset($this->unreadCount, $this->notifications);

        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
