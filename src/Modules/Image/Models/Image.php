<?php

namespace Dosarkz\LaravelAdmin\Modules\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const STATUS_ACTIVE = 1;

    public $timestamps = true;
    protected $fillable = ['name','thumb','path','status_id'];

    public function getThumb()
    {
        return $this->path .'/'. $this->thumb;
    }

    public function getFullImage()
    {
        if($this->path){
            return $this->path .'/'. $this->name;
        }
        else return false;
    }
}