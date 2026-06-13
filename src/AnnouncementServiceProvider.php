<?php

namespace HasanYagout\Announcement;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HasanYagout\Announcement\Commands\AnnouncementCommand;
use HasanYagout\Announcement\Testing\TestsAnnouncement;

class AnnouncementServiceProvider extends PackageServiceProvider
{
    public static string $name = 'announcements';

    public static string $viewNamespace = 'announcements';

    public function configurePackage(Package $package): void
    {

        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations()
            ->hasMigrations([
                'create_announcement_table',
                'create_announcement_recipients_table',
            ]);
    }
    public function boot()
    {
        // Register views namespace
        parent::boot();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'announcements');
    }


}
