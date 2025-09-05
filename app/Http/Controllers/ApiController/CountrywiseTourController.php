<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\TourPlace;
use Illuminate\Http\Request;
use phpseclib3\File\ASN1\Maps\CountryName;

class CountrywiseTourController extends Controller
{
    
    public function countryTour(Request $request){
        
        $tour_place=TourPlace::where('status','1')->get();
        
        if(count($tour_place) > 0){
            
            $data = []; 
            $processedStates = []; 
            
            foreach ($tour_place as $tour) {
                
                $state = State::where([['id', $tour->state_id], ['status', '1']])->first();
                
                if ($state) {
                    
                    if (in_array($state->id, $processedStates)) {
                        
                        continue;
                    }
                    
                    $cities = City::where([['state_id', $state->id], ['status', '1']])->get();
                    
                    $citydata = [];
                    
                    foreach ($cities as $city) {
                        
                        $citydata[] = [
                            'city_id' => $city->id,
                            'city_name' => $city->name,
                            'city_image' => $city->image,
                        ];
                    }
                    
                    $statedata = [
                        'state_id' => $state->id,
                        'state_name' => $state->name,
                        'city_list' => $citydata,
                    ];
                    
                    $data[] = $statedata; 
                    $processedStates[] = $state->id; 
                
                } else {
                    
                    return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
                }
            }
            
            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
        }else{
            
            return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
        }

    }
}
