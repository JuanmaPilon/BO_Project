<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('contact', [ContactController::class, 'index']);
Route::post('contact', [ContactController::class, 'store']);
Route::get('contact/{id}', [ContactController::class,'show']);
Route::get('contact/{id}/edit', [ContactController::class,'edit']);
Route::put('contact/{id}/edit', [ContactController::class,'update']);
Route::delete('contact/{id}/delete', [ContactController::class,'destroy']);
Route::post('login', [UsersController::class,'login']);
Route::group([
    'middleware' => ['auth:api']
], function() {
    Route::get('user', [UsersController::class,'user']);
    Route::get('refresh', [UsersController::class,'refreshToken']);
    Route::get('logout', [UsersController::class,'logout']);
});