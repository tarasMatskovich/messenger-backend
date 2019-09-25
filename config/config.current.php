<?php

return [
    'doctrine' => [

    ],
    'security' => [
        'jwt' => [
            'secret' => 'gd6cc27xv2GSc278xc'
        ]
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
