<?php

namespace HasanYagout\Announcement\Filament\Resources\Pages;

use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
    protected Width | string | null $maxContentWidth ='full';

    protected function afterCreate(): void
    {
        if ($this->data['is_global']) {
            return;
        }

        foreach ($this->data['recipient_ids'] as $recipientId) {

            $this->record->recipients()->create([
                'recipient_type' => $this->data['recipient_type'],
                'recipient_id' => $recipientId,
            ]);
        }

    }
}
