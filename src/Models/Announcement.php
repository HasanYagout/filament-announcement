<?php

namespace HasanYagout\Announcement\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Announcement
{
    protected $table = 'announcements';

    protected array $fillable = [
        'title', 'body', 'type', 'icon', 'color', 'target_type', 'target_id', 'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function target(): MorphTo
    {
        return $this->morphTo();
    }

    public function send(): void
    {
        $this->update(['sent_at' => now()]);

        // Use Laravel's notification system
        $targetClass = $this->target_type;
        $target = $targetClass::find($this->target_id);

        if ($target && method_exists($target, 'notify')) {
            $target->notify(new AnnouncementNotification($this));
        }
    }
}
