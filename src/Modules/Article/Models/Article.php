<?php

namespace App\Modules\Article\Models;

use Dosarkz\Dosmin\Models\I18nModel;
use App\Modules\Image\Models\Image;

class Article extends I18nModel
{
    protected $fillable = ['title', 'url', 'description', 'short_description', 'views','image_id','language','category_id',
        'status_id','created_at','user_id','position', 'view_path'];

    public function getStatusAttribute()
    {
        return $this->statuses[$this->status_id];
    }

    public function getStatusesAttribute()
    {
        return [
            0 => trans('admin::base.deactivate'),
            1 => trans('admin::base.active')
        ];
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}