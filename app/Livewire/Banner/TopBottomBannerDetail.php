<?php

namespace App\Livewire\Banner;

use App\Models\BannerImage;
use App\Models\City;
use App\Models\State;
use App\Models\TopBottomBanner;
use App\Models\TourPlace;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class TopBottomBannerDetail extends Component
{
    use WithFileUploads;

    public $title, $position, $url, $description, $banner, $broadcast, $citylist, $tourlist, $image,
    $city, $tour, $file_type, $video_url, $arrangement;

    public $edit_title, $edit_position, $edit_url, $edit_description, $edit_broadcast, $edit_image,
    $edit_city, $edit_tour, $edit_banner_id, $get_edit_state, $get_edit_tour, $get_edit_url, $edit_file_type, 
    $edit_video_url, $get_edit_city, $edit_arrangement;

    public $delete_id, $delete_title;

    public function render()
    {
        $this->banner = TopBottomBanner::orderBy('id', 'DESC')->get();
        $this->citylist = City::where('status', '1')->get();
        $this->tourlist = TourPlace::where('status', '1')->get();

        return view('livewire.banner.top-bottom-banner-detail');
    }

    public function addBanner()
{
    $this->validate([
        'title' => 'required|string',
        'position' => 'required',
        'file_type' => 'required',
        'arrangement' => 'required|numeric|integer|gt:0',
    ], [
        'arrangement.required' => "The arrangement field is required.",
        'arrangement.numeric' => "The arrangement field must be a number.",
        'arrangement.integer' => "The arrangement field must be an integer.",
        'arrangement.gt' => "The arrangement field must be greater than 0.",
    ]);
    

    if ($this->file_type == '1') {
        $this->validate([
            'broadcast' => 'required',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
        ], [
            'image.max' => 'The image must be less than 2 MB.',
            'image.required' => 'The image field is required.',
            'image.mimes' => 'The image must be a file of type: jpg, png, gif, jpeg',
        ]);
    } elseif ($this->file_type == '2') {
        $this->validate([
            'video_url' => 'required|url',
        ]);
    }

    if ($this->broadcast == '1') {
        $this->validate([
            'url' => 'required|url',
        ]);
    } elseif ($this->broadcast == '2') {
        $this->validate([
            'city' => 'required',
        ]);
    } elseif ($this->broadcast == '3') {
        $this->validate([
            'tour' => 'required',
        ]);
    }

    try {
        $add_banner = new TopBottomBanner;

        $add_banner->title = $this->title;
        $add_banner->description = $this->description;
        $add_banner->position = $this->position;
        $add_banner->type = $this->broadcast ?? null;
        $add_banner->file_type = $this->file_type;

        if ($this->image) {
            $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('bannerimage', $imageName, 'public');
            $add_banner->image = $path; // Store relative path only
        }

        $add_banner->vedio_url = $this->video_url ?? null;
        $add_banner->url = $this->url ?? null;
        $add_banner->city_id = $this->city ?? null;
        $add_banner->tour_id = $this->tour ?? null;
        $add_banner->arrangement = $this->arrangement ?? null;


        $add_banner->save();

        $notification = [
            'message' => 'Banner Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('banner.topbottom.list')->with($notification);

    } catch (Exception $e) {
        return redirect()->route('banner.topbottom.list')->with('error', $e->getMessage());
    }
}


    public function editBanner($id)
    {
        $edit_banner = TopBottomBanner::where('id', $id)->first();

        $this->edit_banner_id = $edit_banner->id;
        $this->edit_title = $edit_banner->title;
        $this->edit_description = $edit_banner->description;
        $this->edit_position = $edit_banner->position;
        $this->edit_broadcast = $edit_banner->type;
        $this->edit_file_type = $edit_banner->file_type;
        $this->edit_city = $edit_banner->city_id;
        $this->edit_tour = $edit_banner->tour_id;
        $this->edit_url = $edit_banner->url;
        $this->edit_video_url = $edit_banner->vedio_url;
        $this->get_edit_city = $edit_banner->city_id;
        $this->get_edit_tour = $edit_banner->tour_id;
        $this->get_edit_url = $edit_banner->url;
        $this->edit_arrangement = $edit_banner->arrangement;

    }

    public function updateBanner()
    {
        $this->validate([
            'edit_title' => 'required|string',
            'edit_position' => 'required',
            'edit_file_type' => 'required',
            'edit_arrangement' => 'required|numeric|integer|gt:0',
        ], [
            'arrangement.required' => "The arrangement field is required.",
            'arrangement.numeric' => "The arrangement field must be a number.",
            'arrangement.integer' => "The arrangement field must be an integer.",
            'arrangement.gt' => "The arrangement field must be greater than 0.",
        ]);

        if ($this->edit_file_type == '1') {

            if($this->edit_image){
                $this->validate([
                    'edit_broadcast' => 'required',
                    'edit_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
                ], [
                    'edit_image.max' => 'The image must be less than 2 MB.',
                    'edit_image.required' => 'The image field is required.',
                    'edit_image.mimes' => 'The image must be a file of type: jpg, png, gif, jpeg',
                ]);
            }
            
        }elseif ($this->edit_file_type == '2') {
            $this->validate([
                'edit_video_url' => 'required|url',
            ]);
        }

        if ($this->edit_broadcast == '1') {
            $this->validate([
                'edit_url' => 'required|url',
            ]);
        }elseif ($this->edit_broadcast == '2') {
            $this->validate([
                'edit_city' => 'required',
            ]);
        }elseif ($this->edit_broadcast == '3') {
            $this->validate([
                'edit_tour' => 'required',
            ]);
        }

        try {
            $update_banner = TopBottomBanner::where('id', $this->edit_banner_id)->first();

            $update_banner->title = $this->edit_title;
            $update_banner->description = $this->edit_description;
            $update_banner->position = $this->edit_position;
            $update_banner->type = $this->edit_broadcast;
            $update_banner->file_type = $this->edit_file_type;

            if ($this->edit_broadcast == '1' ) {
                $update_banner->url = $this->edit_url;
                $update_banner->city_id = null;
                $update_banner->tour_id = null;
            }elseif($this->edit_broadcast == '2'){
                $update_banner->url = null;
                $update_banner->city_id = $this->edit_city;
                $update_banner->tour_id = null;
            }else{
                $update_banner->url = null;
                $update_banner->city_id = null;
                $update_banner->tour_id = $this->edit_tour;
            }

            if ($this->edit_file_type == '1' ) {
                if ($this->edit_image) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                    $path = $this->edit_image->storeAs('bannerimage', $imageName, 'public');
                    $update_banner->image = url("storage/" . $path);
                }
                $update_banner->vedio_url =  null;
            }elseif($this->edit_file_type == '2'){
                $update_banner->vedio_url =  $this->edit_video_url;
                $update_banner->image = null;
            }

            $update_banner->arrangement = $this->edit_arrangement;
            $update_banner->update();

            $notification = array(
                'message' => 'Banner Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('banner.topbottom.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.topbottom.list')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {
        try {
            $updateStatus = TopBottomBanner::where('id', $id)->first();

            if ($value == true) {
                $updateStatus->status = '1';
            } else {
                $updateStatus->status = '0';
            }

            $updateStatus->save();

            $notification = array(
                'message' => 'Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('banner.topbottom.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.topbottom.list')->with('error', $e->getMessage());
        }
    }

    public function getDeleteBanner($id)
    {
        $delete_banner = TopBottomBanner::where('id', $id)->first();

        $this->delete_id = $delete_banner->id;
        $this->delete_title = $delete_banner->title;
    }

    public function deleteBanner()
    {
        try {
            $delete_Banner = TopBottomBanner::where('id', $this->delete_id)->first();
            $delete_Banner->delete();

            $notification = array(
                'message' => 'Banner Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('banner.topbottom.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.topbottom.list')->with('error', $e->getMessage());
        }

    }
}
