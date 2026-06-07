<?php

namespace HasanYagout\Announcement;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;
use HasanYagout\Announcement\Livewire\GlobalAnnouncementBanner;
use HasanYagout\Announcement\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;


class AnnouncementPlugin implements Plugin
{
    protected bool $databaseNotifications = true;
    protected array $customRecipientModels = [];
        protected string $pollingInterval = '5s';
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
        ->databaseNotifications($this->databaseNotifications);
    }
    protected function getListeners(): array
    {
        return [];
    }

    public function boot(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_START,
            fn (): string => \Livewire\Livewire::mount(
                GlobalAnnouncementBanner::class,
                [
                    'pollingInterval' => $this->getPollingInterval(),
                ]
            )
        );
    }



    public function pollingInterval(string $interval): static
    {
        $this->pollingInterval = $interval;

        return $this;
    }

    public function getPollingInterval(): string
    {
        return $this->pollingInterval;
    }

    public static function make(): static
    {
        return app(static::class);
    }


}
