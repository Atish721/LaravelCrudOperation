<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });
// ->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\HomeController::class, 'index'])->name('products');
Route::get('/show_product', [App\Http\Controllers\ProductController::class, 'showProduct'])->name('show_product');


Route::middleware(['auth'])->group(function () {
    Route::get('/add_product', [App\Http\Controllers\ProductController::class, 'addProduct'])->name('add_product');
    Route::post('/insert_product', [App\Http\Controllers\ProductController::class, 'insertProduct'])->name('insert_product');
    Route::get('/edit_product', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('edit_product');
    Route::put('/update_product', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('update_product');
    Route::delete('/delete_product', [App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('delete_product');
});





