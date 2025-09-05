<?php

namespace App\Livewire\Notification;

use App\Models\Notification;
use App\Models\User;
use App\Traits\UserPushNotification;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class PushNotification extends Component
{

    use UserPushNotification, WithFileUploads;

    public $userList, $user_id, $title, $image, $description, $pushNotifications;

    public function render()
    {
        $this->userList = User::where([['user_group_id', '2'],['delete_account_status','1']])->get();

        $this->pushNotifications = Notification::orderBy('id', 'desc')->get();

        return view('livewire.notification.push-notification');
    }

    public function addNotification()
    {
        $this->validate([
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'The title field is required',
            'user_id.required' => 'The user name field is required',
            'description.required' => 'The description field is required',
        ]);

        if ($this->image) {
            $this->validate([
                'image' => 'image|max:2048|mimes:jpg,jpeg,png,gif,svg',
            ], [
                'image.max' => 'The image must be less than 2 MB.',
                'image.image' => 'The file must be an image',
                'image.mimes' => 'The image must be a file of type: jpg, png, gif, jpeg, svg.',
            ]);
        }

        try {

            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('notification-image', $imageName, 'public');
            }

            $addpush = new Notification;
            $addpush->user_id = $this->user_id;
            $addpush->title = $this->title;
            $addpush->image = $this->image ? url("storage/" . $path) : null;
            $addpush->description = $this->description;
            $addpush->save();

            if ($addpush) {

                $user = User::where('id', $addpush->user_id)->select('name')->first();
                
                $user_id = $addpush->user_id;
                $user_name = $user->name;
                $title = $addpush->title;
                $image = $addpush->image;
                $description = $addpush->description;
                $type = '0';

                $this->userPushNotification($user_id, $user_name, $title, $image, $type, $description);

            }

            return redirect()->route('admin.notification')->with('message', 'Notification Send Successfully');

        } catch (Exception $e) {

            return redirect()->route('admin.notification')->with('error', $e->getMessage());
        }
    }

    public function sendNotification($id)
    {
        try {

            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('notification-image', $imageName, 'public');
            }

            $addpush = Notification::where('id', $id)->first();
          
            if ($addpush) {

                $user = User::where('id', $addpush->user_id)->select('name')->first();
                
                $user_id = $addpush->user_id;
                $user_name = $user->name;
                $title = $addpush->title;
                $image = $addpush->image;
                $description = $addpush->description;
                $type = '0';

                $this->userPushNotification($user_id, $user_name, $title, $image, $type, $description);

            }

            return redirect()->route('admin.notification')->with('message', 'Notification Send Successfully');

        } catch (Exception $e) {

            return redirect()->route('admin.notification')->with('error', $e->getMessage());
        }
    }
}
