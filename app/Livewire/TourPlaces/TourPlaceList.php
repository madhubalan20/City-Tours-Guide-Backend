<?php

namespace App\Livewire\TourPlaces;

use App\Models\Bookmark;
use App\Models\City;
use App\Models\Country;
use App\Models\PromoCode;
use App\Models\PurchaseTour;
use App\Models\State;
use App\Models\TopBottomBanner;
use App\Models\TourArticle;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\TourResource;
use App\Models\TourVideo;
use App\Models\TourLocation;
use App\Models\User;
use App\Traits\TourGeoJsonUpdateNotification;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class TourPlaceList extends Component
{

    use TourGeoJsonUpdateNotification;

    use WithFileUploads;

    public $selectcountry, $selectstate, $selectcity, $editState, $editcity, $tourPlace, $show_preview_image;

    public  $country_name, $state_name, $city_name, $title, $duration_time, $audio_point, $tour_stop, $url, $demo_price,
    $offer_percentage, $price, $description, $tour_type, $preview_image, $know_before_you_go;

    public $edit_id, $edit_country_name, $edit_state_name, $edit_city_name, $edit_title, $edit_duration_time, $edit_audio_point, $edit_tour_stop,
    $edit_demo_price, $edit_price, $edit_offer_percentage, $edit_tour_type, $edit_preview_image, $edit_description,
    $edit_json_url, $edit_json_url_id, $edit_know_before_you_go;

    public $delete_id, $delete_title, $validate_date, $edit_free_tour_id;

    public $video_url=[], $inputs = [], $edit_inputs = [], $images = [], $lat = [], $long = [], $location_inputs = [], 
    $edit_location_inputs = [], $edit_lat = [], $edit_long = [], $location_id, $i = 0, $j = 0, $k = 0;

    public function render()
    {
        $this->selectcountry = Country::where('status', '1')->get();
        $this->selectstate = State::where([['status', '1'], ['country_id', $this->country_name]])->get();
        /* $this->selectstate = State::where([['status', '1'], ['country_id', $this->country_name]])->get(); */
        $this->selectcity = City::where([['status', '1'], ['state_id', $this->state_name]])->get();
        $this->editState = State::where('status', '1')->get();
        $this->editcity = City::where('status', '1')->get();

        $this->tourPlace = TourPlace::orderBy('id', 'DESC')->get();

        return view('livewire.tour-places.tour-place-list');
    }

    public function mount()
    {
        $this->video_url = [];
        $this->lat = [];
        $this->long = [];
    }

    public function addDiv($i)
    {
        $this->i = $i + 1;
        $this->inputs[] = $this->i;
    }

    public function remove($decrement)
    {
        if ($decrement != 1) {
            $this->i = $decrement - 1;
        } else {
            $this->i = $this->i - $decrement;
        }
        unset($this->inputs[$decrement - 1]);
        unset($this->video_url[$decrement]);
    }

    public function addLocation($j)
    {
        $this->j = $j + 1;
        $this->location_inputs[] = $this->i;
    }

    public function removeLocation($decrement)
    {
        if ($decrement != 1) {
            $this->j = $decrement - 1;
        } else {
            $this->j = $this->j - $decrement;
        }
        unset($this->location_inputs[$decrement - 1]);
        unset($this->lat[$decrement]);
        unset($this->long[$decrement]);
    }

    public function editLocation($increment)
    {
        $this->k = $increment + 1;
        $this->edit_lat[$increment] = "";
        $this->edit_long[$increment] = "";
        array_push($this->edit_location_inputs, $increment);
    }

    public function edit_removeLocation($decrement)
    {
      if ($decrement != 1) {
        $this->k = $decrement - 1;
      } else {
        $this->k = $this->k - $decrement;
      }
      unset($this->edit_location_inputs[$decrement]);
      unset($this->edit_lat[$decrement]);
      unset($this->edit_long[$decrement]);
    }
  
    public function addTourPlace()
    {
        $this->validate([
            'country_name' => 'required',
            'state_name' => 'required',
            'city_name' => 'required',
            'title' => 'required|string',
            'images' => 'required|array',
            'images.*' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            'preview_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            'duration_time' => 'required',
            'audio_point' => 'required|numeric',
            'tour_stop' => 'required|numeric',
            'url' => 'required|url',
            'demo_price' => 'required|integer',
            'price' => 'required|integer',
            'tour_type' => 'required',
            'lat.0' => ['required', 'numeric', 'between:-90,90'],
            'lat.*' => ['required', 'numeric', 'between:-90,90'],
            'long.0' => ['required', 'numeric', 'between:-180,180'],
            'long.*' => ['required', 'numeric', 'between:-180,180'],
        ], [
            'images.max' => 'The image must be less than 2 MB.',
            'preview_image.max' => 'The image must be less than 2 MB.',
            'lat.0.required' => 'The latitude is required.',
            'lat.0.between' => 'The latitude must be between -90 and 90 degrees.',
            'long.0.required' => 'The longitude is required.',
            'long.0.between' => 'The longitude must be between -180 and 180 degrees.',
            'lat.*.required' => 'The latitude is required.',
            'lat.*.between' => 'The latitude must be between -90 and 90 degrees.',
            'long.*.required' => 'The longitude is required.',
            'long.*.between' => 'The longitude must be between -180 and 180 degrees.',
        ]);

        try {
            $newTourPlace = new TourPlace;

            $newTourPlace->country_id = $this->country_name;
            $newTourPlace->state_id = $this->state_name;
            $newTourPlace->city_id = $this->city_name;
            $newTourPlace->title = $this->title;
            $newTourPlace->duration_time = $this->duration_time;
            $newTourPlace->audio_point = $this->audio_point;
            $newTourPlace->tour_stops = $this->tour_stop;
            $newTourPlace->json_url = $this->url;
            $newTourPlace->demo_price = $this->demo_price;
            $newTourPlace->offer_percentage = $this->offer_percentage;
            $newTourPlace->price = $this->price;
            $newTourPlace->tour_type = $this->tour_type;
            $newTourPlace->description = $this->description;
            $newTourPlace->know_before_you_go = $this->know_before_you_go;
            $newTourPlace->create_date = Carbon::now('Asia/Kolkata');

            if ($this->preview_image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $this->preview_image->getClientOriginalExtension();
                    $path = $this->preview_image->storeAs('previewimage', $imageName, 'public');
                    $newTourPlace->preview_image = url("storage/" . $path);
            }

            $newTourPlace->save();

            if ($this->images) {

                foreach ($this->images as $image) {

                    $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('tourplaceimage', $imageName, 'public');

                    $newImage = new TourPlaceImage;
                    $newImage->tour_place_id = $newTourPlace->id;
                    $newImage->image = url("storage/" . $path);
                    $newImage->save();
                }
            }

            foreach ($this->video_url as $key => $value) {
                $addvariation = new TourVideo;
                $addvariation->tour_id = $newTourPlace->id;
                $addvariation->video_url = $this->video_url[$key];
                $addvariation->save();
            }

            foreach ($this->lat as $key => $value) {
                $addLocation = new TourLocation;
                $addLocation->tour_id = $newTourPlace->id;
                $addLocation->latitude = $this->lat[$key];
                $addLocation->longitude = $this->long[$key];
                $addLocation->save();
            }

            $notification = array(
                'message' => 'Tour Place Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function editTourPlace($id)
    {
        $edit_tourPlace = TourPlace::where('id', $id)->first();

        $this->edit_id = $edit_tourPlace->id;
        $this->edit_country_name = $edit_tourPlace->country_id;
        $this->edit_state_name = $edit_tourPlace->state_id;
        $this->edit_city_name = $edit_tourPlace->city_id;
        $this->edit_title = $edit_tourPlace->title;
        $this->edit_duration_time = $edit_tourPlace->duration_time;
        $this->edit_audio_point = $edit_tourPlace->audio_point;
        $this->edit_tour_stop = $edit_tourPlace->tour_stops;
        $this->edit_demo_price = $edit_tourPlace->demo_price;
        $this->edit_offer_percentage = $edit_tourPlace->offer_percentage;
        $this->edit_price = $edit_tourPlace->price;
        $this->edit_tour_type = $edit_tourPlace->tour_type;
        $this->edit_description = $edit_tourPlace->description;
        $this->edit_know_before_you_go = $edit_tourPlace->know_before_you_go;
        $this->show_preview_image = $edit_tourPlace->preview_image;
        $this->dispatch('modalOpened');

        $this->k = 0;
        $this->edit_location_inputs = [];

        $editLocation = TourLocation::where('tour_id', $id)->get();
        if (count($editLocation) > 0) {
            foreach ($editLocation as $key => $location) {
                $this->k++;
                $this->location_id[$key] = $location->id;
                $this->edit_lat[$key] = $location->latitude;
                $this->edit_long[$key] = $location->longitude;
                array_push($this->edit_location_inputs, $this->k);
            }        
        }
    }

    public function updateTourPlace()
    {

        $this->validate([
            'edit_country_name' => 'required',
            'edit_state_name' => 'required',
            'edit_city_name' => 'required',
            'edit_title' => 'required',
            'edit_duration_time' => 'required',
            'edit_audio_point' => 'required|numeric',
            'edit_tour_stop' => 'required|numeric',
            'edit_demo_price' => 'required|integer',
            'edit_price' => 'required|integer',
            'edit_tour_type'=>'required',
            'edit_lat.0' => ['required', 'numeric', 'between:-90,90'],
            'edit_lat.*' => ['required', 'numeric', 'between:-90,90'],
            'edit_long.0' => ['required', 'numeric', 'between:-180,180'],
            'edit_long.*' => ['required', 'numeric', 'between:-180,180'],
        ],[
            'edit_lat.0.required' => 'The latitude is required.',
            'edit_lat.0.between' => 'The latitude must be between -90 and 90 degrees.',
            'edit_long.0.required' => 'The longitude is required.',
            'edit_long.0.between' => 'The longitude must be between -180 and 180 degrees.',
            'edit_lat.*.required' => 'The latitude is required.',
            'edit_lat.*.between' => 'The latitude must be between -90 and 90 degrees.',
            'edit_long.*.required' => 'The longitude is required.',
            'edit_long.*.between' => 'The longitude must be between -180 and 180 degrees.',
        ]);

        if ($this->edit_preview_image) {
            $this->validate([
                'edit_preview_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            ], [
                'edit_preview_image.max' => 'The image must be less than 2 MB.'
            ]);
        }

        try {

            $update_tourPlace = TourPlace::where('id', $this->edit_id)->first();

            $update_tourPlace->country_id = $this->edit_country_name;
            $update_tourPlace->state_id = $this->edit_state_name;
            $update_tourPlace->city_id = $this->edit_city_name;
            $update_tourPlace->title = $this->edit_title;
            $update_tourPlace->duration_time = $this->edit_duration_time;
            $update_tourPlace->audio_point = $this->edit_audio_point;
            $update_tourPlace->tour_stops = $this->edit_tour_stop;
            $update_tourPlace->demo_price = $this->edit_demo_price;

            if($this->edit_offer_percentage){
                $update_tourPlace->offer_percentage = $this->edit_offer_percentage;
            }else{
                $update_tourPlace->offer_percentage = '0';
            }

            $update_tourPlace->price = $this->edit_price;
            $update_tourPlace->tour_type = $this->edit_tour_type;
            $update_tourPlace->description = $this->edit_description;
            $update_tourPlace->know_before_you_go = $this->edit_know_before_you_go;

            if ($this->edit_preview_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_preview_image->getClientOriginalExtension();
                $path = $this->edit_preview_image->storeAs('previewimage', $imageName, 'public');
                $update_tourPlace->preview_image = url("storage/" . $path);
            }

            $update_tourPlace->update();
            
            foreach ($this->location_id as $key => $value) {
                $updateLocation = TourLocation::where('id', $value)->first();
                
                if ($updateLocation) {
                    if (isset($this->edit_lat[$key]) && isset($this->edit_long[$key])) {
                        $updateLocation->latitude = $this->edit_lat[$key];
                        $updateLocation->longitude = $this->edit_long[$key];
                        $updateLocation->update();
                    } else {
                        $updateLocation->delete();
                    }
                } else {
                    \Log::warning("Location ID $value not found in the database.");
                }
            }

            if (isset($this->edit_lat) && isset($this->edit_long)) {
                foreach ($this->edit_lat as $key => $lat) {
                    if (!isset($this->location_id[$key]) || empty($this->location_id[$key])) {
                        if (!empty($lat) && !empty($this->edit_long[$key])) {
                            TourLocation::create([
                                'tour_id' => $update_tourPlace->id,
                                'latitude' => $lat,
                                'longitude' => $this->edit_long[$key],
                            ]);
                        } else {
                            \Log::warning("New location missing latitude or longitude for key: $key");
                        }
                    }
                }
            }

            $notification = array(
                'message' => 'Tour Place Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function getDeleteTourPlace($id)
    {
        $delete_tourPlace = TourPlace::where('id', $id)->first();

        $this->delete_id = $delete_tourPlace->id;
        $this->delete_title = $delete_tourPlace->title;
    }

    public function deleteTourPlace()
    {
        try {
            $delete_tour = TourPlace::where('id', $this->delete_id)->first();
            $delete_tour->delete();

            $bookmark = Bookmark::where('tour_id', $delete_tour->id)->get();
            foreach( $bookmark as $list){
                $list->delete();
            }

            $banner = TopBottomBanner::where('tour_id', $delete_tour->id)->get();
            foreach( $banner as $list){
                $list->delete();
            }

            $promocode = PromoCode::where('tour_id', $delete_tour->id)->get();
            foreach( $promocode as $list){
                $list->delete();
            }

            $tour_article = TourArticle::where('tour_id', $delete_tour->id)->get();
            foreach( $tour_article as $list){
                $list->delete();
            }

            $tour_image = TourPlaceImage::where('tour_place_id', $delete_tour->id)->get();
            foreach( $tour_image as $list){
                $list->delete();
            }

            $tour_resource = TourResource::where('tour_id', $delete_tour->id)->get();
            foreach( $tour_resource as $list){
                $list->delete();
            }

            $tour_video = TourVideo::where('tour_id', $delete_tour->id)->get();
            foreach( $tour_video as $list){
                $list->delete();
            }

            $tour_location = TourLocation::where('tour_id', $delete_tour->id)->get();
            foreach( $tour_location as $list){
                $list->delete();
            }

            $notification = array(
                'message' => 'Tour Place Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {
        try {
            $update = TourPlace::where('id', $id)->first();

            if ($value == true) {
                $update->status = '1';
            } else {
                $update->status = '0';
            }
            $update->save();

            $notification = array(
                'message' => 'Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function calculatediscount()
    {
        $packageAmount = (int) $this->demo_price;
        $packagePercentage = (int) $this->offer_percentage;

        $discountpercentage = (int) (($packageAmount * $packagePercentage) / 100);

        $discountedamount = $packageAmount - $discountpercentage;

        $this->price = $discountedamount;
    }

    public function calculateeditdiscount()
    {
        $packageAmount = (int) $this->edit_demo_price;
        $packagePercentage = (int) $this->edit_offer_percentage;

        $discountpercentage = (int) (($packageAmount * $packagePercentage) / 100);

        $discountedamount = $packageAmount - $discountpercentage;

        $this->edit_price = $discountedamount;
    }

    public function editJsonUrl($id)
    {
        $edit_json = TourPlace::where('id', $id)->first();
        $this->edit_json_url_id = $edit_json->id;
        $this->edit_json_url = $edit_json->json_url;
    }

    public function updateJsonUrl()
    {
        $this->validate([
            'edit_json_url'=>'required|url'
        ]);

        try {

            $update_json_url = TourPlace::where('id', $this->edit_json_url_id)->first();
            $update_json_url->json_url = $this->edit_json_url;
            $update_json_url->updated_data_time = Carbon::now('Asia/Kolkata');
            $update_json_url->error_message = null;
            $update_json_url->update();

            $purchase_tour = PurchaseTour::where([['tour_id', $update_json_url->id],['purchase_status', '1']])->get();

            if(count($purchase_tour) > 0){

                foreach($purchase_tour as $tours ){
                    $tours->json_url = $this->edit_json_url;
                    $tours->geo_json_updated_date_time = Carbon::now('Asia/Kolkata');
                    $tours->geo_json_update_status = '1';
                    $tours->update();
                }
            }

            $city = City::where('id', $update_json_url->city_id)->first();

            $tour_id = $update_json_url->id;
            $tour_name = $update_json_url->title;
            $city_id = $city->id;
            $city_name = $city->name;
            $type='1';

            $userList = User::where('user_group_id', '2')->get();

            if(count($userList) > 0){
                foreach ($userList as $user){

                    $user_id = $user->id;

                    $this->jsonUrlUpdateNotification($user_id, $type, $tour_id, $tour_name, $city_id, $city_name);
                }
            }

            $notification = array(
                'message' => 'Json Url Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function editFreeTour($id)
    {
        $edit = TourPlace::where('id', $id)->first();
        $this->edit_free_tour_id = $edit->id;
    }

    public function updateActiveFreeTour()
    {
        $this->validate([
            'validate_date'=>'required|date'
        ]);

        try {
            $update = TourPlace::where('id', $this->edit_free_tour_id)->first();
            $update->free_tour_status = '1';
            $update->free_tour_validate_date = $this->validate_date;
            $update->save();

            $notification = array(
                'message' => 'Free Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }

    public function updateDeactiveFreeTour($id)
    {

        try {
            $update = TourPlace::where('id', $id)->first();
            $update->free_tour_status = '0';
            $update->free_tour_validate_date = null;
            $update->save();

            $update_purchaseTour = PurchaseTour::where([['tour_id', $update->id], ['purchase_status', '1']])->get();

            if(!$update_purchaseTour->isEmpty()){
                foreach($update_purchaseTour as $tour){
                    $tour->purchase_status = '0';
                    $tour->update();
                }
            }

            $notification = array(
                'message' => 'Free Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('tour_place.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour_place.list')->with('error', $e->getMessage());
        }
    }
}
