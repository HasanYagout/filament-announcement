<?php

namespace HasanYagout\Announcement\Filament\Resources\Pages;

use Filament\Resources\Pages\ListRecords;
use HasanYagout\Announcement\Announcement;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class ListAnnouncements extends ListRecords
{
    protected static string $resource = AnnouncementResource::class;

}
