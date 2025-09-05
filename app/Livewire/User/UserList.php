<?php

namespace App\Livewire\User;

use App\Models\Bookmark;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PromoCode;
use App\Models\PurchaseTour;
use App\Models\Report;
use App\Models\ReportImage;
use App\Models\User;
use App\Traits\UserPushNotification;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class UserList extends Component
{
    use UserPushNotification, WithFileUploads;

    public $userList, $device_id, $one_signal_id, $push_token, $device_brand, $device_model, $device_SDK, $device_manufacture, 
    $app_release, $delete_user_id, $delete_name, $user_name, $user_email, $user_mobile_no, $user_create_date, $user_active_status,
    $user_verify_status, $user_delete_account_status, $order_count, $notification_user_id, $title, $image, $description;

    public function render()
    {
        $this->userList= User::where('user_group_id', '2')->orderBy('id', 'desc')->get();

        return view('livewire.user.user-list');
    }

    public function updateDeleteStatus($value, $id)
    {

        try {
            $user = User::where('id', $id)->first();

            if ($value == true) {
                $user->delete_account_status = '0';
            } else {
                $user->delete_account_status = '1';
            }
            $user->save();

            $notification = array(
                'message' => 'Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('users.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('users.list')->with('error', $e->getMessage());
        }
    }

    public function viewUser($id)
    {

        $getUser = User::where('id', $id)->select('name', 'email', 'mobile_no', 'created_at', 'active_status', 'verify_status', 
        'delete_account_status', 'device_id','one_signal_id','push_token', 'device_brand', 'device_model', 'device_SDK',
        'device_manufacture', 'app_release')->first();

        $order_count = Order::where([['user_id', $id],['payment_status', '1'],])->count();

        $this-> user_name = $getUser->name;
        $this-> user_email = $getUser->email;
        $this-> user_mobile_no = $getUser->mobile_no;
        $this-> user_create_date = $getUser->created_at;
        $this-> user_active_status = $getUser->active_status;
        $this-> user_verify_status = $getUser->verify_status;
        $this-> user_delete_account_status = $getUser->delete_account_status;
        $this-> device_id = $getUser->device_id;
        $this-> one_signal_id = $getUser->one_signal_id;
        $this-> push_token = $getUser->push_token;
        $this-> device_brand = $getUser->device_brand;
        $this-> device_model = $getUser->device_model;
        $this-> device_SDK = $getUser->device_SDK;
        $this-> device_manufacture = $getUser->device_manufacture;
        $this-> app_release = $getUser->app_release;
        $this-> order_count = $order_count;

    }

    public function getDeleteUser($id)
    {
        $deleteUser = User::where('id', $id)->select('id', 'name')->first();

        $this->delete_user_id = $deleteUser->id;
        $this->delete_name = $deleteUser->name;
    }

    public function deleteUser()
{
    try {

        // Delete bookmarks
        $delete_bookmarks = Bookmark::where('user_id', $this->delete_user_id)->get();
        if($delete_bookmarks->count() > 0){
            foreach ($delete_bookmarks as $bookmark) {
                $bookmark->delete();
            }
        }

        // Delete promo codes
        $promo_codes = PromoCode::where('user_id', $this->delete_user_id)->get();
        if($promo_codes->count() > 0){
            foreach ($promo_codes as $promo_code) {
                $promo_code->delete();
            }
        }

        // Delete orders and their associated purchase tours
        $orders = Order::where('user_id', $this->delete_user_id)->get();
        if($orders->count() > 0){
            foreach ($orders as $order) {
                $purchase_tours = PurchaseTour::where('order_id', $order->id)->get();
                foreach ($purchase_tours as $purchase_tour) {
                    $purchase_tour->delete();
                }
               $order->delete();
            }
        }

        // Delete reports and their associated images
        $reports = Report::where('user_id', $this->delete_user_id)->get();
        if($reports->count() > 0){
            foreach ($reports as $report) {
                ReportImage::where('report_id', $report->id)->delete();
                $report->delete();
            }
        }

        // Delete notifications
        $notifications = Notification::where('user_id', $this->delete_user_id)->get();
        if($notifications->count() > 0){
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        }

        // Delete user
        $user = User::where('id',$this->delete_user_id)->delete();

        $notification = [
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('users.list')->with($notification);

    } catch (Exception $e) {
        return redirect()->route('users.list')->with('error', $e->getMessage());
    }
}

public function getUser($id)
    {

        $this->notification_user_id = $id;
    }

public function addNotification()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'The title field is required',
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
            $addpush->user_id = $this->notification_user_id;
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

            return redirect()->route('users.list')->with('message', 'Notification Send Successfully');

        } catch (Exception $e) {

            return redirect()->route('users.list')->with('error', $e->getMessage());
        }
    }
}