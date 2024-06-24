<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('permission')->group(function () {
        Route::get('/create', [
            'as' => 'permission.create',
            'uses' => 'App\Http\Controllers\AdminPermissions@createPermissions'
        ]);

        Route::post('/store', [
            'as' => 'permission.store',
            'uses' => 'App\Http\Controllers\AdminPermissions@store'
        ]);
    });
});
