<?php

use App\Http\Controllers\ApiController\AppControlApi;
use App\Http\Controllers\ApiController\AudioTypeController;
use App\Http\Controllers\ApiController\AuthenticationController;
use App\Http\Controllers\ApiController\BannerController;
use App\Http\Controllers\ApiController\BookmarkController;
use App\Http\Controllers\ApiController\BundleTourController;
use App\Http\Controllers\ApiController\CountrywiseTourController;
use App\Http\Controllers\ApiController\CreateOrderController;
use App\Http\Controllers\ApiController\HomeTourControllerApi;
use App\Http\Controllers\ApiController\MapIconController;
use App\Http\Controllers\ApiController\ProfileController;
use App\Http\Controllers\ApiController\PromoCodeController;
use App\Http\Controllers\ApiController\PurchaseStatusUpdateController;
use App\Http\Controllers\ApiController\PurchaseTourController;
use App\Http\Controllers\ApiController\RazorpayController;
use App\Http\Controllers\ApiController\ResourceController;
use App\Http\Controllers\ApiController\ReviewController;
use App\Http\Controllers\ApiController\SingleTourController;
use App\Http\Controllers\ApiController\UserReportController;
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
Route::post('/forgot_password', [AuthenticationController::class, 'forgotPassword']);
Route::get('/get_banner', [BannerController::class, 'getBanner']);
Route::get('/get_bottom_banner', [BannerController::class, 'getBottomBanner']);
Route::get('/get_intro_banner', [BannerController::class, 'getIntroBanner']);
Route::get('/review', [ReviewController::class, 'review']);
Route::get('/country_tour', [CountrywiseTourController::class, 'countryTour']);
Route::get('/audio_type', [AudioTypeController::class, 'AudioType']);
Route::get('/Currency_type', [AudioTypeController::class, 'Currencytype']);
Route::get('/app_control', [AppControlApi::class, 'appcontrol']);
Route::get('/map_icon', [MapIconController::class, 'mapIcons']);
Route::post('/city_resource', [ResourceController::class, 'cityResource']);
Route::post('/home_tour', [HomeTourControllerApi::class, 'HomeTour']);
Route::post('/bundle_tour', [BundleTourController::class, 'BundleTour']);
Route::post('/viewall_bundle_tour', [BundleTourController::class, 'viewAllBundleTour']);
Route::post('/single_tour', [SingleTourController::class, 'SingleTour']);
Route::post('/razorpay_callback', [RazorpayController::class, 'razorpay_callback']);
Route::post('/update_tour_error', [HomeTourControllerApi::class, 'updateTourError']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/verify_email', [AuthenticationController::class, 'verifyEmail']);
    Route::post('/reset_assword', [AuthenticationController::class, 'resetPassword']);
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/delete_account', [AuthenticationController::class, 'deleteAccount']);
    Route::get('/get_profile', [ProfileController::class, 'getProfile']);
    Route::post('/add_bookmark', [BookmarkController::class, 'bookmarkTour']);
    Route::get('/my_bookmark', [BookmarkController::class, 'myBookmark']);
    Route::get('/purchase_tour', [PurchaseTourController::class, 'purchaseTour']);
    Route::get('/expiry_tour', [PurchaseTourController::class, 'expiryTour']);
    Route::post('/edit_user', [ProfileController::class, 'EditUser']);
    Route::post('/edit_user_preference', [ProfileController::class, 'EditUserPreference']);
    Route::post('/get_all_coupon', [PromoCodeController::class, 'getAllCoupon']);
    Route::post('/check_coupon', [PromoCodeController::class, 'checkCoupon']);
    Route::post('/creaate_tour', [CreateOrderController::class, 'creaateTour']);
    Route::post('/purchase_tour_update', [RazorpayController::class, 'purchaseTourUpdate']);
    Route::post('/purchase_status_update', [PurchaseStatusUpdateController::class, 'purchaseStatusUpdate']);
    Route::post('/json_status_update', [PurchaseStatusUpdateController::class, 'jsonStatusUpdate']);
    Route::get('/register_resend_mail', [AuthenticationController::class, 'register_resend_mail']);
    Route::get('/forgot_password_resend_mail', [AuthenticationController::class, 'forgot_password_resend_mail']);
    Route::post('/user_report', [UserReportController::class, 'userReport']);
});