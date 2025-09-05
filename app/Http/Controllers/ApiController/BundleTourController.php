<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\City;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\TourLocation;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BundleTourController extends Controller
{
    public function BundleTour(Request $request)
    {

        $userId = User::where('id', $request->user_id)->first();

        if($userId){

            $city = City::where('id', $request->city_id)->first();

            if($city){

                $tour_place = TourPlace::where([['city_id', $city->id], ['status', '1']])->get();

                if(count($tour_place) > 0){

                    foreach($tour_place as $list){

                        $bookmark = Bookmark::where([['user_id', $userId->id],['tour_id', $list->id]])->first();
                        $tour_image = TourPlaceImage::where('tour_place_id',$list->id)->first();
                        
                        $orders = Order::where('user_id', $userId->id)->where('payment_status', '1')->get();
                    
                        $purchase_data = null; 
                        
                        foreach ($orders as $order) {
                            
                            $purchase_tour = PurchaseTour::where('tour_id', $list->id)->where('order_id', $order->id)->first();
                            
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
                        
                        $tourObj->tour_id = $list->id;
                        $tourObj->tour_image = $tour_image->image;
                        $tourObj->tour_name = $list->title;
                        $tourObj->demo_price = $list->demo_price;
                        $tourObj->tour_price = $list->price;
                        $tourObj->tour_offer = $list->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($list->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = $bookmark->status ?? null;
                        $tourObj->purchase_status = $purchase_data['purchase_status'];
                        $tourObj->purchase_id = $purchase_data['purchase_id'];
                        $tourObj->purchase_string = $purchase_data['purchase_string'];
                        $tourObj->geo_json_file_name = $list->json_url;
                        $tourObj->geo_json_update_status = $purchase_data['geo_json_update_status'];
                        $tourObj->geo_json_updated_data_time = $purchase_data['geo_json_updated_date_time'];

                        if($list->tour_type == '1'){
                            $tourObj->bundle_status = '0';
                        }else{
                            $tourObj->bundle_status = '1';
                        }
                           
                        $tourObj->tour_description = $list->description ?? null;
                        $tourObj->tour_know_before_you_go = $list->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $list->free_tour_status;
                        $tourObj->free_tour_validate_date = $list->free_tour_validate_date ? Carbon::parse($list->free_tour_validate_date)->format('d-m-Y') : null;

                        $tour_location = TourLocation::where('tour_id', $list->id)->get();
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

                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

                }else{
                    return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
                }
               
            }else{
                return response()->json(['message' => 'Invalid City', 'status' => false, 'code' => 404], 404);
            }

        }else{

            $city = City::where('id', $request->city_id)->first();

            if($city){

                $tour_place = TourPlace::where([['city_id', $city->id], ['status', '1']])->get();

                if(count($tour_place) > 0){

                    foreach($tour_place as $list){

                        $tour_image = TourPlaceImage::where('tour_place_id',$list->id)->first();
    
                        
                        $tourObj = new \stdClass();
                        
                        $tourObj->tour_id = $list->id;
                        $tourObj->tour_image = $tour_image->image;
                        $tourObj->tour_name = $list->title;
                        $tourObj->demo_price = $list->demo_price;
                        $tourObj->tour_price = $list->price;
                        $tourObj->tour_offer = $list->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($list->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = null;
                        $tourObj->purchase_status = null;
                        $tourObj->geo_json_file_name = $list->json_url;
                        $tourObj->geo_json_update_status = null;

                        if($list->tour_type == '1'){
                            $tourObj->bundle_status = '0';
                        }else{
                            $tourObj->bundle_status = '1';
                        }

                        $tourObj->geo_json_updated_data_time = null;
                        $tourObj->tour_description = $list->description ?? null;
                        $tourObj->tour_know_before_you_go = $list->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $list->free_tour_status;
                        $tourObj->free_tour_validate_date = $list->free_tour_validate_date ? Carbon::parse($list->free_tour_validate_date)->format('d-m-Y') : null;

                        $tour_location = TourLocation::where('tour_id', $list->id)->get();
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

                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
                }else{
                    return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
                }
               
            }else{
                return response()->json(['message' => 'Invalid City', 'status' => false, 'code' => 404], 404);
            }
        }  
    }

    public function viewAllBundleTour(Request $request)
    {

        $userId = User::where('id', $request->user_id)->first();

        if($userId){

                $tour_place = TourPlace::where([['tour_type', '2'], ['status', '1']])->get();

                if(count($tour_place) > 0){

                    foreach($tour_place as $list){

                        $bookmark = Bookmark::where([['user_id', $userId->id],['tour_id', $list->id]])->first();
                        $tour_image = TourPlaceImage::where('tour_place_id',$list->id)->first();

                        $orders = Order::where('user_id', $userId->id)->where('payment_status', '1')->get();
                    
                        $purchase_data = null; 
                        
                        foreach ($orders as $order) {
                            
                            $purchase_tour = PurchaseTour::where('tour_id', $list->id)->where('order_id', $order->id)->first();
                            
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
                        
                        $tourObj->tour_id = $list->id;
                        $tourObj->tour_image = $tour_image->image;
                        $tourObj->tour_name = $list->title;
                        $tourObj->demo_price = $list->demo_price;
                        $tourObj->tour_price = $list->price;
                        $tourObj->tour_offer = $list->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($list->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = $bookmark->status ?? null;
                        $tourObj->purchase_status = $purchase_data['purchase_status'];
                        $tourObj->purchase_id = $purchase_data['purchase_id'];
                        $tourObj->purchase_string = $purchase_data['purchase_string'];
                        $tourObj->geo_json_file_name = $list->json_url;
                        $tourObj->geo_json_update_status = $purchase_data['geo_json_update_status'];
                        $tourObj->geo_json_updated_data_time = $purchase_data['geo_json_updated_date_time'];
                        
                        if($list->tour_type == '1'){
                            $tourObj->bundle_status = '0';
                        }else{
                            $tourObj->bundle_status = '1';
                        }
                           
                        $tourObj->tour_description = $list->description ?? null;
                        $tourObj->tour_know_before_you_go = $list->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $list->free_tour_status;
                        $tourObj->free_tour_validate_date = $list->free_tour_validate_date ? Carbon::parse($list->free_tour_validate_date)->format('d-m-Y') : null;

                        $tour_location = TourLocation::where('tour_id', $list->id)->get();
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

                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
                }else{
                    return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
                }  

        }else{

                $tour_place = TourPlace::where([['tour_type', '2'], ['status', '1']])->get();

                if(count($tour_place) > 0){

                    foreach($tour_place as $list){

                        $tour_image = TourPlaceImage::where('tour_place_id',$list->id)->first();
    
                        
                        $tourObj = new \stdClass();
                        
                        $tourObj->tour_id = $list->id;
                        $tourObj->tour_image = $tour_image->image;
                        $tourObj->tour_name = $list->title;
                        $tourObj->demo_price = $list->demo_price;
                        $tourObj->tour_price = $list->price;
                        $tourObj->tour_offer = $list->offer_percentage;
                        $tourObj->tour_created_date = Carbon::parse($list->create_date)->format('d-m-Y');
                        $tourObj->bookmark_status = null;
                        $tourObj->purchase_status = null;
                        $tourObj->geo_json_file_name = $list->json_url;
                        $tourObj->geo_json_update_status = null;

                        if($list->tour_type == '1'){
                            $tourObj->bundle_status = '0';
                        }else{
                            $tourObj->bundle_status = '1';
                        }

                        $tourObj->geo_json_updated_data_time = null;
                        $tourObj->tour_description = $list->description ?? null;
                        $tourObj->tour_know_before_you_go = $list->know_before_you_go ?? null;
                        $tourObj->free_tour_status = $list->free_tour_status;
                        $tourObj->free_tour_validate_date = $list->free_tour_validate_date ? Carbon::parse($list->free_tour_validate_date)->format('d-m-Y') : null;

                        $tour_location = TourLocation::where('tour_id', $list->id)->get();
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

                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
                }else{
                    return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
                }
               
        }  
    }
}
