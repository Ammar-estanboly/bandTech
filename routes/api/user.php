<?php

use App\Http\Controllers\api\User\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/get-users',             [UserController::class, 'index']);
    Route::post('/users/store',          [UserController::class, 'store']);
    Route::get('/get-user/{id}',         [UserController::class, 'show']);
    Route::post('/users/edit/{user}',    [UserController::class, 'update']);
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy']);

});


