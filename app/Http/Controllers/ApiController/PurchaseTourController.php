<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\TourLocation;
use App\Models\TourPlaceImage;
use App\Models\TourPlace;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseTourController extends Controller
{
    /* public function purchaseTour(Request $request)
    {

        $userId = User::where('id', Auth::user()->id)->first();

        if($userId){

            $order = Order::where([['user_id', $userId->id],['payment_status', '1']])->orderBy('id', 'desc')->get();

            if(count($order) > 0){

                    foreach($order as $list){

                        $purchase_tour = PurchaseTour::where([['purchase_status', '1'], ['order_id', $list->id]])->get();

                        if(!$purchase_tour->isEmpty()){

                        foreach($purchase_tour as $purchaseList){
                            
                            $Tour = TourPlace::where('id', $purchaseList->tour_id)->first();
                            
                            $bookmark = Bookmark::where([['user_id', $userId->id],['tour_id', $purchaseList->tour_id]])->first();
                            
                            $tourObj = new \stdClass();
                        
                            $tourObj->purchase_id = $list->id;
                            $tourObj->purchase_number = $list->order_string;
                            $tourObj->tour_id = $purchaseList->tour_id;
                            $tourObj->tour_name = $purchaseList->tour_name;
                            $tourObj->demo_price = $purchaseList->demo_price;
                            $tourObj->tour_price = $purchaseList->price;
                            $tourObj->offer = $purchaseList->offer_percentage;
                            $tourObj->tour_image = $purchaseList->tour_image ?? null;
                            $tourObj->bookmark_status = $bookmark->status ?? null;
                            $tourObj->purchase_status = $purchaseList->purchase_status ?? null;
                            $tourObj->tour_description = $purchaseList->tour_description ?? null;
                            $tourObj->tour_know_before_you_go = $purchaseList->tour_know_before_you_go ?? null;
                            $tourObj->geo_json_file_name = $purchaseList->json_url ?? null;
                            $tourObj->geo_json_update_status = $purchaseList->geo_json_update_status ?? null;
                            
                            if (!empty($purchaseList->geo_json_updated_date_time)) {
                                try {
                                    $tourObj->geo_json_updated_data_time = Carbon::parse($purchaseList->geo_json_updated_date_time)->format('d-m-Y');
                                } catch (\Exception $e) {
                                    $tourObj->geo_json_updated_data_time = null;
                                }
                            } else {
                                $tourObj->geo_json_updated_data_time = null;
                            }

                            $tourObj->free_tour_status = $Tour->free_tour_status ?? null;
                            $tourObj->free_tour_validate_date = $Tour->free_tour_validate_date ?? null;
    
                            $data[] = $tourObj;
                        }

                    }else{
                            return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
                        }
                    }
                    
                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
               
            }else{
                return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
            }

        }else{
            return response([ 'message' => 'UnAuthorized User', 'status' => false,'code' => 401], 401);
        }  
    } */

    public function purchaseTour(Request $request)
    {

    $data = [];

    $userId = User::where('id', Auth::user()->id)->first();

    if (!$userId) {
        return response()->json(['message' => 'UnAuthorized User', 'status' => false, 'code' => 401], 401);
    }

    $orders = Order::where([['user_id', $userId->id], ['payment_status', '1']])->orderBy('id', 'desc')->get();
    
    if ($orders->isEmpty()) {
        return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
    }

    foreach ($orders as $order) {

        $purchaseTours = PurchaseTour::where([['purchase_status', '1'], ['order_id', $order->id]])->get();

        if ($purchaseTours->isEmpty()) {
            continue; 
        }

        foreach ($purchaseTours as $purchaseList) {
            $tour = TourPlace::where('id',$purchaseList->tour_id)->withTrashed()->first();
            $bookmark = Bookmark::where([['user_id', $userId->id], ['tour_id', $purchaseList->tour_id]])->first();

            $tourObj = new \stdClass();
            $tourObj->purchase_id = $order->id;
            $tourObj->purchase_number = $order->order_string;
            $tourObj->tour_id = $purchaseList->tour_id;
            $tourObj->tour_name = $purchaseList->tour_name;
            $tourObj->demo_price = $purchaseList->demo_price;
            $tourObj->tour_price = $purchaseList->price;
            $tourObj->offer = $purchaseList->offer_percentage;
            $tourObj->tour_image = $purchaseList->tour_image ?? null;
            $tourObj->bookmark_status = optional($bookmark)->status;
            $tourObj->purchase_status = $purchaseList->purchase_status ?? null;
            $tourObj->tour_description = $purchaseList->tour_description ?? null;
            $tourObj->tour_know_before_you_go = $purchaseList->tour_know_before_you_go ?? null;
            $tourObj->geo_json_file_name = $purchaseList->json_url ?? null;
            $tourObj->geo_json_update_status = $purchaseList->geo_json_update_status ?? null;
            $tourObj->geo_json_updated_data_time = $purchaseList->geo_json_updated_date_time
                ? Carbon::parse($purchaseList->geo_json_updated_date_time)->format('d-m-Y')
                : null;
            $tourObj->free_tour_status = optional($tour)->free_tour_status;
            $tourObj->free_tour_validate_date = optional($tour)->free_tour_validate_date;

            $tour_location = TourLocation::where('tour_id', $tour->id)->get();
            $location_bound = []; 
                        
            foreach($tour_location as $location){
                $locationObj = new \stdClass();
                $locationObj->latitude = $location->latitude ?? Null;
                $locationObj->longitude = $location->longitude ?? Null;
                $location_bound[] = $locationObj; 
            }
            
            $tourObj->location_bound = $location_bound;
            $data[] = $tourObj;
        }
    }

    if (empty($data)) {
        return response()->json(['message' => 'No Tours Found', 'status' => false, 'code' => 404], 404);
    }

    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
}

    
    public function expiryTour(Request $request)
{
    $userId = Auth::user()->id;

    if (!$userId) {
        return response()->json(['message' => 'Unauthorized User', 'status' => false, 'code' => 401], 401);
    }

    $orders = Order::where('user_id', $userId)
        ->where('payment_status', '1')
        ->orderBy('id', 'desc')
        ->get();

    $expiry_data = [];

    if ($orders->isEmpty()) {
        return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
    }

    $repurchasedTours = PurchaseTour::where('user_id', $userId)
        ->where('purchase_status', '1') 
        ->pluck('tour_id')->toArray();

    foreach ($orders as $order) {

        $expiredTours = PurchaseTour::where('order_id', $order->id)
            ->where('purchase_status', '0') // Not used or expired
            ->get();

        if ($expiredTours->isNotEmpty()) {
            foreach ($expiredTours as $expiredTour) {

                if (in_array($expiredTour->tour_id, $repurchasedTours)) {
                    continue; 
                }

                $tour = TourPlace::find($expiredTour->tour_id);

                $exptourObj = new \stdClass();
                $exptourObj->tour_id = $expiredTour->tour_id;
                $exptourObj->tour_name = $expiredTour->tour_name;
                $exptourObj->free_tour_status = $tour->free_tour_status ?? null;
                $exptourObj->validate_date = $order->expiry_date ? Carbon::parse($order->expiry_date)->format('d-m-Y') : null;
                $expiry_data[] = $exptourObj;
            }
        }
    }

    if (!empty($expiry_data)) {
        return response()->json([
            'expiry_data' => $expiry_data,
            'message' => 'Ok',
            'status' => true,
            'code' => 200
        ], 200);
    } else {
        return response()->json([
            'message' => 'No Expiry Tours Found',
            'status' => false,
            'code' => 404
        ], 404);
    }
}

}