<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api', 'xday-header']], function () {
    Route::group(['prefix' => 'widget'], function () {
        Route::get('/', 'WidgetController@index');
        Route::post('/', 'WidgetController@create');
        Route::get('/{widget}', 'WidgetController@show');
        Route::patch('/{widget}', 'WidgetController@update');
        Route::delete('/{widget}', 'WidgetController@delete');
    });
});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'guest:api'
], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});
