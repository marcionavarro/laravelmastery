<?php

use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

/**
 * GET /products
 * GET /products/:id
 * POST /products
 * PUT/PATCH /products/:id
 * DELETE /products/:id
 */

Route::apiResource('products', ProductController::class);

/*Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index');
    Route::get('/{product}', 'show');
    Route::post('/', 'store');
    Route::match(['put', 'patch'], '/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});*/
