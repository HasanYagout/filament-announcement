<?php

namespace HasanYagout\Announcement\Notifications;

use Filament\Notifications\DatabaseNotification;
use Filament\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;

class AnnouncementNotification extends Notification
{
    use Queueable;

    protected $announcement;

    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): DatabaseNotification
    {
        return FilamentNotification::make()
            ->title($this->announcement->title)
            ->body($this->announcement->body)
            ->icon($this->announcement->icon ?? 'heroicon-o-megaphone')
            ->status($this->announcement->type)
            ->getDatabaseMessage();
    }
}
