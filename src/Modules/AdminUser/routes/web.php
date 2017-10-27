<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\LaravelAdmin\Modules\AdminUser\Http\Controllers'], function () {

    Route::group(['middleware' => 'adminAuth:admin'], function() {
        Route::resource('admin-users','AdminUserController');
    });
});