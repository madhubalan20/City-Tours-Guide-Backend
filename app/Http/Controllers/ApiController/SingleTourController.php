<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Order;
use App\Models\PurchaseTour;
use App\Models\TourArticle;
use App\Models\TourLocation;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\TourResource;
use App\Models\TourVideo;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SingleTourController extends Controller
{
    public function SingleTour(Request $request)
    {
         $userId = User::where('id', $request->user_id)->first();

         if($userId){
         
             $tour_place = TourPlace::where('id', $request->tour_id)->first();
         
             if($tour_place){
                
                $bookmark = Bookmark::where([['user_id', $userId->id], ['tour_id', $tour_place->id]])->first();
                $bookmark_count = Bookmark::where([['tour_id', $tour_place->id], ['status', '1']])->count();

                $orders = Order::where('user_id', $userId->id)->where('payment_status', '1')->get();
                 
                $purchase_data = null; 
                 
                foreach ($orders as $order) {
                    
                    $purchase_tour = PurchaseTour::where('tour_id', $tour_place->id)->where('order_id', $order->id)->first();
                    
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
                 $tourObj->tour_id = $tour_place->id;
                 $tourObj->tour_name = $tour_place->title;
                 $tourObj->demo_price = $tour_place->demo_price;
                 $tourObj->tour_price = $tour_place->price;
                 $tourObj->tour_offer = $tour_place->offer_percentage;
                 $tourObj->tour_duration = $tour_place->duration_time;
                 $tourObj->tour_audio_count = $tour_place->audio_point;
                 $tourObj->tour_stops = $tour_place->tour_stops;
                 $tourObj->fav_count = $bookmark_count ?? null;
                 $tourObj->bookmark_status = $bookmark->status ?? null;
                 $tourObj->purchase_status = $purchase_data['purchase_status'];
                 $tourObj->tour_created_date = Carbon::parse($tour_place->create_date)->format('d-m-Y');
                 $tourObj->geo_json_file_name = $tour_place->json_url;
                 $tourObj->purchase_id = $purchase_data['purchase_id'];
                 $tourObj->purchase_string = $purchase_data['purchase_string'];
                 $tourObj->geo_json_update_status = $purchase_data['geo_json_update_status'];
                 $tourObj->geo_json_updated_data_time = $purchase_data['geo_json_updated_date_time'];
                 $tourObj->tour_preview_image  = $tour_place->preview_image ?? null;
                 $tourObj->tour_description = $tour_place->description ?? null;
                 $tourObj->tour_know_before_you_go = $tour_place->know_before_you_go ?? null;
                 $tourObj->free_tour_status = $tour_place->free_tour_status;
                 $tourObj->free_tour_validate_date = $tour_place->free_tour_validate_date ? Carbon::parse($tour_place->free_tour_validate_date)->format('d-m-Y') : null;

                 $tour_location = TourLocation::where('tour_id', $tour_place->id)->get();
                 $location_bound = []; 
                        
                 foreach($tour_location as $location){
                     $locationObj = new \stdClass();
                     $locationObj->latitude = $location->latitude ?? Null;
                     $locationObj->longitude = $location->longitude ?? Null;
                     $location_bound[] = $locationObj; 
                 }
            
                 $tourObj->location_bound = $location_bound;
         
                 $combinedData = [];
         
                 $tour_images = TourPlaceImage::where('tour_place_id', $tour_place->id)->orderBy('id', 'desc')->get();
                 if (count($tour_images) > 0) {
                     foreach ($tour_images as $image) {
                         $combinedData[] = [
                             'id' => $image->id,
                             'tour_image_type' => 'image',
                             'image' => $image->image,
                             'url' => null,
                         ];
                     }
                 }
         
                 $tour_videos = TourVideo::where('tour_id', $tour_place->id)->orderBy('id', 'desc')->get();
                 if (count($tour_videos) > 0) {
                     foreach ($tour_videos as $video) {
                         $combinedData[] = [
                             'id' => $video->id,
                             'tour_image_type' => 'video',
                             'image' => null,
                             'url' => $video->video_url,
                         ];
                     }
                 }
         
                 $tourObj->images = $combinedData;
         
                
                 $tour_resource = TourResource::where([['tour_id', $tour_place->id], ['status', '1']])->orderBy('id', 'desc')->get();
                 $tourResource = [];
                 if (count($tour_resource) > 0) {
                     foreach ($tour_resource as $resource) {
                         $tourResource[] = [
                             'id' => $resource->id,
                             'image' => $resource->image,
                             'title' => $resource->title,
                             'url' => $resource->url,
                         ];
                     }
                 }
                 $tourObj->resource = $tourResource;
         
                 // Fetch tour-related articles
                 $tour_article = TourArticle::where([['tour_id', $tour_place->id], ['status', '1']])->orderBy('id', 'desc')->get();
                 $tourArticle = [];
                 if (count($tour_article) > 0) {
                     foreach ($tour_article as $article) {
                         $tourArticle[] = [
                             'id' => $article->id,
                             'image' => $article->image,
                             'title' => $article->title,
                             'url' => $article->url,
                             'description' => $article->description ?? null,
                         ];
                     }
                 }
                 $tourObj->related_articles = $tourArticle;
         
                 $data = $tourObj;
         
                 return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
             } else {
                 return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
             }
         } else{
        
            $tour_place = TourPlace::where('id', $request->tour_id)->first();
            
            if($tour_place){
                   
                $tourObj = new \stdClass();
                        
                $tourObj->tour_id = $tour_place->id;
                $tourObj->tour_name = $tour_place->title;
                $tourObj->demo_price = $tour_place->demo_price;
                $tourObj->tour_price = $tour_place->price;
                $tourObj->tour_offer = $tour_place->offer_percentage;
                $tourObj->tour_duration = $tour_place->duration_time;
                $tourObj->tour_audio_count = $tour_place->audio_point;
                $tourObj->tour_stops = $tour_place->tour_stops;
                $tourObj->fav_count = null;
                $tourObj->bookmark_status = null;
                $tourObj->purchase_status = null;
                $tourObj->tour_created_date = Carbon::parse($tour_place->create_date)->format('d-m-Y');
                $tourObj->geo_json_file_name = $tour_place->json_url;
                $tourObj->geo_json_update_status = null;
                $tourObj->geo_json_updated_data_time = null;
                $tourObj->tour_preview_image  = $tour_place->preview_image ?? null;
                $tourObj->tour_description = $tour_place->description ?? null;
                $tourObj->tour_know_before_you_go = $tour_place->know_before_you_go ?? null;
                $tourObj->free_tour_status = $tour_place->free_tour_status;
                $tourObj->free_tour_validate_date = $tour_place->free_tour_validate_date ? Carbon::parse($tour_place->free_tour_validate_date)->format('d-m-Y') : null;

                $tour_location = TourLocation::where('tour_id', $tour_place->id)->get();
                $location_bound = []; 
                        
                foreach($tour_location as $location){
                     $locationObj = new \stdClass();
                     $locationObj->latitude = $location->latitude ?? Null;
                     $locationObj->longitude = $location->longitude ?? Null;
                     $location_bound[] = $locationObj; 
                }
            
                $tourObj->location_bound = $location_bound;

                $combinedData = [];
         
                 $tour_images = TourPlaceImage::where('tour_place_id', $tour_place->id)->orderBy('id', 'desc')->get();
                 if (count($tour_images) > 0) {
                     foreach ($tour_images as $image) {
                         $combinedData[] = [
                             'id' => $image->id,
                             'tour_image_type' => 'image',
                             'image' => $image->image,
                             'url' => null,
                         ];
                     }
                 }
         
                 $tour_videos = TourVideo::where('tour_id', $tour_place->id)->orderBy('id', 'desc')->get();
                 if (count($tour_videos) > 0) {
                     foreach ($tour_videos as $video) {
                         $combinedData[] = [
                             'id' => $video->id,
                             'tour_image_type' => 'video',
                             'image' => null,
                             'url' => $video->video_url,
                         ];
                     }
                 }
         
                 $tourObj->images = $combinedData;
         
                
                 $tour_resource = TourResource::where([['tour_id', $tour_place->id], ['status', '1']])->orderBy('id', 'desc')->get();
                 $tourResource = [];
                 if (count($tour_resource) > 0) {
                     foreach ($tour_resource as $resource) {
                         $tourResource[] = [
                             'id' => $resource->id,
                             'image' => $resource->image,
                             'title' => $resource->title,
                             'url' => $resource->url,
                         ];
                     }
                 }
                 $tourObj->resource = $tourResource;
         
                 // Fetch tour-related articles
                 $tour_article = TourArticle::where([['tour_id', $tour_place->id], ['status', '1']])->orderBy('id', 'desc')->get();
                 $tourArticle = [];
                 if (count($tour_article) > 0) {
                     foreach ($tour_article as $article) {
                         $tourArticle[] = [
                             'id' => $article->id,
                             'image' => $article->image,
                             'title' => $article->title,
                             'url' => $article->url,
                             'description' => $article->description ?? null,
                         ];
                     }
                 }
                 $tourObj->related_articles = $tourArticle;
         
                 $data = $tourObj;

                    return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
                }else{
                    return response()->json(['message' => 'No Tour Found', 'status' => false, 'code' => 404], 404);
                }
        }  
    }
}
