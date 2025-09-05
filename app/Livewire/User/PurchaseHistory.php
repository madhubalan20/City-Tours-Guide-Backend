<?php

namespace App\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseHistory extends Component
{
    use WithPagination;

    private $purchase_lists;

    public $view_purchase, $id;

    public function mount()
    {
        $this->id = Request::segment(3);
    }

    public function render()
    {
        $this->purchase_lists = Order::join('purchase_tours', 'orders.id', '=', 'purchase_tours.order_id')
        ->where([['orders.user_id', $this->id], ['payment_status', '1']])
        ->orderBy('orders.id', 'desc')
        ->select('orders.id', 'orders.order_string', 'orders.payment_status', 'orders.purchase_date', 'orders.expiry_date', 
        'purchase_tours.tour_name', 'purchase_tours.price','purchase_tours.city_name', 'purchase_tours.purchase_type')
        ->paginate(10);

        return view('livewire.user.purchase-history', ['purchase_lists' => $this->purchase_lists]);
    }

    public function viewPurchaseDetail($id)
    {
        $this->view_purchase = Order::join('purchase_tours', 'orders.id', '=', 'purchase_tours.order_id')
        ->where('orders.id', $id)
        ->select('orders.id', 'orders.order_string', 'orders.payment_status', 'orders.purchase_date', 'orders.expiry_date', 
        'purchase_tours.tour_name', 'purchase_tours.price', 'purchase_tours.country_name', 'purchase_tours.state_name', 'purchase_tours.city_name',
        'purchase_tours.demo_price', 'purchase_tours.offer_percentage', 'orders.sub_total', 'orders.overall_total', 
        'orders.coupon_amount', 'purchase_tours.purchase_type')
        ->first();
    }
}
