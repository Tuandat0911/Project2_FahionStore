<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware' => 'can:product_list'
        ]);
        Route::get('/history', [
            'as' => 'product.history',
            'uses' => 'App\Http\Controllers\AdminProductController@history',
        ]);
        Route::get('/create', [
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware' => 'can:product_add'
        ]);
        Route::post('/store', [
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
            'middleware' => 'can:product_edit,id'
        ]);
        Route::post('/update/{id}', [
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'product.destroy',
            'uses' => 'App\Http\Controllers\AdminProductController@destroy',
            'middleware' => 'can:product_delete,id',
        ]);
        Route::get('/restore/{id}', [
            'as' => 'product.restore',
            'uses' => 'App\Http\Controllers\AdminProductController@restore',
        ]);
    });
});
