<?php
namespace Dosarkz\Lora\Installation\Modules\Lora\Models;


use Dosarkz\Lora\Installation\Utilities\Models\I18nModel;

class Module extends I18nModel
{
    const STATUS_DEFAULT = 1;
    const STATUS_NEW = 2;

    public $fillable =  [
        'alias','name_ru', 'name_en', 'description_ru', 'description_en','version', 'repository_url',
        'installed', 'tested','icon_id', 'status_id', 'menu_active'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'module_id');
    }
}
