<?php

namespace HasanYagout\Announcement\Traits;

use HasanYagout\Announcement\Models\Announcement;
use HasanYagout\Announcement\Models\AnnouncementRecipient;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAnnouncements
{
    public function announcementRecipients(): MorphMany
    {
        return $this->morphMany(
            AnnouncementRecipient::class,
            'recipient'
        );
    }
    public function unreadAnnouncements()
    {
        return $this->announcements()
            ->wherePivotNull('read_at');
    }

    public function announcements()
    {
        return $this->morphToMany(
            \HasanYagout\Announcement\Models\Announcement::class,
            'recipient',
            'announcement_recipients',
            'recipient_id',
            'announcement_id'
        )->withPivot([
            'dismissed_at',
        ]);
    }
}
