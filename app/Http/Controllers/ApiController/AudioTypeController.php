<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AudioType;
use App\Models\CurrencyType;
use Illuminate\Http\Request;

class AudioTypeController extends Controller
{
    public function AudioType(Request $request)
    {
        $audioType = AudioType::where('status','1')->get();

        if ($audioType) {
            $data=[];
            foreach($audioType as $audiotypes){
                $data[] = [
                    'audio_id' => $audiotypes->id,
                    'name' => $audiotypes->name,
                    'code' => $audiotypes->lang_code
                ];
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'No Data Found', 'status' => true, 'code' => 404], 404);
        }
    }

    public function Currencytype(Request $request)
    {
        $CurrencyType = CurrencyType::where('status','1')->get();

        if ($CurrencyType) {
            $data=[];
            
            foreach($CurrencyType as $currencyTypes){
                $data[] = [
                    'currency_id' => $currencyTypes->id,
                    'symbol'=>$currencyTypes->symbol,
                    'name' => $currencyTypes->name,
                    'code' => $currencyTypes->code,
                ];
            }
            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'No Data Found', 'status' => true, 'code' => 404], 404);
        }
    }
}
