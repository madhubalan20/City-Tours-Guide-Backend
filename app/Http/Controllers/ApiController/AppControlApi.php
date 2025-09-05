<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AppControll;
use Illuminate\Http\Request;

class AppControlApi extends Controller
{
    public function appcontrol(Request $request) {
        
        $appcontrol = AppControll::where('id', 1)->first();
        
        if (is_null($appcontrol)) {
            $response = ['code' => 404, 'status' => false, 'message' => 'No data found'];
            return response()->json($response, 404);
        }
    
        $data = [
            "privacy_policy" => $appcontrol->privacy_policy,
            "terms" => $appcontrol->term_conditions,
            "contact_number_tech" => $appcontrol->tech_support_number,
            "contact_number_customer" => $appcontrol->contact_number,
            "contact_mail" => $appcontrol->contact_email,
            "whatsapp" => $appcontrol->whatsapp_number,
            "instagram" => $appcontrol->instagram_link,
            "facebook" => $appcontrol->facebook_link,
            "office_timing" =>$appcontrol->office_timing,
            "tech_support_url" => $appcontrol->tech_support_url,
            "razorpay_key" => $appcontrol->razorpay_merchant_key,
            "razorpay_id" => $appcontrol->razorpay_merchant_id,
            "splash_image" => $appcontrol->splash_image,
            "mapbox_access_token" => $appcontrol->mapbox_access_token,
            "splash_time_sec" => $appcontrol->splash_time_sec,
            "android_version_code" => $appcontrol->android_version_code,
            "android_version_name" => $appcontrol->android_version_name,
        ];
    
        $response = ['data' => $data, 'status' => true, 'message' => "ok", 'code' => 200];
        return response()->json($response, 200);
    }
    
}
