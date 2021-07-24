<?php


use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;



Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('cache-clear/backend', [HomeController::class,'clearCache'])->name('cache.clear.backend');;

	// dashboard route
	Route::get('/dashboard', function () {
		return view('backend.dashboard');
	})->name('dashboard');


    // Demo route
    Route::get('/demo', function () {
        return view('backend.demo');
    })->name('demo');


	//User      //only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});


    // Profile          //only those have manage_profile Profile will get access
    Route::group(['middleware' => 'can:manage_profile','as' => 'profile.', 'prefix' => 'profile'], function(){
        Route::get('profile/', [ProfileController::class, 'index'])->name('index');
        Route::post('profile/', [ProfileController::class, 'update'])->name('update');
        Route::post('profile/store', [ProfileController::class, 'store'])->name('store');
        // Security
        Route::post('profile/security', [ProfileController::class, 'updatePassword'])->name('password.update');
    });


	//Roles     //only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//Permissions       //only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});



    //Settings      //only those have manage_setting permission will get access
    Route::group(['middleware' => 'can:manage_setting','as' => 'settings.', 'prefix' => 'settings'], function(){
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


    // Backups      //only those have manage_backup permission will get access
    Route::group(['middleware' => 'can:manage_backup','as' => 'settings.', 'prefix' => 'settings'], function(){
        Route::get('backups', [BackupController::class, 'index'])->name('backups.index');
        Route::post('backups', [BackupController::class, 'store'])->name('backups.store');
        Route::delete('app/backups/{backup} ', [BackupController::class, 'destroy'])->name('backups.destroy');

        Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');
        Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
    });





	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);




	//////////////////////////////////////////////////this is all demo with examples//////////////////////////////////////////////////
    // permission examples
    Route::get('/permission-example', function () {
        return view('pages.permission-example');
    });

    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
    Route::get('/table-datatable-edit', function () {
        return view('pages.datatable-editable');
    });

    // Themekit demo pages
    Route::get('/calendar', function () { return view('pages.calendar'); });
    Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
    Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
    Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
    Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
    Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
    Route::get('/form-addon', function () { return view('pages.form-addon'); });
    Route::get('/form-advance', function () { return view('pages.form-advance'); });
    Route::get('/form-components', function () { return view('pages.form-components'); });
    Route::get('/form-picker', function () { return view('pages.form-picker'); });
    Route::get('/invoice', function () { return view('pages.invoice'); });
    Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
    Route::get('/layouts', function () { return view('pages.layouts'); });

    Route::get('/navbar', function () { return view('pages.navbar'); });
    Route::get('/profile', function () { return view('pages.profile'); });
    Route::get('/project', function () { return view('pages.project'); });
    Route::get('/view', function () { return view('pages.view'); });

    Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
    Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
    Route::get('/taskboard', function () { return view('pages.taskboard'); });
    Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
    Route::get('/widget-data', function () { return view('pages.widget-data'); });
    Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
    Route::get('/widgets', function () { return view('pages.widgets'); });

    // themekit ui pages
    Route::get('/alerts', function () { return view('pages.ui.alerts'); });
    Route::get('/badges', function () { return view('pages.ui.badges'); });
    Route::get('/buttons', function () { return view('pages.ui.buttons'); });
    Route::get('/cards', function () { return view('pages.ui.cards'); });
    Route::get('/carousel', function () { return view('pages.ui.carousel'); });
    Route::get('/icons', function () { return view('pages.ui.icons'); });
    Route::get('/modals', function () { return view('pages.ui.modals'); });
    Route::get('/navigation', function () { return view('pages.ui.navigation'); });
    Route::get('/notifications', function () { return view('pages.ui.notifications'); });
    Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
    Route::get('/rating', function () { return view('pages.ui.rating'); });
    Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
    Route::get('/pricing', function () { return view('pages.pricing'); });



Route::get('/register', function () { return view('pages.register'); });
Route::get('/login-1', function () { return view('pages.login'); });

});


//Route::get('/register', function () { return view('pages.register'); });
