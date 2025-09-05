<?php

use App\Http\Controllers\ApiController\AuthenticationController;
use App\Http\Controllers\ApiController\BannerController;
use App\Http\Controllers\ApiController\BookmarkController;
use App\Http\Controllers\ApiController\HomeTourControllerApi;
use App\Http\Controllers\ApiController\ProfileController;
use App\Http\Controllers\ApiController\ResourceController;
use App\Http\Controllers\ApiController\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/get_banner', [BannerController::class, 'getBanner']);
Route::get('/get_intro_banner', [BannerController::class, 'getIntroBanner']);
Route::get('/review', [ReviewController::class, 'review']);


Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/verify_email', [AuthenticationController::class, 'verifyEmail']);
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::post('/get_profile', [ProfileController::class, 'getProfile']);
    Route::get('/home_tour', [HomeTourControllerApi::class, 'HomeTour']);
    Route::post('/add_bookmark', [BookmarkController::class, 'bookmarkTour']);
    Route::get('/my_bookmark', [BookmarkController::class, 'myBookmark']);
});
