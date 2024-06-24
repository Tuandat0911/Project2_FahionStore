<?php
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::prefix('setting')->group(function () {
        Route::get('/', [
            'as' => 'setting.index',
            'uses' => 'App\Http\Controllers\SettingController@index',
            'middleware' => 'can:setting_list'
        ]);
        Route::get('/create', [
            'as' => 'setting.create',
            'uses' => 'App\Http\Controllers\SettingController@create',
            'middleware' => 'can:setting_add'
        ]);
        Route::post('/store', [
            'as' => 'setting.store',
            'uses' => 'App\Http\Controllers\SettingController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'setting.edit',
            'uses' => 'App\Http\Controllers\SettingController@edit',
            'middleware' => 'can:setting_edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'setting.update',
            'uses' => 'App\Http\Controllers\SettingController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'setting.destroy',
            'uses' => 'App\Http\Controllers\SettingController@destroy',
            'middleware' => 'can:setting_delete'
        ]);
    });
});
