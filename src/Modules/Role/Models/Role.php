<?php

namespace App\Modules\Role\Models;

use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuRole;
use Dosarkz\Dosmin\Models\I18nModel;
use Dosarkz\Dosmin\Models\Module;
use Illuminate\Database\Eloquent\Collection;

class Role extends I18nModel
{
    const STATUS_DEFAULT = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ru', 'name_en', 'alias', 'parent_role_id', 'status_id',
    ];

    public $timestamps = false;


    public function getStatusAttribute()
    {
        return array_key_exists($this->status_id, $this->statuses) ? $this->statuses[$this->status_id] : 'none';
    }

    public function getStatusesAttribute()
    {
        return [
            1   =>  trans('admin::base.default'),
            2   => trans('admin::base.active'),
            3   =>  trans('admin::base.deactivate')
        ];
    }

    public function getMenusAttribute() : Collection
    {
        return Menu::where('status_id', Menu::STATUS_ACTIVE)->get();
    }

    public function getModulesAttribute(): Collection
    {
        return Module::where('status_id', Module::STATUS_ACTIVE)->get();
    }

    public function roleMenus()
    {
        return $this->hasMany(MenuRole::class, 'role_id');
    }

    public function roleModules()
    {
        return $this->hasMany(RoleModule::class, 'role_id');
    }

}
