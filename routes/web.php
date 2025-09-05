<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\MyProfile;
use App\Livewire\Article\TourRelatedArticle;
use App\Livewire\AudioType\AudioTypeDetail;
use App\Livewire\Banner\IntroBannerDetail;
use App\Livewire\Banner\TopBottomBannerDetail;
use App\Livewire\Banner\ViewBannerDetail;
use App\Livewire\CityDetail\CityList;
use App\Livewire\Country\Country;
use App\Livewire\CurrencyType\CurrencyTypeDetail;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\MapIcon\MapIconDetail;
use App\Livewire\Notification\PushNotification;
use App\Livewire\PromoCode\TourPromocodeDetail;
use App\Livewire\PromoCode\UserPromocodeDetail;
use App\Livewire\Resources\CityResourceDetail;
use App\Livewire\Resources\TourResourceDetail;
use App\Livewire\Review\ReviewDetail;
use App\Livewire\Settings\AppControllDetail;
use App\Livewire\Settings\PaymentReport;
use App\Livewire\Settings\PaymentReportDetail;
use App\Livewire\State\StateList;
use App\Livewire\TourPlaces\TourPlaceList;
use App\Livewire\TourPlaces\ViewTourPlaceDetail;
use App\Livewire\User\DeleteAccountUser;
use App\Livewire\User\PurchaseHistory;
use App\Livewire\User\Report;
use App\Livewire\User\UserList;
use App\Livewire\User\ViewReportDetails;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('privacy_policy', function () {
    return view('privacy_policy');
});
Route::get('terms_condition', function () {
    return view('terms_condition');
});
Route::get('contact_us', function () {
    return view('contact_us');
});
Route::get('about_us', function () {
    return view('about_us');
});


Route::get('/logout', [LogoutController::class, 'logoutpage'])->name('logout');
Route::get('/key_generate', [LogoutController::class, 'key'])->name('key_generate');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('country', Country::class)->name('country.list');
    Route::get('state', StateList::class)->name('state.list');
    Route::get('cities', CityList::class)->name('city.list');
    Route::get('tour_places', TourPlaceList::class)->name('tour_place.list');
    Route::get('tour_details/{id}', ViewTourPlaceDetail::class)->name('view.details');
    Route::get('banner/intro_banner', IntroBannerDetail::class)->name('banner.introbanner.list');
    Route::get('banner/top_bottom_banner', TopBottomBannerDetail::class)->name('banner.topbottom.list');
    Route::get('view_banner_detail/{id}', ViewBannerDetail::class)->name('banner.detail');
    Route::get('resource/tour_resource', TourResourceDetail::class)->name('resource.tour.detail');
    Route::get('resource/city_resource', CityResourceDetail::class)->name('resource.city.detail');
    Route::get('tour_related_article', TourRelatedArticle::class)->name('tour.article');
    Route::get('reviews', ReviewDetail::class)->name('review.detail');
    Route::get('map_icons', MapIconDetail::class)->name('map.icon.detail');
    Route::get('currency_type', CurrencyTypeDetail::class)->name('currency.type.detail');
    Route::get('audio_type', AudioTypeDetail::class)->name('audio.type.detail');
    Route::get('settings/app_control', AppControllDetail::class)->name('settings.appcontrol');
    Route::get('promocode/tour_promocode', TourPromocodeDetail::class)->name('promocode.tour.promocode');
    Route::get('promocode/user_promocode', UserPromocodeDetail::class)->name('promocode.user.promocode');
    Route::get('settings/payment_reports', PaymentReport::class)->name('settings.report');
    Route::get('users/users_list', UserList::class)->name('users.list');
    Route::get('users/account_delete_users', DeleteAccountUser::class)->name('delete_user.list');
    Route::get('settings/purchase_details/{id}', PaymentReportDetail::class)->name('purchase.detail');
    Route::get('admin/my_profile', MyProfile::class)->name('admin.profile');
    Route::get('users/reports', Report::class)->name('user.reports');
    Route::get('users/report-details/{id}', ViewReportDetails::class)->name('view.report.details');
    Route::get('notification', PushNotification::class)->name('admin.notification');
    Route::get('users/purchase-history/{id}', PurchaseHistory::class)->name('user-purchase-history');
});

Route::get('/artisan_command_migrate', function(){
    Artisan::call("migrate");
    return 1;
});

Route::get('/artisan_migrate_location', function () {
    Artisan::call('migrate', [
        '--path' => '/database/migrations/2024_11_28_052130_create_tour_locations_table.php',
    ]);
    return 'Migration executed successfully!';
});

Route::get('/optimize_clear', function(){
    Artisan::call("optimize:clear");
    return 1;
});

Route::get('/schedule_run', function(){
    Artisan::call("schedule:run");
    return 1;
});
