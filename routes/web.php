<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

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

    // Category
    Route::view('/category', 'Admin/Master/category', ['title' => 'category']);
    Route::post('/add_category', [MasterController::class, 'add_category']);
    Route::get('/category_list', [MasterController::class, 'category_list'])->name('category_list');  // list
    Route::post('/delete_category', [MasterController::class, 'delete_category']);
    Route::post('/getcategorydata', [MasterController::class, 'getcategorydata']);

    // Sticker Item
    Route::view('/category_stickers', 'Admin/Master/category_stickers', ['title' => 'sticker']);
    Route::post('/getCategory', [MasterController::class, 'getCategory']);
    Route::post('/add_stickers', [MasterController::class, 'add_stickers']);
    Route::get('/stickers_list', [MasterController::class, 'stickers_list'])->name('stickers_list');  // list
    Route::post('/delete_sticker', [MasterController::class, 'delete_sticker']);
    Route::post('/getstickerdata', [MasterController::class, 'getstickerdata']);

    // Api Call
    Route::view('/api_call', 'Admin/Master/api_call', ['title' => 'api_call']);
    Route::get('/api_call_list', [MasterController::class, 'api_call_list'])->name('api_call_list');  // list

    // App Setting
    Route::view('/app_setting', 'Admin/Master/app_setting', ['title' => 'appsetting']);
    Route::post('/add_app', [MasterController::class, 'add_app']);
    Route::get('/app_data_list', [MasterController::class, 'app_data_list'])->name('app_data_list');  // list
    Route::post('/delete_appdata', [MasterController::class, 'delete_appdata']);
    Route::post('/getappdata', [MasterController::class, 'getappdata']);

    // App By Sticker Category
    Route::view('/app_by_sticker_category', 'Admin/Master/app_by_sticker_category', ['title' => 'appbystickercategory']);
    Route::post('/getApp', [MasterController::class, 'getApp']);
    Route::post('/add_app_by_sticker_category', [MasterController::class, 'add_app_by_sticker_category']);
    Route::get('/app_by_sticker_category_list', [MasterController::class, 'app_by_sticker_category_list'])->name('app_by_sticker_category_list');  // list
    Route::post('/delete_app_by_sticker_category', [MasterController::class, 'delete_app_by_sticker_category']);
    Route::post('/getappbystickercategorydata', [MasterController::class, 'getappbystickercategorydata']);
});
