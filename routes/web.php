<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth::routes(['register'=>false]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');
Route::get('/products/import', [ProductController::class, 'upload'])->middleware('auth');
Route::post('/products/import', [ProductController::class, 'import'])->name('products.import')->middleware('auth');
Route::delete('/products/delete', [ProductController::class, 'delete'])->name('products.delete')->middleware('auth');



