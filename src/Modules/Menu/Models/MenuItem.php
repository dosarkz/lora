<?php

namespace App\Modules\Menu\Models;

use Dosarkz\Dosmin\Models\I18nModel;

class MenuItem extends I18nModel
{
    const TYPE_LEFT_SIDE_MENU = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'title_ru', 'title_en', 'icon', 'parent_id', 'position', 'status_id', 'menu_id'
    ];

    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function getStatusesAttribute()
    {
        return [
            0 => 'Не активен',
            1 => 'Активен'
        ];
    }

    public function parents($menu_id)
    {
        return self::where('menu_id', $menu_id)->whereNull('parent_id')->pluck('title_ru', 'id');
    }

    public function subs()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
