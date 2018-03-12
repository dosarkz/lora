<?php

namespace App\Modules\Office\Models;

use Dosarkz\LaravelAdmin\Modules\Image\Models\Image;
use Illuminate\Database\Eloquent\Model;

class OfficeImage extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVATE  = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image_id', 'office_id', 'status_id'];
    public $timestamps = true;


    public function getStatusesAttribute()
    {
        return [
            0 => 'Не активен',
            1 => 'Активен'
        ];
    }

    public function getStatusAttribute()
    {
        return $this->statuses[$this->status_id];
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
