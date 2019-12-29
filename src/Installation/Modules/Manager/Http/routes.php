<?php

Route::group(['middleware' => 'web', 'prefix' => 'image', 'namespace' => 'Dosarkz\Lora\Modules\Image\Http\Controllers'], function()
{
    Route::get('/', 'ImageController@index');
});
