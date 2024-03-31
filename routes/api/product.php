<?php

use App\Http\Controllers\api\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|api route for product
|
*/

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/get-products',             [ProductController::class, 'index']);
    Route::post('/product/store',          [ProductController::class, 'store']);
    Route::get('/get-product/{id}',         [ProductController::class, 'show']);
    Route::post('/product/edit/{product}',    [ProductController::class, 'update']);
    Route::delete('/product/delete/{product}', [ProductController::class, 'destroy']);

});


