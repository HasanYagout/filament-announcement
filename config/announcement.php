<?php
use App\Models\User;

// config for HasanYagout/Announcement
return [

    'recipient_models' => [

        User::class => [
            'label' => 'Users',
            'title_attribute' => 'name',
        ],


    ],

    'navigation_group' => '',

    'polling_interval' => 30, // seconds
    /*
       |--------------------------------------------------------------------------
       | Permission Checker
       |--------------------------------------------------------------------------
       |
       | Define how to check if a user has a permission.
       | Provide a closure or a class@method that receives ($user, $permission).
       |
       | Example for Spatie:
       | 'permission_check' => function ($user, $permission) {
       |     return $user->hasPermissionTo($permission);
       | },
       |
       | Example for custom roles:
       | 'permission_check' => function ($user, $permission) {
       |     return $user->role === 'admin';
       | },
       |
       | Example to always allow (not recommended for production):
       | 'permission_check' => function ($user, $permission) {
       |     return true;
       | },
       */
    'permission_check' => null, // default null will use Spatie if available
];
