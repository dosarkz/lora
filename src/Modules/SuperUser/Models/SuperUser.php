<?php

namespace Dosarkz\Dosmin\Modules\SuperUser\Models;

use Dosarkz\Dosmin\Modules\Image\Models\Image;
use Dosarkz\Dosmin\Modules\Role\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperUser extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'role_id','user_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = true;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'avatar');
    }

    public function currentUser($id)
    {
        return auth()->guard('admin')->user()->id == $id;
    }

    public function hasRole($role)
    {
        return SuperUser::whereHas('role', function($query) use($role)
        {
            $query->where('id', auth()->guard('admin')->user()->role_id)
            ->where('alias', $role);
        })->first();
    }


}
