<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AppControll;
use App\Models\Order;
use App\Models\WebhookLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function purchaseTourUpdate(Request $request)
    {

        if (!empty($request->purchase_id)) {

            $purchase_id = $request->purchase_id;
            $order = Order::Where('id', $purchase_id)->first();

            if ($request->total_amount == $order->overall_total) {

                $order_string = $order->order_string;
                $amount = $order->overall_total * 100;

                $razorpay_merchant_id = AppControll::select('razorpay_merchant_id')->Where('id', '1')->first();
                $razorpay_merchant_secret_key = AppControll::select('razorpay_merchant_key')->Where('id', '1')->first();
                
                $url = "https://api.razorpay.com/v1/orders";
                $arrayToSend = array("amount" => $amount, "currency" => "INR", "receipt" => $order_string);

                $json = json_encode($arrayToSend);

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_USERPWD, $razorpay_merchant_secret_key->razorpay_merchant_key . ":" . $razorpay_merchant_id->razorpay_merchant_id);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                $response = ['data' => json_decode(curl_exec($ch)), 'status' => true, 'message' => "ok"];

                return response($response, 200);

            } else {
                return response()->json(['message' => 'Purchase Total Mismatch', 'status' => false], 404);
            }

        } else {
            return response()->json(['message' => 'Purchase Id Is Required', 'status' => false], 404);
        }
    }

    public function razorpay_callback(Request $request)
    {

        $requestContent = $request->getContent();
        $data = json_decode($requestContent);

        // Log request data
        $generatedData = json_encode($data);
        $create_WebHook = new WebhookLog;
        $create_WebHook->date = date('Y-m-d');
        $create_WebHook->time = date('H:i:s');
        $create_WebHook->data = $generatedData;
        $create_WebHook->save();

        // Ensure the event is 'payment.captured'
        if ($data && $request->event === 'payment.captured') {
            $orderString = $data->payload->payment->entity->notes->order_id;
            $razorpayOrderId = $data->payload->payment->entity->order_id;
            $razorpayPaymentId = $data->payload->payment->entity->id;

            // Find the order in the database
            $ra_order = Order::where('order_string', $orderString)->first();

            if ($ra_order) {
                
                $payment_type = 'Razorpay';

                if ($ra_order->payment_status == '2') {
                    $ra_order->payment_status = '1';
                    $ra_order->razorpay_id = $razorpayOrderId;
                    $ra_order->message = 'Callback payment success';
                    $ra_order->razorpay_payment_id = $razorpayPaymentId;
                    $ra_order->purchase_date = Carbon::now('Asia/Kolkata');
                    $ra_order->payment_type = $payment_type;
                    $ra_order->save();

                    if ($ra_order->wasChanged()) {
                        $response = ['status' => true, 'message' => "success"];
                    } else {
                        $response = ['status' => true, 'message' => "Not Updated"];
                    }
                    return response()->json($response);
                }
            } else {
                return response()->json(['status' => true, 'message' => "No Data Found"], 200);
            }
        } elseif($data && $request->event === 'payment.failed') {
            $orderString = $data->payload->payment->entity->notes->order_id;
            $razorpayOrderId = $data->payload->payment->entity->order_id;
            $razorpayPaymentId = $data->payload->payment->entity->id;

            // Find the order in the database
            $ra_order = Order::where('order_string', $orderString)->first();
            
            if ($ra_order) {
               
                $payment_type = 'Razorpay';

                if ($ra_order->payment_status == '2') {
                    $ra_order->payment_status = '0';
                    $ra_order->razorpay_id = $razorpayOrderId;
                    $ra_order->message = 'Callback payment failed';
                    $ra_order->razorpay_payment_id = $razorpayPaymentId;
                    $ra_order->purchase_date = Carbon::now('Asia/Kolkata');
                    $ra_order->payment_type = $payment_type;
                    $ra_order->save();

                    if ($ra_order->wasChanged()) {
                        $response = ['status' => true, 'message' => "success"];
                    } else {
                        $response = ['status' => true, 'message' => "Not Updated"];
                    }
                    return response()->json($response);
                }
            } else {
                return response()->json(['status' => true, 'message' => "No Data Found"], 200);
            }
        }

    }
}
