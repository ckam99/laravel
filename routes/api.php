<?php

use App\Http\Controllers\Api\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TweetController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/redoc', function (Request $request) {
    return view('docs.redoc');
});
Route::get('/docs', function (Request $request) {
    return view('docs.swagger');
});
Route::get('/tweets', [TweetController::class, 'index'])->name('list-tweet');
Route::get('/tweets/{id}', [TweetController::class, 'show'])->name('show-tweet');

Route::post('/images', [ImageController::class, 'upload']);
