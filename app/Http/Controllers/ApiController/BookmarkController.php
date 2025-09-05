<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function bookmarkTour(Request $request){

        $userId = User::where([['id', Auth::user()->id],['user_group_id', '2']])->first();

        if($userId){

            $tour= TourPlace::where('id', $request->tour_id)->first();

            if($tour){
    
                if($request->status == '1'){
    
                    $bookmark = Bookmark::where([['user_id', $userId->id ],['tour_id', $tour->id]])->first();
    
                    if($bookmark){
                        $bookmark->status=  '1';
                        $bookmark->update();

                        return response()->json(['message' => 'Added as BookMark', 'status' => true, 'code' => 200], 200);
                    }else{
    
                        $add_bookmark = new Bookmark;
                        $add_bookmark->user_id=  $userId->id;
                        $add_bookmark->tour_id=  $tour->id;
                        $add_bookmark->status=  '1';
                        $add_bookmark->save();

                        return response()->json(['message' => 'Added as BookMark', 'status' => true, 'code' => 200], 200);
                    }
    
                }elseif($request->status == '0'){
    
                    $bookmark = Bookmark::where([['user_id', $userId->id ],['tour_id', $tour->id]])->first();
    
                    if($bookmark){
                        $bookmark->status=  '0';
                        $bookmark->update();

                        return response()->json(['message' => 'Remove From BookMark', 'status' => true, 'code' => 200], 200);
                    }
                }
    
            }else{
                return response()->json(['message' => 'Invalid Tour', 'status' => false, 'code' => 404], 404);
            }
        }else{
            return response([ 'message' => 'Please login to access the tour', 'status' => false,'code' => 401], 401);
        }
    }


    public function myBookmark(Request $request){

        $userId = User::where([['id', Auth::user()->id],['user_group_id', '2']])->first();

        if($userId){
            
            $bookmark = Bookmark::where([['user_id', $userId->id],['status', '1']])->get();
            
            if(count($bookmark) > 0){
                
                $data=[];

                foreach($bookmark as $bookmarklist){

                    $tour= TourPlace::where('id', $bookmarklist->tour_id)->first();
                    $tour_image= TourPlaceImage::where('tour_place_id', $tour->id)->first();
                    
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
                    
                    $data[]=([
                        'tour_id'=>$tour->id,
                        'tour_name'=>$tour->title,
                        'tour_image'=>$tour_image->image,
                        'bookmark_status'=>$bookmarklist->status,
                        'purchase_status' => $purchase_data['purchase_status'],
                        'demo_price'=>$tour->demo_price,
                        'tour_price'=>$tour->price,
                        'offer'=>$tour->offer_percentage,
                        'tour_description'=>$tour->description ?? null,
                        'tour_know_before_you_go'=>$tour->know_before_you_go ?? null,
                        'geo_json_file_name' => $tour->json_url,
                        'geo_json_update_status' => $purchase_data['geo_json_update_status'],
                        'geo_json_updated_data_time' => $purchase_data['geo_json_updated_date_time'],
                        'purchase_id' => $purchase_data['purchase_id'],
                        'purchase_string' => $purchase_data['purchase_string'],
                        'free_tour_status' => $tour->free_tour_status,
                        'free_tour_validate_date' => $tour->free_tour_validate_date ? Carbon::parse($tour->free_tour_validate_date)->format('d-m-Y') : null,

                    ]);
                }
                
                return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
            }else{
                
                return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
            }
        }else{

            return response([ 'message' => 'Please login to access the tour', 'status' => false,'code' => 401], 401);
        }
    }

}
