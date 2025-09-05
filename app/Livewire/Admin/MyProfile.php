<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Auth;
use Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class MyProfile extends Component
{
    use WithFileUploads;

    public $admin, $name, $phone_no, $email, $profile_image, $new_password, $confirm_password;

    public function render()
    {

        $this->admin = User::where([['id','1'],['user_group_id', '1']])->first();
        $this->name = $this->admin->name;
        $this->phone_no = $this->admin->mobile_no;
        $this->email = $this->admin->email;

        return view('livewire.admin.my-profile');
    }

    public function upadateprofiles()
    {

        $upadateprofile = User::where('id', Auth::user()->id)->first();

        $this->validate([
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);
        
        $image = $this->profile_image;
        
        if ($image) {
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('adminprofileimage', $imageName, 'public');
            $Image_file = url("storage/" . $path);
        }else{
            $Image_file = Auth::user()->profile_photo_path;
        }

        $upadateprofile->name = $this->name;
        $upadateprofile->mobile_no = $this->phone_no;
        $upadateprofile->profile_photo_path = $Image_file;

        if ($this->new_password) {
            $upadateprofile->password = Hash::make($this->new_password);
            $upadateprofile->hash_password = $this->new_password;
        }
        $upadateprofile->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);

    }
}
