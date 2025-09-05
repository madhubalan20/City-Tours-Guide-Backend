<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Traits\PurchaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseStatusUpdateController extends Controller
{

    use PurchaseNotification;

    public function purchaseStatusUpdate(Request $request)
    {
        
        $order = Order::where([['id', $request->purchase_id], ['user_id', Auth::user()->id]])->first();
        
        if ($order) {
            
            $order->payment_status = $request->payment_status;

            if($request->payment_status == '1'){

                $order->payment_message = 'Payment Success';

                $purchase_tour = PurchaseTour::where('order_id', $order->id)->get();
                
                foreach($purchase_tour as $tour){
                    $tour->purchase_status = '1';
                    $tour->update();
                }

                $orderStatus = 'confirmed';

            }else{
                $order->payment_message = 'Payment Fail';
                $orderStatus = 'cancelled';

            }

            $order->razorpay_id = $request->razorPayId ?? null;
            $order->razorpay_payment_id = $request->razorpay_order_id ?? null;
            $order->update();

            $purchase_tour = PurchaseTour::where('order_id', $order->id)->first();

            $user_id = $order->user_id;
            $purchase_id = $order->id;
            $order_number = $order->order_string;
            $order_status = $orderStatus;
            $type='1';
            $tour_id = $purchase_tour->tour_id;
            $tour_name = $purchase_tour->tour_name;
            $city_id = $purchase_tour->city_id;
            $city_name = $purchase_tour->city_name;

            $this->tourPurchaseNotification($user_id, $purchase_id, $type, 
            $order_number, $order_status, $tour_id, $tour_name, $city_id, $city_name);

            return response()->json(['message' => 'Success', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'No Orders Found', 'status' => false, 'code' => 404], 404);
        }
    }

    public function jsonStatusUpdate(Request $request)
    {
        
        $order = Order::where([['id', $request->purchase_id], ['user_id', Auth::user()->id]])->first();
        
        if ($order) {
            
            $purchase_tour = PurchaseTour::where([['order_id', $order->id],['tour_id', $request->tour_id]])->first();

            if($purchase_tour){
                
                $purchase_tour->geo_json_update_status = '0';
                $purchase_tour->update();
                
                return response()->json(['message' => 'Success', 'status' => true, 'code' => 200], 200);

            }else{
                return response()->json(['message' => 'No Orders Found', 'status' => false, 'code' => 404], 404);
            }

        } else {
            return response()->json(['message' => 'No Orders Found', 'status' => false, 'code' => 404], 404);
        }
       
    }
}
