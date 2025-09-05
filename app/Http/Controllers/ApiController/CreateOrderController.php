<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AppControll;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\State;
use App\Models\TourPlace;
use App\Models\TourPlaceImage;
use App\Models\User;
use App\Models\PurchaseTour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderController extends Controller
{
    public function creaateTour(Request $request){

        $userId = User::where([['user_group_id', '2'],['id', Auth::user()->id]])->first();

        if($userId){

            $newOrder = new Order;
            $newOrder->order_string = 'PUR-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $newOrder->user_id = $userId->id;
            $newOrder->coupon_id = $request->coupon_id ?? null;
            $newOrder->coupon_code = $request->coupon_code ?? null;
            $newOrder->coupon_amount = $request->coupon_amount ?? null;
            $newOrder->sub_total = $request->sub_total;
            $newOrder->overall_total = $request->overall_total;
            $newOrder->purchase_date = Carbon::now('Asia/Kolkata');
            $appcontrol = AppControll::where('id', '1')->first();
            $newOrder->expiry_date = Carbon::now('Asia/Kolkata')->addDays($appcontrol->purchase_validate_date);
            $newOrder->payment_type="Razorpay";
            $newOrder->payment_status="2";
            $newOrder->payment_message="Payment Pending";
            $newOrder->save();

            if($newOrder){

                foreach($request->tour as $value){

                    if($value['free_tour_status'] == '1'){
                        $updateNewOrder = Order::where('id', $newOrder->id)->first();
                        $updateNewOrder->expiry_date = Carbon::createFromFormat('d-m-Y', $value['free_tour_validate_date'])->format('Y-m-d');
                        $updateNewOrder->purchase_type = "Free";
                        $updateNewOrder->update();
                    }else{
                        $updateNewOrder = Order::where('id', $newOrder->id)->first();
                        $updateNewOrder->purchase_type = "Paid";
                    }

                    $tour_place = TourPlace::where('id', $value['tour_id'])->first();
                    $tour_image = TourPlaceImage::where('tour_place_id', $tour_place->id)->first();
                    $country = Country::where('id', $tour_place->country_id)->first();
                    $state = State::where('id', $tour_place->state_id)->first();
                    $city = City::where('id', $tour_place->city_id)->first();

                    $purchase_tour = new PurchaseTour;
                    $purchase_tour->user_id = $userId->id;
                    $purchase_tour->order_id = $newOrder->id;
                    $purchase_tour->tour_id = $tour_place->id;
                    $purchase_tour->country_id = $country->id;
                    $purchase_tour->state_id = $state->id;
                    $purchase_tour->city_id = $city->id;
                    $purchase_tour->tour_image = $tour_image->image;
                    $purchase_tour->tour_name = $tour_place->title;
                    $purchase_tour->json_url = $tour_place->json_url;
                    $purchase_tour->country_name = $country->name;
                    $purchase_tour->state_name = $state->name;
                    $purchase_tour->city_name = $city->name;
                    $purchase_tour->tour_description = $tour_place->description ?? null;
                    $purchase_tour->tour_know_before_you_go = $tour_place->know_before_you_go ?? null;
                    $purchase_tour->demo_price = $tour_place->demo_price;
                    $purchase_tour->offer_percentage = $tour_place->offer_percentage ?? '0';
                    $purchase_tour->price = $value['tour_price'];
                    $purchase_tour->purchase_status = '0'; 
                    if($value['free_tour_status'] == '1'){
                        $purchase_tour->purchase_type = "Free";
                    }else{
                        $purchase_tour->purchase_type = "Paid";
                    }
                    $purchase_tour->save();                   
                }
            }

            return response()->json(['purchase_id' => $newOrder->id, 'purchase_string' => $newOrder->order_string, 
            'total_amount'=> $newOrder->overall_total, 'message' => 'Success', 'status' => true, 'code'=> 200], 200);

        }else{
            return response([ 'message' => 'Please login to access the tour', 'status' => false,'code' => 401], 401);
        }
    }
}
