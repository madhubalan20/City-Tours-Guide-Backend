<?php

namespace App\Livewire\Resources;

use App\Models\TourPlace;
use App\Models\TourResource;
use Exception;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class TourResourceDetail extends Component
{
    use WithFileUploads;

    public $selecttour, $tourresource;

    public $tour_name, $image, $title, $url;

    public $edit_id, $edit_tour_name, $edit_image, $edit_title, $edit_url;

    public $delete_id, $delete_title;

    public function render()
    {
        $this->selecttour = TourPlace::where('status', '1')->get();
        $this->tourresource = TourResource::orderBy('id', 'desc')->get();

        return view('livewire.resources.tour-resource-detail');
    }

    public function addTourResource()
    {
        $this->validate([
            'tour_name' => 'required',
            'title' => 'required|string',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            'url' => 'required|url',
        ], [
            'image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $new_tourResource = new TourResource;

            $new_tourResource->tour_id = $this->tour_name;
            $new_tourResource->title = $this->title;
            $new_tourResource->url = $this->url;
           
            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('tourresourceimage', $imageName, 'public');
                $new_tourResource->image = url("storage/" . $path);
            }

            $new_tourResource->save();

            $notification = array(
                'message' => 'Tour Resource Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.tour.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.tour.detail')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {

        try {
            $update = TourResource::where('id', $id)->first();

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

    public function editTourResource($id)
    {
        $edit_tourResource = TourResource::where('id', $id)->first();

        $this->edit_id = $edit_tourResource->id;
        $this->edit_tour_name = $edit_tourResource->tour_id;
        $this->edit_title = $edit_tourResource->title;
        $this->edit_url = $edit_tourResource->url;
    }

    public function updateTourResource()
    {
        $this->validate([
            'edit_title' => 'required|string',
            'edit_tour_name' => 'required',
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
            $update_tourResource = TourResource::where('id', $this->edit_id)->first();

            $update_tourResource->title = $this->edit_title;
            $update_tourResource->tour_id = $this->edit_tour_name;
            $update_tourResource->url = $this->edit_url;

            if ($this->edit_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                $path = $this->edit_image->storeAs('tourresourceimage', $imageName, 'public');
                $update_tourResource->image = url("storage/" . $path);
            }

            $update_tourResource->update();

            $notification = array(
                'message' => 'Tour Resource Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.tour.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.tour.detail')->with('error', $e->getMessage());
        }
    }

    public function getDeleteTourResource($id)
    {
        $delete_resource = TourResource::where('id', $id)->first();

        $this->delete_id = $delete_resource->id;
        $this->delete_title = $delete_resource->title;
    }

    public function deleteTourResource()
    {
        try {
            $delete_tour_resource = TourResource::where('id', $this->delete_id)->first();
            $delete_tour_resource->delete();

            $notification = array(
                'message' => 'Tour Resource Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('resource.tour.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('resource.tour.detail')->with('error', $e->getMessage());
        }

    }
}
