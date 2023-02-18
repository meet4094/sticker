<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MasterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('apps/callappsapi', [MasterController::class, 'ApiCallData']);
Route::post('statussticker/category', [MasterController::class, 'StatusStickerCategoryData']);
Route::post('statussticker/images', [MasterController::class, 'StatusStickersData']);
Route::post('statustext/category', [MasterController::class, 'StatusTextCategoryData']);
Route::post('statustext/text', [MasterController::class, 'StatusTextData']);
Route::post('appbycategory/statusstickercategory', [MasterController::class, 'AppByStickerCategoryData']);
Route::post('appbycategory/statustextcategory', [MasterController::class, 'AppByTextCategoryData']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
