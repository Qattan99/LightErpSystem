<?php

use App\Modules\Products\Controllers\ProductController;
use App\Modules\ProductTypes\Controllers\ProductTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/products/searchProduct', [ProductController::class, 'searchForProduct']);
Route::post('/products/createProduct', [ProductController::class, 'createProduct']);
Route::post('/products/deleteProduct', [ProductController::class, 'deleteProduct']);

Route::get('/productTypes/getTypes', [ProductTypeController::class, 'getTypes']);
Route::post('/productTypes/productDetails', [ProductController::class, 'productDetails']);


