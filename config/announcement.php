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
    'resolver' => null,

    'polling_interval' => 30, // seconds

];
