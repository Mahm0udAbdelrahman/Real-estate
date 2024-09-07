<?php

//use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\LoginController;
use App\Http\Controllers\Doctor\VerificationCodeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//     ],
//     function () { //
//         Route::prefix('doctor')->group(function () {
//         Route::get('/login', [LoginController::class, "loginView"])->name('doctor.login_page');
//         Route::post('/login', [LoginController::class, "login"])->name('doctor.login');
//         Route::delete('/logout', [LoginController::class, "logout"])->name('doctor.logout');


//         Route::get('/verificationcode',[VerificationCodeController::class,'index'])->name('doctor.verificationcode_page');
//         Route::post('/verificationcode',[VerificationCodeController::class,'store'])->name('doctor.verificationcode');

//         Route::group(
//         [
//             'middleware' => []
//         ],
//         function(){
//             Route::get('/adminD', function () {
//                 return view('doctors.home');
//             })->name('doctors.home');


//         });



//     });


//     }
// );