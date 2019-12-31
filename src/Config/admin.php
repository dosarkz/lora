<?php

return [
    'name' => 'AdminFacade panel',
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
                'model'  => \Dosarkz\Lora\Modules\SuperUser\Models\SuperUser::class,
            ],
            'users' => [
                'driver' => 'eloquent',
                'model' => App\User::class,
            ],
        ],
    ],

    'modules' => [
        'providers' => [

        ]
    ]

];
