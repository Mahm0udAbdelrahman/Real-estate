<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Member\FrontController;
use App\Http\Controllers\Member\LoginController;
use App\Http\Controllers\Member\AnswerController;
use App\Http\Controllers\Member\AddInsuranceController;
use App\Http\Controllers\Member\SubscriptionController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::group(['prefix' => 'member'], function () {

            Route::get('/register', function () {
                return view('members.auth.register');
            })->name('register');

            Route::get('/profile', function () {
                return view('members.auth.profile');
            })->name('myprofile');

            Route::get('home', function () {
                return view('members.dashboard.home');
            })->name('member.home');

        Route::get('/login', [LoginController::class, "loginView"])->name('member.login_page');
        Route::post('/login', [LoginController::class, "login"])->name('member.login');
        Route::get('/logout', [LoginController::class, "logout"])->name('member.logout');




        Route::resource('members' , MemberController::class)->only('create','store');
        Route::resource('add_insurances' , AddInsuranceController::class);
        Route::resource('answers' , AnswerController::class);
        // Route::resource('subscriptions' , SubscriptionController::class);
        // Route::get('/payments/verify/{payment?}',[FrontController::class,'payment_verify'])->name('verify-payment');


            Route::get('plans', [SubscriptionController::class, 'index']);
            Route::get('plans/{plan}', [SubscriptionController::class, 'show'])->name("plans.show");
            Route::post('subscription', [SubscriptionController::class, 'subscription'])->name("subscription.create");


        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');



        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        });
    });