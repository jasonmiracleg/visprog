<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('all_user', [UserController::class, 'getAllUser']);
Route::post('create_user', [UserController::class, 'createUser']);

Route::post('login', [AuthenticationController::class, 'login']);


Route::middleware('auth:sanctum')->group( // Tokenize certain routes
    function () {
        Route::get('all_user', [UserController::class, 'getAllUser']);
        Route::get('check_password', [UserController::class, 'checkPassword']);

        Route::patch('update_user', [UserController::class, 'updateUser']);
        Route::delete('delete_user', [UserController::class, 'deleteUser']);

        Route::post('create_favorit', [FavoriteController::class, 'createFavorit']);
        Route::get('favorits', [FavoriteController::class, 'ListFavorit']);
        Route::delete('delete_favorit', [FavoriteController::class, 'deleteFavorit']);
        Route::delete('logout', [AuthenticationController::class, 'logout']);
    }
); // Security