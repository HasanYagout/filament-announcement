<?php

namespace HasanYagout\Announcement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AnnouncementRecipient extends Model
{

    protected $fillable = [
        'announcement_id',
        'recipient_type',
        'recipient_id',
    ];

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }

    public function recipient(): MorphTo
    {
        return $this->morphTo();
    }


}
