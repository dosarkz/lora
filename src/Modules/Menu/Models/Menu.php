<?php

namespace Dosarkz\LaravelAdmin\Modules\Menu\Models;

use Dosarkz\LaravelAdmin\Models\I18nModel;
use Dosarkz\LaravelAdmin\Models\Module;

class Menu extends I18nModel
{
    const TYPE_LEFT_SIDE_MENU = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type_id', 'module_id', 'status_id', 'user_id', 'position'
    ];

    public $timestamps = true;


    public function getTypesAttribute()
    {
        return [self::TYPE_LEFT_SIDE_MENU => 'Левое меню'];
    }

    public function getModulesAttribute()
    {
        return Module::pluck('name_ru','id');
    }

    public function getStatusesAttribute()
    {
        return [
            0 => 'Не активен',
            1 => 'Активен'
        ];
    }
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id');
    }

    public function menuParentItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->whereNull('parent_id');
    }

    public function scopeVisible($query)
    {
        return $query->whereHas('menuRoles', function($dubQuery){
            $dubQuery->whereHas('superUserRoles',function($userQuery){
                $userQuery->where('super_user_id', auth()->guard('admin')->user()->id);
            });
        });
    }

    public function menuRoles()
    {
        return $this->hasMany(MenuRole::class, 'menu_id');
    }

}
