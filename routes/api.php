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

Route::match(['get', 'post', 'put', 'patch', 'delete'], '/authication-error', function () {
    return response()->json(['error' => 'Access denied'], 401);
})->name('auth-denied');
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'Api\AuthController@login')->name('auth-login');
    Route::post('/register', 'Api\AuthController@register')->name('auth-register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/users', 'Api\AuthController@list')->name('auth-users');
        Route::post('/logout', 'Api\AuthController@logout')->name('auth-logout');
        Route::match(['post', 'get'], '/me', 'Api\AuthController@me')->name('auth-me');
    });

    Route::group(['prefix' => 'password'], function () {
        Route::post('/forgot', 'Api\AuthController@forgotPassword')->name('auth-password-forgot');
        Route::post('/reset', 'Api\AuthController@resetPassword')->name('auth-password-reset');
        Route::match(['post', 'patch'], '/change', 'Api\AuthController@changePassword')->name('auth-password-change')->middleware('auth:api');
    });
});