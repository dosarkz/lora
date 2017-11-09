<?php

return [
    'module' => [
        'name' => 'Super User Module',
        'alias' => 'admin_users',
        'description' => 'Super User Module',
        'keywords' => [],
        'status' => 1,
        'providers' => [],
        'aliases' => [],
    ],
    'admin' => [
        'model' => \Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUser::class,
        'menu'=> [
            'active' => true,
            'items' => [
                new \Dosarkz\LaravelAdmin\Menu('superUser::menu.index', '/admin/main','fa-file-text-o',  [
                    new \Dosarkz\LaravelAdmin\Menu('superUser::menu.create', '/admin/main/sliders', 'fa-picture-o',[], 1),
                    new \Dosarkz\LaravelAdmin\Menu('superUser::menu.list', '/admin/main/sliders', 'fa-picture-o',[], 1),
                ], 1),
            ]
        ],
    ]
];
