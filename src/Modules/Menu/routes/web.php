<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'App\Modules\Menu\Http\Controllers'], function () {

    Route::group(['middleware' => ['guardAuth:admin', 'role:admin']], function() {
        Route::resource('menu','MenuController');
        Route::resource('menu.items', 'MenuItemController');
    });
});