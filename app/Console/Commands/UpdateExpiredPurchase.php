<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\PurchaseTour;
use App\Traits\PurchaseExpireNotification;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateExpiredPurchase extends Command
{

    use PurchaseExpireNotification;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-purchase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    try {
        $today = Carbon::now()->format('Y-m-d');  // Get today's date

        $orders = Order::where('payment_status', '=', '1')
            ->whereDate('expiry_date', '<=', $today)
            ->get();

        if (!$orders->isEmpty()) {
            foreach ($orders as $list) {

                $purchase_tours = PurchaseTour::where([['order_id', $list->id], ['purchase_status', '1']])->get();

                if (!$purchase_tours->isEmpty()) {

                    foreach ($purchase_tours as $purchase_tour) {
                        $purchase_tour->purchase_status = '0';  
                        $purchase_tour->save();  
                    }
    
                    $purchaseData = $purchase_tours->first();
    
                    $user_id = $list->user_id;
                    $type = '1';
                    $tour_id = $purchaseData->tour_id;
                    $tour_name = $purchaseData->tour_name;
                    $city_id = $purchaseData->city_id;
                    $city_name = $purchaseData->city_name;
    
                    $this->purchaseTourExpireNotification($user_id, $type, $tour_id, $tour_name, $city_id, $city_name);
                }
            }

            $this->info('Purchase statuses updated successfully.');
        } else {
            $this->info('No expired purchase tour found.');
        }
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error('Error in app:update-expired-purchase command: ' . $e->getMessage());
        $this->error('Failed to update purchase statuses. Check logs for details.');
    }
}

}
