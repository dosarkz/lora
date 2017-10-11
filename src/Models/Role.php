<?php

namespace Dosarkz\LaravelAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'parent_role_id', 'status_id',
    ];


}
