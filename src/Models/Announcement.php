<?php

namespace HasanYagout\Announcement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;

class Announcement extends Model
{

    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'body',
        'is_active',
        'type',
        'is_dismissible',
        'is_global',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'type' => \HasanYagout\Announcement\Enums\AnnouncementType::class,
        'is_active' => 'boolean',
        'is_global' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];
    public function scopeVisibleForDashboard(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where(function (Builder $q): void {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function (Builder $q): void {
                $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
            });
    }

    public function scopeOrderedForDisplay(Builder $query): Builder
    {
        return $query
            ->orderByRaw("CASE type WHEN 'danger' THEN 1 WHEN 'warning' THEN 2 WHEN 'info' THEN 3 WHEN 'success' THEN 4 ELSE 5 END")
            ->orderByDesc('created_at');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(AnnouncementRecipient::class);
    }


}
