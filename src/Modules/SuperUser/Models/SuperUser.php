<?php

namespace Dosarkz\LaravelAdmin\Modules\SuperUser\Models;

use Dosarkz\LaravelAdmin\Modules\Image\Models\Image;
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

    public function isAdmin()
    {
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'avatar');
    }


}
