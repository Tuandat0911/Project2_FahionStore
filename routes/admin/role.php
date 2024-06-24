<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('role')->group(function () {
        Route::get('/', [
            'as' => 'role.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index',
            'middleware' => 'can:role_list'
        ]);
        Route::get('/create', [
            'as' => 'role.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create',
            'middleware' => 'can:role_add'
        ]);
        Route::post('/store', [
            'as' => 'role.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'role.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit',
            'middleware' => 'can:role_edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'role.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'role.destroy',
            'uses' => 'App\Http\Controllers\AdminRoleController@destroy',
            'middleware' => 'can:role_delete'
        ]);
    });
});
