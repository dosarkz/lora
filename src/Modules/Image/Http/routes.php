<?php

Route::group(['middleware' => 'web', 'prefix' => 'image', 'namespace' => 'Dosarkz\Dosmin\Modules\Image\Http\Controllers'], function()
{
    Route::get('/', 'ImageController@index');
});
