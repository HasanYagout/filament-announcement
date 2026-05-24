<?php

namespace HasanYagout\Announcement;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class AnnouncementPlugin implements Plugin
{
    protected bool $databaseNotifications = true;

    protected array $customRecipientModels = [];

    public function getId(): string
    {
        return 'announcement';
    }

    public static function get(): static
    {
        return Filament::getCurrentPanel()->getPlugin('announcement');
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([AnnouncementResource::class])
            ->widgets([AnnouncementsWidget::class])
            ->databaseNotifications($this->databaseNotifications);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function withDatabaseNotifications(bool $enabled = true): static
    {
        $this->databaseNotifications = $enabled;

        return $this;
    }

    public function withCustomRecipients(array $models): static
    {
        $this->customRecipientModels = $models;

        return $this;
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
