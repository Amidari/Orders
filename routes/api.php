<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function (): void {
    Route::prefix('warehouses')->group(function (): void {
        Route::get('/', \App\Http\Controllers\Warehouses\IndexController::class);
        Route::post('/', \App\Http\Controllers\Warehouses\StoreController::class);
        Route::post('/{warehouse}/update', \App\Http\Controllers\Warehouses\UpdateController::class);
        Route::post('/{warehouse}/delete', \App\Http\Controllers\Warehouses\DestroyController::class);
    });
    Route::prefix('product')->group(function (): void {
        Route::get('/', \App\Http\Controllers\Product\IndexController::class);
        Route::post('/', \App\Http\Controllers\Product\StoreController::class);
        Route::post('/{product}/update', \App\Http\Controllers\Product\UpdateController::class);
        Route::post('/{product}/delete', \App\Http\Controllers\Product\DestroyController::class);
    });
    Route::prefix('stocks')->group(function (): void {
        Route::get('/', \App\Http\Controllers\Stock\IndexController::class);
        Route::post('/', \App\Http\Controllers\Product\StoreController::class);
    });
    Route::prefix('order')->group(function (): void {
        Route::get('/', \App\Http\Controllers\Order\IndexController::class);
        Route::get('/{order}/show', \App\Http\Controllers\Order\ShowController::class);
        Route::get('/{order}/completed', \App\Http\Controllers\Order\Status\CompletedController::class);
        Route::get('/{order}/canceled', \App\Http\Controllers\Order\Status\CanceledController::class);
        Route::get('/{order}/active', \App\Http\Controllers\Order\Status\ActiveController::class);
        Route::post('/create', \App\Http\Controllers\Order\CreateController::class);
        Route::post('/addProduct', \App\Http\Controllers\Order\AddProductController::class);
        Route::post('/deleteProduct', \App\Http\Controllers\Order\DeleteProductController::class);
        Route::post('/refresh', \App\Http\Controllers\Order\RefreshController::class);
    });
    Route::prefix('movements')->group(function (): void {
        Route::post('/', \App\Http\Controllers\Movement\IndexController::class);
    });

}
);
