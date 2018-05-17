<?php

Route::group(['middleware' => 'web', 'prefix' => 'image', 'namespace' => 'App\Modules\Image\Http\Controllers'], function()
{
    Route::get('/', 'ImageController@index');
});
