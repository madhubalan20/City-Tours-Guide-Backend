<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\CityResource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function cityResource(Request $request){

        $city_resource = CityResource::where([['city_id', $request->city_id],['status', '1']])->orderBy('id', 'desc')->get();

        if(count($city_resource) > 0){

            foreach($city_resource as $resourcelist){

                $data[]=[
                    'id'=>$resourcelist->id,
                    'image'=>$resourcelist->image,
                    'title'=>$resourcelist->title,
                    'url'=>$resourcelist->url,
                ];
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
        }else{
            return response()->json(['message' => 'No Resource Found', 'status' => false, 'code' => 404], 404);

        }
    }
}
