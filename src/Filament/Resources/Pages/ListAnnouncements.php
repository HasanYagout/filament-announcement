<?php

namespace HasanYagout\Announcement\Filament\Resources\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class ListAnnouncements extends ListRecords
{
    protected static string $resource = AnnouncementResource::class;
    protected Width | string | null $maxContentWidth ='full';
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
