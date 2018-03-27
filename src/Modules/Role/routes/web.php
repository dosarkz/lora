<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\Dosmin\Modules\Role\Http\Controllers'], function () {

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::resource('role','BackendController');
    });
});
