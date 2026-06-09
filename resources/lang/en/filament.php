<?php

return [

    'sections' => [
        'announcement' => 'Announcement',
        'recipients' => 'Recipients',
    ],

    'form' => [

        'title' => [
            'label' => 'Title',
        ],

        'body' => [
            'label' => 'Body',
        ],

        'type' => [
            'label' => 'Type',
        ],
        'recipient_ids' => [
            'label' => 'Recipient',
        ],
        'is_active' => [
            'label' => 'Active',
        ],

        'is_dismissible' => [
            'label' => 'Dismissible',
        ],

        'is_global' => [
            'label' => 'Global',
        ],

        'starts_at' => [
            'label' => 'Starts At',
        ],

        'ends_at' => [
            'label' => 'Ends At',
        ],

        'recipient_type' => [
            'label' => 'Recipient Type',
        ],
    ],

    'table' => [

        'columns' => [

            'title' => 'Title',

            'recipients' => 'Recipients',

            'is_active' => 'Active',

            'starts_at' => 'Starts At',

            'ends_at' => 'Ends At',

            'created_at' => 'Created At',
        ],
    ],

    'navigation' => [
        'model' => 'Announcement',
        'plural' => 'Announcements',
    ],

];
