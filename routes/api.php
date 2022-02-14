<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/index', [ProductController::class,'index']);
Route::post('/store', [ProductController::class,'store']);
Route::get('/show/{id}', [ProductController::class,'show']);
Route::put('/update/{id}', [ProductController::class,'update']);
Route::put('/destroy/{id}', [ProductController::class,'destroy']);