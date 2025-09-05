<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\User;
use DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $usercount, $activeusercount, $ordercount, $deleteaccountcount, $topusers, $topsellingtour;

    public function render()
    {
        $this->usercount = User::where('user_group_id', '2')->get();
        $this->activeusercount = User::where([['user_group_id', '2'],['active_status', '1']])->get();
        $this->ordercount = Order::get();
        $this->deleteaccountcount = User::where([['user_group_id', '2'],['active_status', '1'],['delete_account_status', '0']])->get();


        $this->topusers = Order::select('user_id', DB::raw('COUNT(*) as total_orders'))
        ->groupBy('user_id')
        ->orderBy('total_orders', 'DESC')
        ->take(10)
        ->get();

        $this->topsellingtour = PurchaseTour::select('tour_id', DB::raw('COUNT(*) as total_tours'))
        ->groupBy('tour_id')
        ->orderBy('total_tours', 'DESC')
        ->take(10)
        ->get();

      

        return view('livewire.dashboard.dashboard');
    }

    
}
