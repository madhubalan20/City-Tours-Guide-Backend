<?php

namespace App\Livewire\Resources;

use App\Models\City;
use App\Models\CityResource;
use Exception;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CityResourceDetail extends Component
{

    use WithFileUploads; 
    
    public $selectcity, $cityresource;

    public $city_name, $image, $title, $url;

    public $edit_id, $edit_city_name, $edit_image, $edit_title, $edit_url;

    public $delete_id, $delete_title;



    public function render()
    {
        $this->selectcity = City::where('status', '1')->get();
        $this->cityresource = CityResource::orderBy('id', 'desc')->get();

        return view('livewire.resources.city-resource-detail');
    }

    public function addCityResource()
    {
        $this->validate([
            'city_name' => 'required',
            'title' => 'required|string',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            'url' => 'required|url',
        ], [
            'image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $newCityResource = new CityResource;

            $newCityResource->city_id = $this->city_name;
            $newCityResource->title = $this->title;
            $newCityResource->url = $this->url;
           
            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('cityresourceimage', $imageName, 'public');
                $newCityResource->image = url("storage/" . $path);
            }

            $newCityResource->save();

            $notification = array(
                'message' => 'City Resource Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.city.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.city.detail')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {

        try {
            $update = CityResource::where('id', $id)->first();

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

            return redirect()->route('resource.city.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.city.detail')->with('error', $e->getMessage());
        }
    }

    public function editCityResource($id)
    {
        $edit_cityResource = CityResource::where('id', $id)->first();

        $this->edit_id = $edit_cityResource->id;
        $this->edit_city_name = $edit_cityResource->city_id;
        $this->edit_title = $edit_cityResource->title;
        $this->edit_url = $edit_cityResource->url;
    }

    public function updateCityResource()
    {
        $this->validate([
            'edit_title' => 'required|string',
            'edit_city_name' => 'required',
            'edit_url' => 'required|url',
        ]);

        if ($this->edit_image) {
            $this->validate([
                'edit_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            ], [
                'edit_image.max' => 'The image must be less than 2 MB.'
            ]);
        }

        try {
            $update_cityResource = CityResource::where('id', $this->edit_id)->first();

            $update_cityResource->title = $this->edit_title;
            $update_cityResource->city_id = $this->edit_city_name;
            $update_cityResource->url = $this->edit_url;

            if ($this->edit_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                $path = $this->edit_image->storeAs('cityresourceimage', $imageName, 'public');
                $update_cityResource->image = url("storage/" . $path);
            }

            $update_cityResource->update();

            $notification = array(
                'message' => 'City Resource Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.city.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.city.detail')->with('error', $e->getMessage());
        }
    }

    public function getDeleteCityResource($id)
    {
        $delete_resource = CityResource::where('id', $id)->first();

        $this->delete_id = $delete_resource->id;
        $this->delete_title = $delete_resource->title;
    }

    public function deleteCityResource()
    {
        try {
            $delete_city_resource = CityResource::where('id', $this->delete_id)->first();
            $delete_city_resource->delete();

            $notification = array(
                'message' => 'City Resource Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.city.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.city.detail')->with('error', $e->getMessage());
        }

    }
}
