<?php

namespace App\Modules\Office\Models;

use Dosarkz\LaravelAdmin\Modules\Image\Models\File;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Office extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVATE  = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'floor', 'number', 'area', 'auxiliary_area', 'coefficient_auxiliary_area', 'file_id',
        'status_id'];

    public $timestamps = true;


    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d',strtotime($value));
    }

    public function getCreatedDateMainAttribute()
    {
        Date::setLocale('ru');
        return Date::parse($this->created_at)->format('d.m.Y');
    }

    public function getCreatedDateAttribute()
    {
        Date::setLocale('ru');
        return Date::parse($this->created_at)->format('j F Y');
    }

    public function file()
    {
        return $this->belongsTo(File::class,'file_id');
    }

    public function officeImages()
    {
        return $this->hasMany(OfficeImage::class, 'office_id');
    }

    public function getStatusesAttribute()
    {
        return [
            0 => 'Занят',
            1 => 'Свободен'
        ];
    }

    public function getStatusAttribute()
    {
        return $this->statuses[$this->status_id];
    }

}
