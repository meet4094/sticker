<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login');
    Route::get('/login', 'login')->name('login');
    Route::post('/login_data', 'login_data'); 
    Route::get('/logout', 'logout');
});
Auth::routes();
Route::middleware([Authenticate::class])->group(function () {

    //Status Sticker Category
    Route::view('/status_sticker_category', 'Admin/Master/status_sticker_category', ['title' => 'status_sticker_category']);
    Route::post('/add_status_sticker_category', [MasterController::class, 'add_status_sticker_category']);
    Route::get('/status_sticker_category_list', [MasterController::class, 'status_sticker_category_list'])->name('status_sticker_category_list');  // list
    Route::post('/delete_status_sticker_category', [MasterController::class, 'delete_status_sticker_category']);
    Route::post('/get_status_sticker_category_data', [MasterController::class, 'get_status_sticker_category_data']);

    //Status Sticker
    Route::view('/status_sticker', 'Admin/Master/status_sticker', ['title' => 'status_sticker']);
    Route::post('/get_status_sticker_Category', [MasterController::class, 'get_status_sticker_Category']);
    Route::post('/add_status_stickers', [MasterController::class, 'add_status_stickers']);
    Route::get('/status_stickers_list', [MasterController::class, 'status_stickers_list'])->name('status_stickers_list');  // list
    Route::post('/delete_status_sticker', [MasterController::class, 'delete_status_sticker']);
    Route::post('/get_status_sticker_data', [MasterController::class, 'get_status_sticker_data']);
    
    //Status Text Category
    Route::view('/status_text_category', 'Admin/Master/status_text_category', ['title' => 'status_text_category']);
    Route::post('/add_status_text_category', [MasterController::class, 'add_status_text_category']);
    Route::get('/status_text_category_list', [MasterController::class, 'status_text_category_list'])->name('status_text_category_list');  // list
    Route::post('/delete_status_text_category', [MasterController::class, 'delete_status_text_category']);
    Route::post('/get_status_text_category_data', [MasterController::class, 'get_status_text_category_data']);

    //Status Text
    Route::view('/status_text', 'Admin/Master/status_text', ['title' => 'status_text']);
    Route::post('/get_status_text_Category', [MasterController::class, 'get_status_text_Category']);
    Route::post('/add_status_texts', [MasterController::class, 'add_status_texts']);
    Route::get('/status_texts_list', [MasterController::class, 'status_texts_list'])->name('status_texts_list');  // list
    Route::post('/delete_status_text', [MasterController::class, 'delete_status_text']);
    Route::post('/get_status_text_data', [MasterController::class, 'get_status_text_data']);

    // Api Call
    Route::view('/api_call', 'Admin/Master/api_call', ['title' => 'api_call']);
    Route::get('/api_call_list', [MasterController::class, 'api_call_list'])->name('api_call_list');  // list

    // App Setting
    Route::view('/app_setting', 'Admin/Master/app_setting', ['title' => 'app_setting']);
    Route::post('/add_app', [MasterController::class, 'add_app']);
    Route::get('/app_data_list', [MasterController::class, 'app_data_list'])->name('app_data_list');  // list
    Route::post('/delete_app_data', [MasterController::class, 'delete_app_data']);
    Route::post('/get_app_data', [MasterController::class, 'get_app_data']);
    Route::post('/get_App', [MasterController::class, 'get_App']);

    // App By Sticker Category
    Route::view('/app_by_sticker_category', 'Admin/Master/app_by_sticker_category', ['title' => 'appbystickercategory']);
    Route::post('/add_app_by_sticker_category', [MasterController::class, 'add_app_by_sticker_category']);
    Route::get('/app_by_sticker_category_list', [MasterController::class, 'app_by_sticker_category_list'])->name('app_by_sticker_category_list');  // list
    Route::post('/delete_app_by_sticker_category', [MasterController::class, 'delete_app_by_sticker_category']);
    Route::post('/get_app_by_sticker_category_data', [MasterController::class, 'get_app_by_sticker_category_data']);
    
    // App By Text Category
    Route::view('/app_by_text_category', 'Admin/Master/app_by_text_category', ['title' => 'appbytextcategory']);
    Route::post('/add_app_by_text_category', [MasterController::class, 'add_app_by_text_category']);
    Route::get('/app_by_text_category_list', [MasterController::class, 'app_by_text_category_list'])->name('app_by_text_category_list');  // list
    Route::post('/delete_app_by_text_category', [MasterController::class, 'delete_app_by_text_category']);
    Route::post('/get_app_by_text_category_data', [MasterController::class, 'get_app_by_text_category_data']);
});