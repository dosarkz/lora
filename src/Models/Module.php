<?php
namespace Dosarkz\Dosmin\Models;

use App\Modules\Menu\Models\Menu;

class Module extends I18nModel
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 2;

    private  function listDefaultModules()
    {
        return ['superUser','menu', 'role'];
    }

    public $fillable =  [
        'alias','name_ru', 'name_en', 'description_ru', 'description_en','version', 'repository_url',
        'installed', 'tested','icon_id', 'status_id', 'menu_active'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'module_id');
    }

    public function getStatusesAttribute()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_DISABLE    =>  'Отключен'
        ];
    }

    public function getIsNotDefaultAttribute()
    {
        return !in_array($this->alias, $this->listDefaultModules());
    }


}
