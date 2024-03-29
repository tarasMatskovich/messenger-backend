<?php

return [
    'doctrine' => [

    ],
    'security' => [
        'secondFactor' => [
            'salt' => 'dhdh77dgbfy6Gdf37clb2l'
        ],
        'jwt' => [
            'secret' => 'gd6cc27xv2GSc278xc'
        ]
    ],
    'storage' => [
        'public' => ROOT  . '/storage/files'
    ],
    'database' => [
        'db_name' => getenv('DB_NAME'),
        'login' => getenv('DB_LOGIN'),
        'password' => getenv('DB_PASS'),
        'host' => getenv('DB_HOST'),
        'port' => getenv('DB_PORT'),
        'driver' => getenv('DB_DRIVER')
    ],
    'app' => [
        'db' => [
            'key' => 'value'
        ]
    ]
];
