<?php

return [

    'sections' => [
        'announcement' => 'الإعلان',
        'recipients' => 'المستلمون',
    ],

    'form' => [

        'title' => [
            'label' => 'العنوان',
        ],

        'body' => [
            'label' => 'المحتوى',
        ],

        'type' => [
            'label' => 'النوع',
        ],

        'is_active' => [
            'label' => 'نشط',
        ],
        'recipient_ids' => [
            'label' => 'المستلمين',
        ],

        'is_dismissible' => [
            'label' => 'قابل للإخفاء',
        ],

        'is_global' => [
            'label' => 'إعلان عام',
        ],

        'starts_at' => [
            'label' => 'يبدأ في',
        ],

        'ends_at' => [
            'label' => 'ينتهي في',
        ],

        'recipient_type' => [
            'label' => 'نوع المستلم',
        ],
    ],

    'table' => [

        'columns' => [

            'title' => 'العنوان',

            'recipients' => 'المستلمون',

            'is_active' => 'نشط',

            'starts_at' => 'يبدأ في',

            'ends_at' => 'ينتهي في',

            'created_at' => 'تم الإنشاء',
        ],
    ],
    'navigation' => [
        'model' => 'إعلان',
        'plural' => 'الإعلانات',
    ],
];
