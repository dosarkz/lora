<?php

namespace Dosarkz\LaravelAdmin\Modules\Menu\Models;

use Dosarkz\LaravelAdmin\Modules\SuperUser\Models\SuperUserRole;
use Illuminate\Database\Eloquent\Model;

class MenuRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'menu_id', 'status_id'
    ];

    public $timestamps = true;

    public function superUserRoles()
    {
        return $this->hasMany(SuperUserRole::class, 'role_id', 'role_id');
    }

}
