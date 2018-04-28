<?php

namespace Dosarkz\Dosmin\Modules\Menu\Models;

use Dosarkz\Dosmin\Models\I18nModel;
use Dosarkz\Dosmin\Models\Module;

class Menu extends I18nModel
{
    const TYPE_LEFT_SIDE_MENU = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ru', 'name_en','alias', 'type_id', 'module_id', 'status_id', 'user_id', 'position'
    ];

    public $timestamps = true;


    public function getTypesAttribute()
    {
        return [self::TYPE_LEFT_SIDE_MENU => trans('admin::base.left_menu')];
    }

    public function getModulesAttribute()
    {
        return Module::pluck('name_'.app()->getLocale(),'id');
    }

    public function getStatusAttribute()
    {
        return $this->statuses[$this->status_id];
    }

    public function getStatusesAttribute()
    {
        return [
            0 => trans('admin::base.deactivate'),
            1 => trans('admin::base.active')
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
