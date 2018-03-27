<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\Dosmin\Modules\Article\Http\Controllers'], function () {

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::resource('article','BackendController');
        Route::delete('article/{id}/image', 'BackendController@removeImage');
    });
});

Route::group([
    'middleware' => [ 'web'],
    'namespace' => 'Dosarkz\Dosmin\Modules\Article\Http\Controllers'], function () {
    Route::group([
        'prefix' => 'article',
    ], function () {
        Route::get('/','FrontendController@index');
        Route::get('/{alias}','FrontendController@show');
    });



});