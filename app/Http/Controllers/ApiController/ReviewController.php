<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request){

        $review = Review::orderBy('id', 'desc')->get();

        if(count($review) > 0){

            foreach($review as $reviewlist){

                $dataObj = new \stdClass();

                $dataObj->review_id=$reviewlist->id;
                $dataObj->name=$reviewlist->name;
                $dataObj->rating_value=$reviewlist->rating_value;
                $dataObj->review = $reviewlist->review_content ?? null;
                
                $data[] = $dataObj; 
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        }else{
            return response()->json(['message' => 'No Reviews Found', 'status' => false, 'code' => 404], 404);
        }
    }
}
