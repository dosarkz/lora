<?php

namespace Dosarkz\Dosmin\Modules\Article\Models;

use Dosarkz\Dosmin\Modules\Image\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'url', 'description', 'short_description', 'views','image_id','language','category_id',
        'status_id','created_at','user_id','position', 'view_path'];

    public function getStatusAttribute()
    {
        return ['0'=> 'Не активен', 1 => 'Активен'][$this->status_id];
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}