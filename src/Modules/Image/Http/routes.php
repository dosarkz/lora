<?php

Route::group(['middleware' => 'web', 'prefix' => 'image', 'namespace' => 'Dosarkz\LaravelAdmin\Modules\Image\Http\Controllers'], function()
{
    Route::get('/', 'ImageController@index');
});
