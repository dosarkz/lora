<?php
use Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers\LoginController;

return [
    'name' => 'Lora panel',
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
                'model'  => \Dosarkz\Lora\Installation\Modules\Lora\Models\SuperUser::class,
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
    ],
    'lora' => [
        'controllers' => [
            'auth' => LoginController::class,
        ]
    ]

];
