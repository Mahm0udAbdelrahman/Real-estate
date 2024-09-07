<?php

//use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Institution\LoginController;
use App\Http\Controllers\Institution\VerificationCodeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Route::group(
//     [
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//     ],
//     function () { //
//         Route::prefix('institution')->group(function () {
//         Route::get('/login', [LoginController::class, "loginView"])->name('institution.login_page');
//         Route::post('/login', [LoginController::class, "login"])->name('institution.login');
//         Route::delete('/logout', [LoginController::class, "logout"])->name('institution.logout');


//         Route::get('/verificationcode',[VerificationCodeController::class,'index'])->name('institution.verificationcode_page');
//         Route::post('/verificationcode',[VerificationCodeController::class,'store'])->name('institution.verificationcode');

//         Route::group(
//         [
//             'middleware' => ['check-institution']
//         ],
//         function(){
//             Route::get('/admin', function () {
//                 return view('institutions.home');
//             })->name('institutions.home');


//         });



//     });


//     }
// );