<?php

namespace App\Livewire\Settings;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentReport extends Component
{
    use WithPagination;

    private $paymentrepoprt;

    public  $search, $start_date, $end_date, $month_name;

    public function render()
    {

        if($this->start_date && $this->end_date){
            $this->paymentrepoprt = Order::whereBetween('purchase_date', [$this->start_date, $this->end_date])->paginate(10);;
        }else{
          
            $search = '%' . $this->search . '%';

            $this->paymentrepoprt = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->whereAny(['users.name','users.email', 'order_string', 'payment_message', 'purchase_type'], 'LIKE', $search)
            ->orderBy('orders.id', 'desc')
            ->select('orders.*')
            ->paginate(10);
        }
        
        return view('livewire.settings.payment-report', ['paymentrepoprt' => $this->paymentrepoprt]);
    }

    public function viewPurchaseDetail(){
        
    }
}
