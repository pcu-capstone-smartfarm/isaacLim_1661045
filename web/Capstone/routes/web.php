<?php

use App\Http\Controllers\ArduinoController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SessionsController;
use App\Models\Arduino;
use App\Models\Nongsaro_gardendtl;
use App\Models\Nongsaro_gardenlist;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

        //사용자 정보 수정 페이지
        Route::get('/userEdit', [SessionsController::class, 'edit'])->name('userEdit');
        Route::patch('/userUpdate', [SessionsController::class, 'update'])->name('userUpdate');

        //회원 탈퇴 페이지
        Route::get('/userDelete', [SessionsController::class, 'userDeleteNotice'])->name('userDeleteNotice');

        //최초 가입 시 식물 등록
        Route::get('/plantRegist', [PlantsController::class, 'plantRegisterPage'])->name('plantRegisterPage');
        Route::post('/userVerification', [PlantsController::class, 'plantRegister'])->name('plantRegister');

        //식물 도감 페이지
        Route::get('/plantDict', [PlantsController::class, 'plantSearchPage'])->name('plantDict');
        Route::post('/plantSearch', [PlantsController::class, 'plantSearch'])->name('plantSearch');
        Route::get('/plantDetail/{plantNO}', [PlantsController::class, 'plantDetail'])->name('plantDetail');

        //식물 등록 후 아두이노 대기 페이지
        Route::get('/arduinoRegist', [PostController::class, 'arduinoRegistPage'])->name('arduinoRegisterPage');

        //아두이노 등록 후 센서 값 대기 페이지
        Route::get('/sensorWait', [PostController::class, 'noSensorPage'])->name('noSensorHome');

        //라우트 인자값으로 판별하여 다른값호출하도록 설정
        //센서값 그래프 페이지(토양 습도, 습도, 조도, 온도)
        Route::prefix('reports')->group(function(){
            Route::get('/humidity_soil', [ReportsController::class, 'humiditySoilReports'])->name('reports_humidity_soil');
            Route::get('/humidity', [ReportsController::class, 'humidityReports'])->name('reports_humidity');
            Route::get('/illuminance', [ReportsController::class, 'illuminanceReports'])->name('reports_illuminance');
            Route::get('/temp', [ReportsController::class, 'tempReports'])->name('reports_temp');
        });
    });
});

Route::get('/test', function () {
    return view('components.test', [
        'gardendtl'=>Nongsaro_gardendtl::find(3),
    ]);
});
