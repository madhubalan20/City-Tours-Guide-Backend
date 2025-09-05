<?php

namespace App\Livewire\Settings;

use App\Models\Order;
use App\Models\PurchaseTour;
use Livewire\Component;

class PaymentReportDetail extends Component
{
    public $id, $order, $purchaseTour;
    public function render()
    {
        $this->id = request()->segment(3);
        $this->order = Order::where('id', $this->id)->first();
        $this->purchaseTour = PurchaseTour::where('order_id', $this->id)->get();

        return view('livewire.settings.payment-report-detail');
    }
}
