<?php

return [
    'name' => 'Admin panel',
    'auth' => [
        'guards' => [
            'web' => [
                'driver' => 'session',
                'provider' => 'users',
            ],
            'api' => [
                'driver' => 'token',
                'provider' => 'users',
            ],
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => \Dosarkz\Dosmin\Modules\SuperUser\Models\SuperUser::class,
            ],
            'users' => [
                'driver' => 'eloquent',
                'model' => App\User::class,
            ],
        ],
    ],

    'modules' => [
        'cache' => [
            'enabled' => false,
            'key' => 'laravel-modules',
            'lifetime' => 60,
        ],
        'providers' => [

        ]
    ]

];