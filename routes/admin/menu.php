<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('menu')->group(function () {
        Route::get('/', [
            'as' => 'menu.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => ('can:menu_list')
        ]);
        Route::get('/create', [
            'as' => 'menu.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware' => ('can:menu_add')
        ]);
        Route::post('/store', [
            'as' => 'menu.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware' => ('can:menu_edit')
        ]);
        Route::post('/update/{id}', [
            'as' => 'menu.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'menu.destroy',
            'uses' => 'App\Http\Controllers\MenuController@destroy',
            'middleware' => ('can:menu_delete')
        ]);
    });
});
