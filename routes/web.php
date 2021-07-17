<?php

use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;

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
Route::get('/', function () { return view('home'); });


Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () {
	return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route
	Route::get('/dashboard', function () {

		return view('backend.dashboard');
	})->name('dashboard');


    // Demo route
    Route::get('/demo', function () {

        return view('backend.demo');
    })->name('demo');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});



    //only those have manage_setting permission will get access
    Route::group(['middleware' => 'can:manage_setting|manage_user','as' => 'settings.', 'prefix' => 'settings'], function(){
        Route::get('general', [SettingController::class, 'index'])->name('index');
        Route::patch('general', [SettingController::class, 'update'])->name('update');

        Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance.index');
        Route::patch('appearance', [SettingController::class, 'updateAppearance'])->name('appearance.update');

        Route::get('mail', [SettingController::class, 'mail'])->name('mail.index');
        Route::patch('mail', [SettingController::class, 'updateMailSettings'])->name('mail.update');

        Route::get('socialite', [SettingController::class, 'socialite'])->name('socialite.index');
        Route::patch('socialite', [SettingController::class, 'updateSocialiteSettings'])->name('socialite.update');
        Route::get('clear/cache', [SettingController::class, 'clear_cache'])->name('cache.clear');
    });




    //only those have manage_profile Profile will get access
    Route::group(['middleware' => 'can:manage_profile','as' => 'profile.', 'prefix' => 'profile'], function(){
		Route::get('profile/', [ProfileController::class, 'index'])->name('index');
		Route::post('profile/', [ProfileController::class, 'update'])->name('update');
		Route::post('profile/store', [ProfileController::class, 'store'])->name('store');
    });







	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


});


//Route::get('/register', function () { return view('pages.register'); });
