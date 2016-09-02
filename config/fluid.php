<?php

return [
    'extension' => 'html',
    'cache' => [
        'path' => base_path('bootstrap/cache')
    ],
    'rootPaths' => [
        'template' => [
            base_path('resources/views/Templates/'),
        ],
        'layout' => [
            base_path('resources/views/Layouts/'),
        ],
        'partial' => [
            base_path('resources/views/Partials/'),
        ],
    ]
];