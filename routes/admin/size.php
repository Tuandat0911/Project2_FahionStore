<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('size')->group(function () {
        Route::get('/', [
            'as' => 'size.index',
            'uses' => 'App\Http\Controllers\SizeController@index',
            'middleware' => 'can:size_list'
        ]);
        Route::get('/create', [
            'as' => 'size.create',
            'uses' => 'App\Http\Controllers\SizeController@create',
            'middleware' => 'can:size_add'
        ]);
        Route::post('/store', [
            'as' => 'size.store',
            'uses' => 'App\Http\Controllers\SizeController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'size.edit',
            'uses' => 'App\Http\Controllers\SizeController@edit',
            'middleware' => 'can:size_edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'size.update',
            'uses' => 'App\Http\Controllers\SizeController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'size.destroy',
            'uses' => 'App\Http\Controllers\SizeController@destroy',
            'middleware' => 'can:size_delete'
        ]);
    });
});

