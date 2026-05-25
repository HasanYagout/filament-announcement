<?php

namespace HasanYagout\Announcement\Policies;

use HasanYagout\Announcement\Models\Announcement;
use App\Models\User;

class AnnouncementPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('ViewAny:Announcement');
    }

    public function view(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('View:Announcement');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('Create:Announcement');
    }

    public function update(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('Update:Announcement');
    }

    public function delete(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('Delete:Announcement');
    }



    public function forceDelete(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('ForceDelete:Announcement');
    }

    public function restore(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('Restore:Announcement');
    }

    public function replicate(User $user, Announcement $announcement): bool
    {
        return $user->hasPermissionTo('Replicate:Announcement');
    }


}
