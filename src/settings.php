<?php

return [
    'settings' => [
        'displayErrorDetails' => true,

        'view' => [
            'template_path' => __DIR__ . '/../templates/',
            'cache_path'    => __DIR__ . '/../storages/cache/',
            'auto_reload'   => true
        ],

        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../storages/log/app.log',
        ],
    ]
];