<?php

namespace Dosarkz\LaravelAdmin\Modules\Image\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name',  'path', 'user_id', 'status_id', 'url'
    ];


    public function getFile()
    {
        return $this->path .'/'. $this->name;
    }


}
