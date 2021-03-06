<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Models;

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
