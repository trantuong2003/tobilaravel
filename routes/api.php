<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AddProductController;


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

// Route::get('/user/{id}', [UserController::class, 'show']);

// Route::get('/users', [UserController::class, 'index']);

// Route::controller(AuthController::class)->group(function(){
//     Route::post('login','login');
//     Route::post('register','register');
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);


Route::get('admin', [AdminController::class, 'index']);


Route::get('category', [CategoryController::class, 'index']);
Route::post('addcategory', [CategoryController::class, 'addCategory']);
Route::delete('deletecategory/{id}', [CategoryController::class, 'destroy']);





Route::resource('products', ProductController::class);

Route::get('product', [ProductController::class, 'index']);
Route::post('add-product', [ProductController::class, 'addProduct']);
Route::get('edit-product/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('update-product/{id}', [ProductController::class, 'update'])->name('update.product');
Route::delete('delete-product/{id}', [ProductController::class, 'destroy']);
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::post('products/{id}/update', [ProductController::class, 'update'])->name('products.update');
Route::get('/products/{id}', [ProductController::class, 'show']);