<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('order')->group(function () {
        Route::get('/', [
            'as' => 'order.index',
            'uses' => 'App\Http\Controllers\AdminOrderController@index',
            'middleware' => ('can:order_list')
        ]);

        Route::get('/updateOrderStatus/{id}', [
           'as' => 'order.updateOrderStatus',
           'uses' => 'App\Http\Controllers\AdminOrderController@updateOrderStatus',
            'middleware' => ('can:order_edit')
        ]);

        Route::get('/cancelOrder/{id}', [
            'as' => 'order.cancelOrder',
            'uses' => 'App\Http\Controllers\AdminOrderController@cancelOrder',
        ]);
    });
});
