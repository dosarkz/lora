<?php

return [
    'model' => \Dosarkz\LaravelAdmin\Modules\AdminUser\Models\AdminUser::class,
    'menu'=> [
       trans('adminUser::menu.index'), '/admin/main','fa-file-text-o',[
            trans('adminUser::menu.create'), '/admin/main/sliders', 'fa-picture-o',[], 1,
            trans('adminUser::menu.list'), '/admin/main/sliders', 'fa-picture-o',[], 1,
        ]
    ]
];
