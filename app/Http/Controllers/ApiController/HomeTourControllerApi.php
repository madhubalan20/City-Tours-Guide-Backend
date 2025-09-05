<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\City;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\State;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\User;
use App\Models\TourLocation;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeTourControllerApi extends Controller
{
    public function HomeTour(Request $request)
    {

        $userId = User::where('id', $request->user_id)->first();

        if($userId){

            $cityIds = City::where('recommend_status', '1')->orderBy('id', 'desc')->pluck('id');

            if(count($cityIds) > 0){
                $tourPlaces = TourPlace::where('status', '1')->whereIn('city_id', $cityIds)
                              ->orderBy('city_id', 'desc')->get();
        
                $data = [];
                $groupedTours = $tourPlaces->groupBy('city_id');
        
                foreach ($groupedTours as $cityId => $tours) {
        
                    $stateObj = new \stdClass();
                    $stateObj->city_title = City::find($cityId)->name ?? '';
                    $stateObj->city_id = $cityId;
                    
                    $type = 0;
                    foreach ($tours as $tour) {
                        if ($tour->tour_type != 1) {
                            $type = 1;  
                        }
                    }
                    $stateObj->bundle_status = $type;
        
                    $tourList = [];
        
                    foreach ($tours as $tour) {

                        $tour_image = TourPlaceImage::where('tour_place_id',$tour->id)->first();
                        $bookmark = Bookmark::where('user_id', $userId->id)->first();
                        
                        $orders = Order::where('user_id', $userId->id)->where('payment_status', '1')->get();
                    
                        $purchase_data = null; 
                        
                        foreach ($orders as $order) {
                            
                            $purchase_tour = PurchaseTour::where('tour_id', $tour->id)->where('order_id', $order->id)->first();
                            
                            if ($purchase_tour) {
                                
                                $purchase_status = $purchase_tour->purchase_status;
                                $geo_json_update_status = $purchase_tour->geo_json_update_status;
                                $geo_json_updated_date_time = Carbon::parse($purchase_tour->geo_json_updated_data_time)->format('d-m-Y');
                                
                                if ($purchase_status == '1') {
                                    
                                    $purchase_data = [
                                        'purchase_id' => $order->id,
                                        'purchase_string' => $order->order_string,
                                        'geo_json_update_status' => $geo_json_update_status,
                                        'geo_json_updated_date_time' => $geo_json_updated_date_time,
                                        'purchase_status' => $purchase_status
                                    ];
                                }
                            }
                        }
                        
                        if (empty($purchase_data)) {
                            
                            $purchase_data = [
                                'purchase_id' => null,
                                'purchase_string' => null,
                                'geo_json_update_status' => null,
                                'geo_json_updated_date_time' => null,
                                'purchase_status' => null
                            ];
                        }

                        $tourObj = new \stdClass();

                        $tourObj->tour_id = $tour->id;
                        $tourObj->tour_image = $tour_image->image;
                        $tourObj->tour_name = $tour->title;
                        $tourObj->demo_price = $tour->demo_price;
                        $tourObj->tour_price = $tour->price;
                        $tourObj->tour_offer = $tour->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($tour->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = $bookmark->status ?? null;
                        $tourObj->purchase_status = $purchase_data['purchase_status'];
                        $tourObj->purchase_id = $purchase_data['purchase_id'];
                        $tourObj->purchase_string = $purchase_data['purchase_string'];
                        $tourObj->geo_json_file_name = $tour->json_url;
                        $tourObj->geo_json_update_status = $purchase_data['geo_json_update_status'];
                        $tourObj->geo_json_updated_data_time = $purchase_data['geo_json_updated_date_time'];
                        $tourObj->tour_description = $tour->description ?? null;
                        $tourObj->tour_know_before_you_go = $tour->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $tour->free_tour_status;
                        $tourObj->free_tour_validate_date = $tour->free_tour_validate_date ? Carbon::parse($tour->free_tour_validate_date)->format('d-m-Y') : null;

                        $tour_location = TourLocation::where('tour_id', $tour->id)->get();
                        $location_bound = []; 
                        
                        foreach($tour_location as $location){
                            $locationObj = new \stdClass();
                            $locationObj->latitude = $location->latitude ?? Null;
                            $locationObj->longitude = $location->longitude ?? Null;
                            $location_bound[] = $locationObj; 
                        }

                        $tourObj->location_bound = $location_bound;

                        $tourList[] = $tourObj;
                    }
        
                    $stateObj->tour_list = $tourList;
                    $data[] = $stateObj;
                }
        
                return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
            }else{
                return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
            }

        }else{

            $cityIds = City::where('recommend_status', '1')->orderBy('id', 'desc')->pluck('id');

            if(count($cityIds) > 0){
                $tourPlaces = TourPlace::where('status', '1')->whereIn('city_id', $cityIds)
                              ->orderBy('city_id', 'desc')->get();
        
                $data = [];
                $groupedTours = $tourPlaces->groupBy('city_id');
        
                foreach ($groupedTours as $cityId => $tours) {
        
                    $stateObj = new \stdClass();
                    $stateObj->city_title = City::find($cityId)->name ?? '';
                    $stateObj->city_id = $cityId;
                    
                    $type = 0;
                    foreach ($tours as $tour) {
                        if ($tour->tour_type != 1) {
                            $type = 1;  
                        }
                    }
                    $stateObj->bundle_status = $type;
        
                    $tourList = [];
        
                    foreach ($tours as $tour) {

                        $tour_image = TourPlaceImage::where('tour_place_id',$tour->id)->first();
                        $tour_location = TourLocation::where('tour_id', $tour->id)->get();

                        $tourObj = new \stdClass();
                        $tourObj->tour_id = $tour->id;
                        $tourObj->tour_image = $tour_image->image ?? null;
                        $tourObj->tour_name = $tour->title;
                        $tourObj->demo_price = $tour->demo_price;
                        $tourObj->tour_price = $tour->price;
                        $tourObj->tour_offer = $tour->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($tour->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = null;
                        $tourObj->purchase_status = null;
                        $tourObj->geo_json_file_name = $tour->json_url;
                        $tourObj->geo_json_update_status = null;
                        $tourObj->geo_json_updated_data_time = null;
                        $tourObj->tour_description = $tour->description ?? null;
                        $tourObj->tour_know_before_you_go = $tour->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $tour->free_tour_status;
                        $tourObj->free_tour_validate_date = $tour->free_tour_validate_date ? Carbon::parse($tour->free_tour_validate_date)->format('d-m-Y') : null;
        
                        $location_bound = []; 
                        foreach($tour_location as $location){
                            $locationObj = new \stdClass();
                            $locationObj->latitude = $location->latitude ?? Null;
                            $locationObj->longitude = $location->longitude ?? Null;
                            $location_bound[] = $locationObj; 
                        }

                        $tourObj->location_bound = $location_bound;
                        
                        $tourList[] = $tourObj;
                    }
        
                    $stateObj->tour_list = $tourList;
                    $data[] = $stateObj;
                }
        
                return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
            }else{
                return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
            }
        }  
    }

    public function updateTourError(Request $request)
    {
        $tour = TourPlace::where('id',$request->tour_id)->first();

        if ($tour) {

            if($request->message){

                $tour->error_message = $request->message;
                $tour->update();
                
                return response()->json(['message'=>'ok', 'status' => true, 'code' => 200], 200);

            }else{
                return response(['message' => 'Message Is Required', 'status' => false, 'code' => 404], 404); 
            }

        } else {
            return response(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
        }
    }
}
