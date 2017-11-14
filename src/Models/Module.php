<?php
namespace Dosarkz\LaravelAdmin\Models;

class Module extends I18nModel
{
    public $fillable =  ['alias','name_ru', 'name_en', 'description_ru', 'description_en','version', 'repository_url',
        'installed', 'tested','icon_id', 'status_id', 'menu_active'
    ];

}
