<?php

namespace Dosarkz\LaravelAdmin\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const STATUS_DEFAULT = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'parent_role_id', 'status_id',
    ];

    public $timestamps = false;

}
