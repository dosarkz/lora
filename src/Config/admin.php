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
                'model'  => App\Modules\SuperUser\Models\SuperUser::class,
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
            'menu' => App\Modules\Menu\Providers\MenuServiceProvider::class,
            'superUser' => App\Modules\SuperUser\Providers\SuperUserServiceProvider::class,
            'moduleImage' => App\Modules\Image\Providers\ImageServiceProvider::class,
            'role' => App\Modules\Role\Providers\RoleServiceProvider::class,
            'article' => App\Modules\Article\Providers\ArticleServiceProvider::class,
        ]
    ]

];