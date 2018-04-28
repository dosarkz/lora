<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'Dosarkz\Dosmin\Modules\Role\Http\Controllers'], function () {

    Route::group(['middleware' => ['guardAuth:admin', 'role:admin']], function() {
        Route::resource('role','BackendController');
    });
});
