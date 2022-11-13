<?php

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

Route::controller(\App\Http\Controllers\ProductController::class)->group(function (){
    Route::get('/products', 'index');
    Route::get('/products/find/{id}', 'show');
    Route::get('/products/search-by-name-or-category/{searchText}', 'getAllProductsWithNameOrCategory');
    Route::get('/products/search-by-category/{searchText}', 'getAllProductsWithSpecificCategory');
    Route::get('/products/get-all-with-image/', 'getAllProductsWithImage');
    Route::get('/products/get-all-without-image/', 'getAllProductsWithoutImage');
    Route::post('/products', 'store');
    Route::put('/products/{product}', 'update');
    Route::delete('/products/{id}', 'delete');
});

