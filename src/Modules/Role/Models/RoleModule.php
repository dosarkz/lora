<?php

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModule extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'module_id', 'status_id',
    ];

    public $timestamps = false;


    public function getStatusAttribute()
    {
        return array_key_exists($this->status_id, $this->statuses) ? $this->statuses[$this->status_id] : 'none';
    }

    public function getStatusesAttribute()
    {
        return [
            self::STATUS_ACTIVE   =>  trans('admin::base.active'),
            self::STATUS_DISABLE   =>  trans('admin::base.deactivate')
        ];
    }



}
