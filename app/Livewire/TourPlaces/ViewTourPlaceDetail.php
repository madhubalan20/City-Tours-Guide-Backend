<?php

namespace App\Livewire\TourPlaces;

use App\Models\Country;
use App\Models\State;
use App\Models\TourPlace;
use App\Models\City;
use App\Models\TourPlaceImage;
use App\Models\TourVideo;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ViewTourPlaceDetail extends Component
{
    use WithFileUploads;

    public $id, $tourdetails, $tourimages, $tourvideos, $editImgId, $edit_image, $deleteImgid, $country, $state, $city, 
    $edit_video_id, $edit_video_url, $image, $video_url, $deleteVideoid;

    public function mount()
    {
        $this->id = request()->segment(2);
        $this->tourdetails = TourPlace::where('id', $this->id)->first();
        $this->tourimages = TourPlaceImage::where('tour_place_id', $this->id)->orderBy('id', 'desc')->get();
        $this->tourvideos = TourVideo::where('tour_id', $this->id)->orderBy('id', 'desc')->get();
        $this->country = Country::where('id', $this->tourdetails->country_id)->first();
        $this->state = State::where('id', $this->tourdetails->state_id)->first();
        $this->city = City::where('id', $this->tourdetails->city_id)->first();




        return view('livewire.tour-places.view-tour-place-detail');
    }

    public function addImage()
    {
        $this->validate([
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
        ], [
            'image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $addImage = new TourPlaceImage;
            $addImage->tour_place_id = $this->id;

            $image = $this->image;
            if ($image) {
                $imageName = time() . '_' . str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('tourplaceimage', $imageName, 'public');
                $addImage->image = url("storage/" . $path);
            }
            $addImage->save();

            $notification = array(
                'message' => 'Image Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $this->id])->with($notification);

        } catch (Exception $e) {
            return redirect()->route('view.details', ['id' => $this->id])->with('error', $e->getMessage());
        }
    }

    public function editImages($id)
    {

        $edit = TourPlaceImage::where('id', $id)->First();
        $this->editImgId = $edit->id;
    }

    public function updateImage()
    {

        $this->validate([
            'edit_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
        ], [
            'edit_image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $update = TourPlaceImage::where('id', $this->editImgId)->First();

            $image = $this->edit_image;
            if ($image) {
                $imageName = time() . '_' . str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('tourplaceimage', $imageName, 'public');
                $update->image = url("storage/" . $path);
            }
            $update->update();

            $notification = array(
                'message' => 'Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $update->tour_place_id])->with($notification);

        } catch (Exception $e) {
            return redirect()->route('view.details', ['id' => $update->tour_place_id])->with('error', $e->getMessage());
        }
    }

    public function getDeleteImage($id)
    {

        $get_delete_id = TourPlaceImage::where('id', $id)->First();
        $this->deleteImgid = $get_delete_id->id;
    }

    public function deleteImage()
    {

        try {
            $delete_img = TourPlaceImage::where('id', $this->deleteImgid)->First();
            $delete_img->delete();

            $notification = array(
                'message' => 'Image Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $delete_img->tour_place_id])->with($notification);
        } catch (Exception $e) {

            return redirect()->route('view.details', ['id' => $delete_img->tour_place_id])->with('error', $e->getMessage());
        }
    }

    public function addVideo()
    {
        $this->validate([
            'video_url' => 'required|url',
        ]);

        try {
            $addVideo = new TourVideo;
            $addVideo->tour_id = $this->id;
            $addVideo->video_url = $this->video_url;
            $addVideo->save();

            $notification = array(
                'message' => 'Video Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $this->id])->with($notification);

        } catch (Exception $e) {
            return redirect()->route('view.details', ['id' => $this->id])->with('error', $e->getMessage());
        }
    }

    public function editVideo($id)
    {

        $edit = TourVideo::where('id', $id)->First();
        $this->edit_video_id = $edit->id;
        $this->edit_video_url = $edit->video_url;

    }

    public function updateVideo()
    {
        $this->validate([
            'edit_video_url' => 'required|url',
        ]);

        try {
            $updateVideo = TourVideo::where('id', $this->edit_video_id)->first();
            $updateVideo->video_url = $this->edit_video_url;
            $updateVideo->update();

            $notification = array(
                'message' => 'Video Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $this->id])->with($notification);

        } catch (Exception $e) {
            return redirect()->route('view.details', ['id' => $this->id])->with('error', $e->getMessage());
        }
    }

    public function getDeleteVideo($id)
    {

        $get_delete_video_id = TourVideo::where('id', $id)->First();
        $this->deleteVideoid = $get_delete_video_id->id;
    }

    public function deleteVideo()
    {

        try {
            $delete_video = TourVideo::where('id', $this->deleteVideoid)->First();
            $delete_video->delete();

            $notification = array(
                'message' => 'Video Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('view.details', ['id' => $this->id])->with($notification);
        } catch (Exception $e) {

            return redirect()->route('view.details', ['id' => $this->id])->with('error', $e->getMessage());
        }
    }

}
