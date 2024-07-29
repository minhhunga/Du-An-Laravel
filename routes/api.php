<?php

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

 Route::get('/blog',[App\Http\Controllers\Api\BlogController::class, 'index']);

 Route::get('/product',[App\Http\Controllers\Api\ProductController::class, 'productHome']);
 Route::get('/product/detail/{id}',[App\Http\Controllers\Api\ProductController::class, 'detail']);
 Route::post('/product/add',[App\Http\Controllers\Api\ProductController::class, 'store']);

 Route::post('/login',[App\Http\Controllers\Api\MemberController::class, 'login']); 