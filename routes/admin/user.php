<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('user')->group(function () {
        Route::get('/', [
            'as' => 'user.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index',
            'middleware' => 'can:user_list'
        ]);
        Route::get('/create', [
            'as' => 'user.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create',
            'middleware' => 'can:user_add'
        ]);
        Route::post('/store', [
            'as' => 'user.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'user.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit',
            'middleware' => 'can:user_edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'user.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'user.destroy',
            'uses' => 'App\Http\Controllers\AdminUserController@destroy',
            'middleware' => 'can:user_delete'
        ]);
    });
});
