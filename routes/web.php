<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user=\App\Models\User::find(2);
    $product = $user->store->products->find(2);
    //$product->characteristics->find(1)->properties;
    $product->setAttribute('characteristics', $product->characteristics()->with('properties')->get());

    return $product;
    
    dd($user->posts);
    return view('welcome');
});