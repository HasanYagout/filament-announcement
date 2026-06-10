<?php

namespace HasanYagout\Announcement\Filament\Resources\Pages;

use Filament\Resources\Pages\EditRecord;
use HasanYagout\Announcement\Filament\Resources\AnnouncementResource;

class EditAnnouncement extends EditRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {


        // Load existing recipients for this announcement
        $recipients = $this->record->recipients;

        if ($recipients->isNotEmpty()) {
            // Assume all recipients have the same type (as per your saving logic)
            $data['recipient_type'] = $recipients->first()->recipient_type;
            $data['recipient_ids'] = $recipients->pluck('recipient_id')->toArray();
        } else {
            $data['recipient_ids'] = [];
            $data['recipient_type'] = null;
        }

        return $data;
    }
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
