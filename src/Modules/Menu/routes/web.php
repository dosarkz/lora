<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\LaravelAdmin\Modules\Menu\Http\Controllers'], function () {

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::resource('menu','MenuController');
        Route::resource('menu.items', 'MenuItemController');
    });
});