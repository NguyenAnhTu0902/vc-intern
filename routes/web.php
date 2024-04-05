<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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
Route::get('dang-nhap', function(){
    if (Auth::check()) {
        return redirect()->route('home');
    } else return view('auth.login');
})->name('login-page');

Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/', [HomePageController::class, 'index'])->name('home');
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('khach-hang')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
    });

    Route::prefix('danh-muc')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/them-moi', [CategoryController::class, 'create'])->name('category.add');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id?}', [CategoryController::class, 'detail'])->name('category.detail');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::prefix('san-pham')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
    });
});

