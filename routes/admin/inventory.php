<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('Inventory')->group(function () {
        Route::get('/', [
            'as' => 'inventory.index',
            'uses' => 'App\Http\Controllers\InventoryController@index',
            'middleware' => 'can:inventory_list'
        ]);
        Route::get('/create', [
            'as' => 'inventory.create',
            'uses' => 'App\Http\Controllers\InventoryController@create',
            'middleware' => 'can:inventory_add'
        ]);
        Route::post('/store', [
            'as' => 'inventory.store',
            'uses' => 'App\Http\Controllers\InventoryController@store',
        ]);
        Route::post('/search', [
            'as' => 'inventory.search',
            'uses' => 'App\Http\Controllers\InventoryController@search',
        ]);
        Route::get('/detail/{id}', [
            'as' => 'inventory.detail',
            'uses' => 'App\Http\Controllers\InventoryController@detail',
        ]);
    });
});

