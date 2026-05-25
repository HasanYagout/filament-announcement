<?php

namespace HasanYagout\Announcement\Livewire;

use Livewire\Component;

class GlobalAnnouncementBanner extends Component
{
    public string $pollingInterval = '5s';
    public function getAnnouncementsProperty()
    {
        $user = auth()->user();

        if (! $user) {
            return collect();
        }

        $resolver = config('announcement.resolver');

        if (is_callable($resolver)) {
            return $resolver($user);
        }

        return $this->defaultAnnouncements($user);
    }
    protected function defaultAnnouncements($user)
    {

        return \HasanYagout\Announcement\Models\Announcement::query()
            ->with('recipients')
            ->visibleForDashboard()
            ->orderedForDisplay()
            ->where(function ($q) use ($user) {
                $q->where('is_global', true)
                    ->orWhereHas('recipients', fn ($q) =>
                    $q->where('recipient_id', $user->id)
                    );
            })
            ->whereDoesntHave('recipients', function ($query) use ($user) {
                $query
                    ->where('recipient_id', $user->id)
                    ->where('recipient_type', get_class($user))
                    ->whereNotNull('dismissed_at');
            })
            ->latest()
            ->get();
    }

    public function dismiss($id)
    {

        $user = auth()->user();

        $user->announcements()->updateExistingPivot($id, [
            'dismissed_at' => now(),
        ]);
    }


    public function render()
    {
        return view('announcements::livewire.global-announcement-banner', [
            'pollingInterval' => $this->pollingInterval,
        ]);
    }

}
