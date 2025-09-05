<?php

namespace App\Livewire\Banner;

use App\Models\IntroBanner;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class IntroBannerDetail extends Component
{
    use WithFileUploads;

    public $title, $description, $image, $introbanner, $edit_banner_id, $edit_title, $edit_description, $edit_image,
    $delete_id, $delete_title;

    public function render()
    {
        $this->introbanner = IntroBanner::orderBy('id', 'DESC')->get();

        return view('livewire.banner.intro-banner-detail');
    }

    public function addIntroBanner()
    {
        $this->validate([
            'title' => 'required|string',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
        ], [
            'image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $add_banner = new IntroBanner;

            $add_banner->title = $this->title;
            $add_banner->description = $this->description;

            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('introbannerimage', $imageName, 'public');
                $add_banner->image = url("storage/" . $path);
            } 

            $add_banner->save();

            $notification = array(
                'message' => 'Intro Banner Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('banner.introbanner.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.introbanner.list')->with('error', $e->getMessage());
        }
    }

    public function editIntroBanner($id)
    {
        $edit_banner = IntroBanner::where('id', $id)->first();

        $this->edit_banner_id = $edit_banner->id;
        $this->edit_title = $edit_banner->title;
        $this->edit_description = $edit_banner->description;
    }

    public function updateIntroBanner()
    {
        $this->validate([
            'edit_title' => 'required|string',
        ]);

        if ($this->edit_image) {

            $this->validate([
                'edit_image' => 'image|max:2048|mimes:jpg,jpeg,png,gif',
            ], [
                'edit_image.max' => 'The image must be less than 2 MB.'
            ]);
        }

        try {
            $update_banner = IntroBanner::where('id', $this->edit_banner_id)->first();

            $update_banner->title = $this->edit_title;
            $update_banner->description = $this->edit_description;

            if ($this->edit_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                $path = $this->edit_image->storeAs('introbannerimage', $imageName, 'public');
                $update_banner->image = url("storage/" . $path);
            } 

            $update_banner->save();

            $notification = array(
                'message' => 'Intro Banner Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('banner.introbanner.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.introbanner.list')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {
        try {
            $updateStatus = IntroBanner::where('id', $id)->first();

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

            return redirect()->route('banner.introbanner.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.introbanner.list')->with('error', $e->getMessage());
        }
    }

    public function getDeleteIntroBanner($id)
    {
        $delete_banner = IntroBanner::where('id', $id)->first();

        $this->delete_id = $delete_banner->id;
        $this->delete_title = $delete_banner->title;
    }

    public function deleteIntroBanner()
    {
        try {
            $delete_Banner = IntroBanner::where('id', $this->delete_id)->first();
            $delete_Banner->delete();

            $notification = array(
                'message' => 'Intro Banner Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('banner.introbanner.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('banner.introbanner.list')->with('error', $e->getMessage());
        }

    }
}
