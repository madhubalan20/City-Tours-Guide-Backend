<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\MapIcon;
use Illuminate\Http\Request;

class MapIconController extends Controller
{
    public function mapIcons(Request $request){

        $icons = MapIcon::get();

        if(count($icons) > 0){

            foreach($icons as $iconlist){

                $dataObj = new \stdClass();

                $dataObj->id = $iconlist->id;
                $dataObj->name = $iconlist->name;
                $dataObj->icon = $iconlist->icon;
                $dataObj->marker_symbol = $iconlist->marker_symbol ?? null;
                
                $data[] = $dataObj; 
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        }else{
            return response()->json(['message' => 'No Icons Found', 'status' => false, 'code' => 404], 404);
        }
    }
}
