<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

// 홈페이지
Route::get('/', [PostController::class, 'index'])->name('home');

// 로그인, 회원가입
Route::middleware('guest')->group(function () {
    Route::prefix('Login')->group(function () {
        Route::get('/', [SessionsController::class, 'login'])->name('login');
        Route::post('/', [SessionsController::class, 'store'])->name('login');
    });
    Route::prefix('Register')->group(function () {
        Route::get('/', [RegisterController::class, 'register'])->name('register');
        Route::post('/', [RegisterController::class, 'store'])->name('register');
    });
});

Route::middleware('auth')->group(function () {
    //사용자 ID(DB NO.) 노출
    Route::prefix('User/{userID}')->group(function () {
        //사용자 홈페이지
        Route::get('/home', [PostController::class, 'userIndex'])->name('userHome');

        // 로그아웃
        Route::post('/Logout', [SessionsController::class, 'logout'])->name('logout');

        Route::get('/userEdit', [SessionsController::class, 'edit'])->name('userEdit');
        Route::patch('/userUpdate', [SessionsController::class, 'update'])->name('userUpdate');

        Route::get('/userDelete', [SessionsController::class, 'userDeleteNotice'])->name('userDeleteNotice');
    });
});

Route::get('/test', function () {
    return view('components.test');
});
