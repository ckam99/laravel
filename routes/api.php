<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->removePermission('delete_admin');
    return $user->getPermissions(['delete_admin']);
    // return [
    //     'roles' => $user->roles,
    //     'permissions' => $user->permissions
    // ];
    dump($user->can('delete_user'));
    dump($user->can('delete_admin'));
    dump($user->can('update_user'));
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/auth/me', [AuthController::class, 'me'])->middleware('can:create_admin');
Route::apiResource('users', AuthController::class);
Route::post('/users/{id}/permissions', [AuthController::class, 'setPermissions']);
Route::post('/users/{id}/permissions/remove', [AuthController::class, 'removePermissions']);
Route::get('/users/{id}/permissions/revoke', [AuthController::class, 'revokePermissions']);
Route::post('/users/{id}/role', [AuthController::class, 'setRole']);
Route::post('/users/{id}/role/revoke', [AuthController::class, 'revokeRole']);
Route::apiResource('posts', PostController::class);
