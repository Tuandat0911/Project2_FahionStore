<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category_list'
        ]);
        Route::get('/history' , [
            'as' => 'categories.history',
            'uses' => 'App\Http\Controllers\CategoryController@history',
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category_add'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category_edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'categories.destroy',
            'uses' => 'App\Http\Controllers\CategoryController@destroy',
            'middleware' => 'can:category_delete'
        ]);
        Route::get('/restore/{id}', [
            'as' => 'categories.restore',
            'uses' => 'App\Http\Controllers\CategoryController@restore',
        ]);
    });
});

