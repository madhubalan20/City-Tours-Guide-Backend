<?php

namespace App\Livewire\Banner;

use App\Models\City;
use App\Models\State;
use App\Models\TopBottomBanner;
use App\Models\TourPlace;
use Livewire\Component;

class ViewBannerDetail extends Component
{
    public $id, $banner, $city_name, $tour_name;

    public function render()
    {
        $this->id = request()->segment(2);
        $this->banner = TopBottomBanner::where('id', $this->id)->first();
        $this->tour_name = TourPlace::where('id', $this->banner->tour_id)->first();
        $this->city_name = City::where('id', $this->banner->city_id)->first();

        return view('livewire.banner.view-banner-detail');
    }
}
