<?php

return [
    'name' => 'Laravel Admin',
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
                'model'  => \Dosarkz\LaravelAdmin\Modules\AdminUser\Models\AdminUser::class,
            ],
            'users' => [
                'driver' => 'eloquent',
                'model' => App\User::class,
            ],
        ],
    ],

];