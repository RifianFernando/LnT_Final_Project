<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;

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

Route::get('/', [AdminController::class, 'home'])->name('home');

Route::get('/AboutUs', function () {
    return view('about', ['title' => 'About Us']);
})->name('about');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//admin
Route::group(['middleware' => AdminMiddleware::class], function () {
    Route::get('/createProduct', [AdminController::class, 'createProduct'])->name('createProduct');

    Route::get('/dashboardAdmin', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');

    Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');

    Route::post('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
});
