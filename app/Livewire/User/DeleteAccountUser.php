<?php

namespace App\Livewire\User;

use App\Models\User;
use Exception;
use Livewire\Component;

class DeleteAccountUser extends Component
{
    public $userList;

    public function render()
    {
        $this->userList= User::where([['user_group_id', '2'], ['delete_account_status', '0']])->orderBy('id', 'desc')->get();

        return view('livewire.user.delete-account-user');
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

            return redirect()->route('delete_user.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('delete_user.list')->with('error', $e->getMessage());
        }
    }
}
