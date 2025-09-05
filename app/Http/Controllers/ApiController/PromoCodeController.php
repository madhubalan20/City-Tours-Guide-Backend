<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\TourPlace;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    

public function getAllCoupon(Request $request)
{
    // Collect tour IDs from the request
    $tourList = $request->tour_list;
    $tourIds = collect($tourList)->pluck('tour_id')->toArray();

    // Fetch matching tour places
    $tourPlaces = TourPlace::whereIn('id', $tourIds)->pluck('id')->toArray();

    // Fetch promo codes based on conditions
    $tourCoupon = PromoCode::where('status', '1')
        ->where('validate_day', '>=', Carbon::now('Asia/Kolkata'))
        ->whereIn('tour_id', $tourPlaces)
        ->orderBy('id', 'asc')
        ->get();

    $userCoupon = PromoCode::where('status', '1')
        ->where('validate_day', '>=', Carbon::now('Asia/Kolkata'))
        ->where('user_id', Auth::user()->id) // Replace '2' with Auth::user()->id if needed
        ->orderBy('id', 'asc')
        ->get();

    $commanCoupon = PromoCode::where('status', '1')
        ->where('validate_day', '>=', Carbon::now('Asia/Kolkata'))
        ->whereNull('user_id')
        ->whereNull('tour_id')
        ->orderBy('id', 'asc')
        ->get();

    $TourUserCoupon = PromoCode::where('status', '1')
        ->where('validate_day', '>=', Carbon::now('Asia/Kolkata'))
        ->whereIn('tour_id', $tourPlaces)
        ->where('user_id', Auth::user()->id)
        ->orderBy('id', 'asc')
        ->get();    

    // Combine all coupon results
    $data = [];

    if ($tourCoupon->count() > 0) {
        foreach ($tourCoupon as $list) {
            $data[] = [
                'id' => $list->id,
                'user_id' => $list->user_id ?? null,
                'tour_id' => $list->tour_id ?? null,
                'coupon_code' => $list->coupon_code,
                'percentage' => $list->percentage,
                'maximum_discount_amount' => $list->maximum_discount_amount,
                'minimum_amount' => $list->minimum_order_amount,
                'flat_amount' => $list->flat_amount,
                'type' => $list->type,
                'validate_date' => Carbon::parse($list->validate_day)->format('d-m-Y'),
                'description' => $list->description,
            ];
        }
    }

    if ($userCoupon->count() > 0) {
        foreach ($userCoupon as $list) {
            $data[] = [
                'id' => $list->id,
                'user_id' => $list->user_id ?? null,
                'tour_id' => $list->tour_id ?? null,
                'coupon_code' => $list->coupon_code,
                'percentage' => $list->percentage,
                'maximum_discount_amount' => $list->maximum_discount_amount,
                'minimum_amount' => $list->minimum_order_amount,
                'flat_amount' => $list->flat_amount,
                'type' => $list->type,
                'validate_date' => Carbon::parse($list->validate_day)->format('d-m-Y'),
                'description' => $list->description,
            ];
        }
    }

    if ($commanCoupon->count() > 0) {
        foreach ($commanCoupon as $list) {
            $data[] = [
               'id' => $list->id,
                'user_id' => $list->user_id ?? null,
                'tour_id' => $list->tour_id ?? null,
                'coupon_code' => $list->coupon_code,
                'percentage' => $list->percentage,
                'maximum_discount_amount' => $list->maximum_discount_amount,
                'minimum_amount' => $list->minimum_order_amount,
                'flat_amount' => $list->flat_amount,
                'type' => $list->type,
                'validate_date' => Carbon::parse($list->validate_day)->format('d-m-Y'),
                'description' => $list->description,
            ];
        }
    }

    if ($TourUserCoupon->count() > 0) {
        foreach ($commanCoupon as $list) {
            $data[] = [
               'id' => $list->id,
                'user_id' => $list->user_id ?? null,
                'tour_id' => $list->tour_id ?? null,
                'coupon_code' => $list->coupon_code,
                'percentage' => $list->percentage,
                'maximum_discount_amount' => $list->maximum_discount_amount,
                'minimum_amount' => $list->minimum_order_amount,
                'flat_amount' => $list->flat_amount,
                'type' => $list->type,
                'validate_date' => Carbon::parse($list->validate_day)->format('d-m-Y'),
                'description' => $list->description,
            ];
        }
    }

    // Check if any data is available
    if (count($data) > 0) {
        return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
    } else {
        return response()->json(['message' => 'No Coupon Found', 'status' => false, 'code' => 404], 404);
    }
}

    public function checkCoupon(Request $request)
    {
        $coupon = PromoCode::where([['coupon_code', $request->coupon_code], ['status','1'],['validate_day', '>=', Carbon::now('Asia/Kolkata')]])->first();

        if ($coupon) {

            $data=[
                'id' => $coupon->id,
                'user_id'=>Auth::user()->id,
                'tour_id'=>$coupon ->tour_id ?? null,
                'coupon_code'=>$coupon ->coupon_code,
                'percentage'=>$coupon ->percentage,
                'maximum_discount_amount'=>$coupon ->maximum_discount_amount,
                'minimum_amount' => $coupon->minimum_order_amount,
                'flat_amount' => $coupon->flat_amount,
                'type' => $coupon->type,
                'validate_date'=>Carbon::parse($coupon->validate_day)->format('d-m-Y'),
                'description' => $coupon->description,
            ];

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'No Coupon Found', 'status' => true, 'code' => 404], 404);
        }
    }
}
