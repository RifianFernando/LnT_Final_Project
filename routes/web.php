<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;

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

Route::get('/cart', [CartController::class, 'cart'])->middleware('auth')->name('cart');

Route::delete('/remove/{id}', [CartController::class, 'remove'])->middleware('auth')->name('remove.from.cart');

Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->middleware('auth')->name('addToCart');

Route::get('add-to-cart-cart/{id}', [CartController::class, 'addToCartOnCart'])->middleware('auth')->name('addToCartOnCart');

Route::get('increment-cart/{id}', [CartController::class, 'incrementOnCart'])->middleware('auth')->name('incrementOnCart');

Route::get('/search', [CartController::class, 'searchProduct'])->name('searchProduct');

Route::get('/invoice', [CartController::class, 'invoicePage'])->middleware('auth')->name('invoicePage');

Route::post('/invoice/{id}', [CartController::class, 'makeInvoice'])->middleware('auth')->name('makeInvoice');

///

Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');

///

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

    Route::get('/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');

    Route::patch('/updateProduct/{id}', [AdminController::class, 'update'])->name('update');
});
