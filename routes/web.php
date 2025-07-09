<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirectBasedOnRole());

Route::middleware('auth')->group(function () {
    Route::get('/admin', fn() => redirectBasedOnRole());

    // Redirect versi kapital
    Route::redirect('/Admin', '/admin', 301);
});

function redirectBasedOnRole() {
    if (Auth::check() && Auth::user()->role == 'admin') {
        return redirect()->route('Admin.index');
    }

    return redirect()->route('home');
}

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/loginCust', function () {
    return view('auth.login');
})->name('loginCust');

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/Cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/Produk/{id}', [HomeController::class, 'produk'])->name('produk');
    
    Route::prefix('Admin')->name('Admin.')->group(function () {
        if (Auth::check() && Auth::user()->role != 'admin') {
            return redirect()->route('home');
        }
        Route::prefix('Users')->name('Users.')->group(function () {
            Route::post('status', [UsersController::class, 'status'])->name('status');
        });
        Route::resource('Users', UsersController::class);

        Route::prefix('Product')->name('Product.')->group(function () {
            Route::post('status', [ProductController::class, 'status'])->name('status');
        });
        Route::resource('Product', ProductController::class);
    });
    Route::resource('Admin', AdminController::class);
});
