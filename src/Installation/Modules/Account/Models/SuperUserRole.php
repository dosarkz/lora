<?php

namespace Dosarkz\Lora\Modules\SuperUser\Models;

use Illuminate\Database\Eloquent\Model;

class SuperUserRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'super_user_id', 'role_id',
    ];

    public $timestamps = true;

}
