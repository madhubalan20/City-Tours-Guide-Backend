<?php

namespace App\Livewire\Settings;

use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;


class AppControllDetail extends Component
{
    public $whats_app, $contact_no, $email, $app_id, $validate_day, $splash_image, $edit_splash_image, $razorpay_key, $razorpay_secret, 
    $tech_support_no, $office_timing, $tech_support_url, $face_book, $instagram, $mapbox_access_token, $splash_time_sec, 
    $android_version_code, $android_version_name, $email_footer_content;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.settings.app-controll-detail');
    }

    public function mount()
    {
        $appcontrol = \App\Models\AppControll::where('id', 1)->first();
        $this->whats_app = $appcontrol->whatsapp_number ?? null;
        $this->contact_no = $appcontrol->contact_number ?? null;
        $this->tech_support_no = $appcontrol->tech_support_number ?? null;
        $this->face_book = $appcontrol->facebook_link ?? null;
        $this->instagram = $appcontrol->instagram_link ?? null;
        $this->office_timing = $appcontrol->office_timing ?? null;
        $this->tech_support_url = $appcontrol->tech_support_url ?? null;
        $this->email = $appcontrol->contact_email ?? null;
        $this->validate_day = $appcontrol->purchase_validate_date ?? null;
        $this->splash_image = $appcontrol->splash_image ?? null;
        $this->razorpay_key = $appcontrol->razorpay_merchant_key ?? null;
        $this->razorpay_secret = $appcontrol->razorpay_merchant_id ?? null;
        $this->mapbox_access_token = $appcontrol->mapbox_access_token ?? null;
        $this->splash_time_sec = $appcontrol->splash_time_sec ?? null;
        $this->android_version_code = $appcontrol->android_version_code ?? null;
        $this->android_version_name = $appcontrol->android_version_name ?? null;
        $this->app_id = $appcontrol->id ?? null;
        $this->email_footer_content = $appcontrol->email_footer_content ?? null;
    }

    public function editappcontrol()
    {

        $this->validate([
            'whats_app' => 'required|integer',
            'contact_no' => 'required|integer',
            'tech_support_no' => 'required|integer',
            'face_book' => 'required|url',
            'instagram' => 'required|url',
            'office_timing' => 'required',
            'tech_support_url' => 'required|url',
            'email' => 'required|email',
            'validate_day' => 'required|integer',
            'razorpay_key' => 'required',
            'razorpay_secret' => 'required',
            'mapbox_access_token' => 'required',
            'splash_time_sec' => 'required',
            'android_version_code' => 'required',
            'android_version_name' => 'required',
        ]);

        if ($this->edit_splash_image) {
            $this->validate([
                'edit_splash_image' => 'image|max:5120|mimes:jpg,jpeg,png,gif',
            ],[
                'edit_splash_image.max' => 'The image must be less than 5 MB.',
                'edit_splash_image.mimes' => 'Only jpg, jpeg, png, and gif images are allowed.',
                'edit_splash_image.image' => 'The file must be an image.',
            ]);
        }

        if ($this->edit_splash_image) {

            $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_splash_image->getClientOriginalExtension();
            $imagepath = $this->edit_splash_image->storeAs('splashimage', $imageName, 'public');
                
        } else {
            $imagepath = $this->splash_image;
        }

        try {

            $appcontrol = \App\Models\AppControll::where('id', $this->app_id)->first();
            $appcontrol->whatsapp_number = $this->whats_app;
            $appcontrol->contact_number = $this->contact_no;
            $appcontrol->tech_support_number = $this->tech_support_no;
            $appcontrol->facebook_link = $this->face_book;
            $appcontrol->instagram_link = $this->instagram;
            $appcontrol->office_timing = $this->office_timing;
            $appcontrol->tech_support_url = $this->tech_support_url;
            $appcontrol->contact_email = $this->email;
            $appcontrol->purchase_validate_date = $this->validate_day;
            $appcontrol->razorpay_merchant_key = $this->razorpay_key;
            $appcontrol->razorpay_merchant_id = $this->razorpay_secret;
            $appcontrol->mapbox_access_token = $this->mapbox_access_token;
            $appcontrol->splash_time_sec = $this->splash_time_sec;
            $appcontrol->android_version_code = $this->android_version_code;
            $appcontrol->android_version_name = $this->android_version_name;
            $appcontrol->email_footer_content = $this->email_footer_content ? $this->email_footer_content : null;

            if ($this->edit_splash_image) {
                $appcontrol->splash_image = url("storage/" . $imagepath);
            } else {
                $appcontrol->splash_image = $imagepath;
            }
            $appcontrol->save();

            return redirect()->route('settings.appcontrol')->with('message', 'Edit app control Succesfully');

        } catch (Exception $e) {
            return redirect()->route('settings.appcontrol')->with('error', $e->getMessage());
        }
    }
}
