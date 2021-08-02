<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
    use App\Http\Controllers\FrontendController;

//for shared hosting
Route::get(
    '/migrate',
    function () {
        Artisan::call('migrate:fresh --seed');
        notify()->success('All Table Successfully Migrated.', 'Success');
        return redirect()->back();
    }
);
Route::get(
    '/storage-link',
    function () {
        Artisan::call('storage:link');
        notify()->success('Storage Successfully Linked.', 'Success');
        return redirect()->back();
    }
);

Route::get(
    '/cache-clear',
    function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        notify()->success('All cache Successfully Cleared.', 'Success');
        return redirect()->back();
    }
);


//frontend routes
    Route::group(['as' => 'frontend.'], function () {
        Route::get('/', [FrontendController::class, 'index'])->name('home');

    });


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);

Route::get(
    'password/forget',
    function () {
        return view('pages.forgot-password');
    }
)->name('password.forget');

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

