<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//admin
Route::group(['middleware' => AdminMiddleware::class], function () {
    Route::get('/createProduct', [AdminController::class, 'createProduct'])->name('createProduct');

    Route::get('/dashboardAdmin', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');
    
    Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
});
