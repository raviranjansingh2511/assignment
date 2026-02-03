<?php

use App\Http\Controllers\StripeDisputeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\ShortUrlController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index']);


// Route::get('/stripe/verification', function () {
//     return 'Route Hit!';
// });

Route::get('/s/{code}', [ShortUrlController::class, 'redirect'])
     ->name('short_redirect');

Route::get('/denied', [ShortUrlController::class, 'denied'])->name('denied');
Route::group(['middleware' => 'ifnotadmin'], function () {
    Route::get('/admin-login', [LoginController::class, 'index'])->name('adminlogin');
    Route::post('/admin/login-save', [LoginController::class, 'save'])->name('loginsave');
});

Route::group(['prefix' => 'admin', 'middleware' => 'ifadmin'], function () {

    Route::get('/dashboard', [dashboardController::class, 'index'])->name('admin_dashboard');
    Route::get('/change-password', [LoginController::class, 'change_password'])->name('change_password');
    Route::post('/change-password/save', [LoginController::class, 'change_password_save'])->name('change_password_save');
    Route::get('/view-profile', [LoginController::class, 'view_profile'])->name('view_profile');
    Route::post('/update-profile', [LoginController::class, 'update_profile'])->name('update_profile');
    Route::get('/logout', [LoginController::class, 'logout'])->name('adminlogout');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');
    Route::post('/setting-save', [SettingController::class, 'save'])->name('setting_save');


    /*---------------------Admin routes Start---------------------*/
    Route::get('/admin/add/{id?}', [UserController::class, 'add'])->name('admin_add');
    Route::post('/admin/save/{id?}', [UserController::class, 'save'])->name('admin_save');
    Route::get('/admin', [UserController::class, 'index'])->name('admin');
    Route::get('/admin-data', [UserController::class, 'anydata'])->name('admin_data');
    Route::get('/admin/delete', [UserController::class, 'delete'])->name('admin_delete');

     /*---------------------Member routes Start---------------------*/
    // Route::get('/member/add/{id?}', [MemberController::class, 'add'])->name('member_add');
    // Route::post('/member/save/{id?}', [MemberController::class, 'save'])->name('member_save');

    Route::middleware('checkSuperAdmin')->group(function () {
        Route::get('/member/add/{id?}', [MemberController::class, 'add'])->name('member_add');
        Route::post('/member/save/{id?}', [MemberController::class, 'save'])->name('member_save');
        Route::get('/short_url/add/{id?}', [ShortUrlController::class, 'add'])->name('short_url_add');
        Route::post('/short_url/save/{id?}', [ShortUrlController::class, 'save'])->name('short_url_save');
    });
    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::get('/member-data', [MemberController::class, 'anydata'])->name('member_data');
    Route::get('/member/delete', [MemberController::class, 'delete'])->name('member_delete');

    /*---------------------Short Url routes Start---------------------*/
    
    Route::get('/short_url', [ShortUrlController::class, 'index'])->name('short_url');
    Route::get('/short_url-data', [ShortUrlController::class, 'anydata'])->name('short_url_data');
    Route::get('/short_url/delete', [ShortUrlController::class, 'delete'])->name('short_url_delete');
   


        
});



Route::get('/errors/page', function () {
    return view('errors.404');
})->name('errors.page');