<?php
namespace Dosarkz\LaravelAdmin\Models;

use Dosarkz\LaravelAdmin\Modules\Menu\Models\Menu;

class Module extends I18nModel
{
    public $fillable =  [
        'alias','name_ru', 'name_en', 'description_ru', 'description_en','version', 'repository_url',
        'installed', 'tested','icon_id', 'status_id', 'menu_active'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'module_id');
    }


}
