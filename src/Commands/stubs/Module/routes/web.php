<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web'],
    'namespace' => 'App\Modules\Office\Http\Controllers'], function () {

    Route::group(['middleware' => 'guardAuth:admin'], function() {
        Route::resource('office','BackendController');
        Route::delete('office/{id}/remove-file', 'BackendController@removeFile');

        Route::delete('office/{id}/remove-images/{image_id}', 'BackendController@removeImages');
    });
});

Route::group([
    'middleware' => [ 'web'],
    'namespace' => 'App\Modules\Office\Http\Controllers'], function () {
    Route::group([
        'prefix' => 'offices',
    ], function () {
        Route::get('/','FrontendController@index');
        Route::post('/new-order', 'FrontendController@newOrder');
        Route::post('/reservation', 'FrontendController@reservation');
    });



});