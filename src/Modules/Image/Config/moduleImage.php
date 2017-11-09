<?php

return [
    'module' => [
        'name' => 'Image Module',
        'alias' => 'moduleImage',
        'description' => 'Image Module',
        'keywords' => [],
        'status' => 1,
        'providers' => [],
        'aliases' => [],
    ],
    'admin' => [
        'model' => \Dosarkz\LaravelAdmin\Modules\Image\Models\Image::class,
        'menu'=> [
            'active' => false,
            'items' => [
                new \Dosarkz\LaravelAdmin\Menu('superUser::menu.index', '/admin/main','fa-file-text-o',  [
                    new \Dosarkz\LaravelAdmin\Menu('superUser::menu.create', '/admin/main/sliders', 'fa-picture-o',[], 1),
                    new \Dosarkz\LaravelAdmin\Menu('superUser::menu.list', '/admin/main/sliders', 'fa-picture-o',[], 1),
                ], 1),
            ]
        ],
    ]
];
