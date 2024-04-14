<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

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
    Route::get('/thong-tin-ca-nhan', [UserController::class, 'view'])->name('user.view');
    Route::put('/thong-tin-ca-nhan', [UserController::class, 'profile'])->name('profile');
    Route::put('/doi-mat-khau', [UserController::class, 'changePassword'])->name('change-password');
    Route::prefix('khach-hang')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index')
            ->middleware('permission:List-clients');;
        Route::get('/{id?}', [ClientController::class, 'detail'])->name('client.detail')
            ->middleware('permission:View-clients');
        Route::delete('/{id}', [ClientController::class, 'delete'])->name('client.delete')
            ->middleware('permission:Delete-clients');
    });
    Route::prefix('danh-muc')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index')
            ->middleware('permission:List-categories');
        Route::get('/them-moi', [CategoryController::class, 'create'])->name('category.add')
            ->middleware('permission:Create-categories');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{id?}', [CategoryController::class, 'detail'])->name('category.detail')
            ->middleware('permission:View-categories');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{id}', [CategoryController::class, 'delete'])->name('category.delete')
            ->middleware('permission:Delete-categories');
    });
    Route::prefix('san-pham')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index')
            ->middleware('permission:List-products');
        Route::get('/them-moi', [ProductController::class, 'create'])->name('product.add')
            ->middleware('permission:Create-products');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{id?}', [ProductController::class, 'detail'])->name('product.detail')
            ->middleware('permission:Edit-products');
        Route::post('/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{id}', [ProductController::class, 'delete'])->name('product.delete')
            ->middleware('permission:Delete-products');
    });
    Route::prefix('don-hang')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index')
            ->middleware('permission:List-orders');
        Route::get('/{id?}', [OrderController::class, 'detail'])->name('order.detail')
            ->middleware('permission:View-orders');
        Route::put('/{id}', [OrderController::class, 'update'])->name('order.update');
        Route::delete('/{id}', [OrderController::class, 'delete'])->name('order.delete')
            ->middleware('permission:Delete-orders');
    });

    Route::prefix('nhan-vien')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index')
            ->middleware('permission:List-users');
        Route::get('/them-moi', [UserController::class, 'create'])->name('user.add')
            ->middleware('permission:Create-users');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id?}', [UserController::class, 'detail'])->name('user.detail')
            ->middleware('permission:Edit-users');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('user.delete')
            ->middleware('permission:Delete-users');
    });

    Route::middleware('role:Supper-admin')->group(function () {
        Route::prefix('phan-quyen')->name('permission.')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('/{id?}', [PermissionController::class, 'detail'])->name('detail');
        });
    });
});

