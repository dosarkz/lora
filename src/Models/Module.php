<?php
namespace Dosarkz\LaravelAdmin\Models;


use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $fillable =  ['alias','name_ru', 'name_en', 'description', 'version', 'repository_url', 'installed',
        'tested','icon_id', 'status_id'
    ];

}
