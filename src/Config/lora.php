<?php

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
    'routes' => [
        'namespace' => 'Dosarkz\Lora\Installation\Modules\Lora\Http\Controllers',
        'auth' => [
            'getLogin' =>  'Auth\LoginController@showLoginForm',
            'postLogin' => 'Auth\LoginController@postLogin',
            'logout' => 'Auth\LoginController@getLogout',
        ],
        'main' => [
            'index' =>  'AppController@index',
            'getSettings' => 'AppController@settings',
            'postSettings' =>  'AppController@postSettings',
            'destroyAvatar' => 'AppController@removeImage',
            'getResetPassword' => 'AppController@getResetPassword',
            'postResetPassword' =>  'AppController@postResetPassword'
        ],
        'resources' => [
            'accounts' => 'Resources\AccountsController',
            'menus' => 'Resources\MenuController',
            'menuItems' => 'Resources\MenuItemController',
            'roles' => 'Resources\RoleController'
        ]
    ]

];
