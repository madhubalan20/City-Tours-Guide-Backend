<?php

use App\Http\Controllers\LogoutController;
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
use App\Livewire\Resources\CityResourceDetail;
use App\Livewire\Resources\TourResourceDetail;
use App\Livewire\Review\ReviewDetail;
use App\Livewire\State\StateList;
use App\Livewire\TourPlaces\TourPlaceList;
use App\Livewire\TourPlaces\ViewTourPlaceDetail;
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
Route::get('/logout', [LogoutController::class, 'logoutpage'])->name('logout');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('country', Country::class)->name('country.list');
    Route::get('state', StateList::class)->name('state.list');
    Route::get('cities', CityList::class)->name('city.list');
    Route::get('tour_places', TourPlaceList::class)->name('tour_place.list');
    Route::get('tour_details/{id}', ViewTourPlaceDetail::class)->name('view.details');
    Route::get('banner/intro_banner', IntroBannerDetail::class)->name('banner.introbanner.list');
    Route::get('banner/top_bottom_banner', TopBottomBannerDetail::class)->name('banner.topbottom.list');
    Route::get('banner/view_banner_detail/{id}', ViewBannerDetail::class)->name('banner.detail');
    Route::get('resource/tour_resource', TourResourceDetail::class)->name('resource.tour.detail');
    Route::get('resource/city_resource', CityResourceDetail::class)->name('resource.city.detail');
    Route::get('tour_related_article', TourRelatedArticle::class)->name('tour.article');
    Route::get('reviews', ReviewDetail::class)->name('review.detail');
    Route::get('map_icons', MapIconDetail::class)->name('map.icon.detail');
    Route::get('currency_type', CurrencyTypeDetail::class)->name('currency.type.detail');
    Route::get('audio_type', AudioTypeDetail::class)->name('audio.type.detail');
});
