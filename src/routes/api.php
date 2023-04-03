<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/parameters')->group(function () {
    Route::post('/', [ParameterController::class, 'store']);
    Route::put('/{parameter}', [ParameterController::class, 'update']);
    Route::delete('/{parameter}', [ParameterController::class, 'destroy']);
});

Route::prefix('/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'list']);
    Route::get('/{category}/products', [CategoryController::class, 'listProducts']);
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('/products')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{parameter}', [ProductController::class, 'update']);
        Route::delete('/{parameter}', [ProductController::class, 'destroy']);
    });
});
