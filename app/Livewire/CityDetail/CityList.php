<?php

namespace App\Livewire\CityDetail;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CityList extends Component
{

    use WithFileUploads;

    public $selectcountry, $selectstate, $citylist, $editState;

    public $state_name, $country_name, $city_name, $image;

    public $edit_city_id, $edit_country_name, $edit_state_name, $edit_city_name, $edit_image;

    public function render()
    {
        $this->selectcountry = Country::where('status', '1')->get();
        $this->selectstate = State::where([['status', '1'], ['country_id', $this->country_name]])->get();
        $this->editState = State::where([['status', '1'], ['country_id', $this->edit_country_name]])->get();
        $this->citylist = City::orderBy('id', 'desc')->get();

        return view('livewire.city-detail.city-list');
    }

     public function addCity()
    {
        $this->validate([
            'state_name' => 'required|unique:states,name',
            'country_name' => 'required',
            'city_name' => 'required',
            'image' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif',
        ], [
            'image.max' => 'The image must be less than 1 MB.'
        ]);

        try {
            $new_city = new City;
            $new_city->country_id = $this->country_name;
            $new_city->state_id = $this->state_name;
            $new_city->name = $this->city_name;
            $new_city->status = '1';
            $new_city->recommend_status = '0';

            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('cityimage', $imageName, 'public');
                $new_city->image = url("storage/" . $path);
            }
            $new_city->save();

            $notification = array(
                'message' => 'City Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('city.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('city.list')->with('error', $e->getMessage());
        }

    }

    public function updateStatus($value, $id)
    {

        try {
            $update = City::where('id', $id)->first();

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

            return redirect()->route('city.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('city.list')->with('error', $e->getMessage());
        }
    }

    public function updateRecommendStatus($value, $id)
    {

        try {
            $update = City::where('id', $id)->first();

            if ($value == true) {
                $update->recommend_status = '1';
            } else {
                $update->recommend_status = '0';
            }
            $update->save();

            $notification = array(
                'message' => 'Recommend Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('city.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('city.list')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $edit_city = City::where('id', $id)->first();

        if ($edit_city) {
            $this->edit_city_id = $edit_city->id;
            $this->edit_country_name = $edit_city->country_id;
            $this->edit_state_name = $edit_city->state_id;
            $this->edit_city_name = $edit_city->name;
        }
    }

    public function updateCity()
    {
        $this->validate([
            'edit_country_name' => 'required',
            'edit_state_name' => 'required',
            'edit_city_name' => 'required',
        ]);

        if($this->edit_image){

            $this->validate([
                'edit_image' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif',
            ], [
                'edit_image.max' => 'The image must be less than 1 MB.'
            ]);
        }

        try {
            $update_city = City::where('id', $this->edit_city_id)->first();

            $update_city->name = $this->edit_city_name;
            $update_city->country_id = $this->edit_country_name;
            $update_city->state_id = $this->edit_state_name;

            if ($this->edit_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                $path = $this->edit_image->storeAs('cityimage', $imageName, 'public');
                $update_city->image = url("storage/" . $path);
            }

            $update_city->save();

            $notification = array(
                'message' => 'City Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('city.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('city.list')->with('error', $e->getMessage());
        }
    }
}
