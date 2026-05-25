<?php

namespace HasanYagout\Announcement\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class EditAnnouncement extends EditRecord
{
    protected static string $resource = AnnouncementResource::class;


    protected function afterSave(): void
    {
        $this->record->recipients()->delete();

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
