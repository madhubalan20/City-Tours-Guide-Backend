<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportImage;
use App\Models\TourPlace;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Str;

class UserReportController extends Controller
{
    
    public function userReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'problem_type' => 'required'
        ], [
            'type.required' => 'The report type is missing, Please check to submit the issue.',
            'problem_type.required' => 'The problem type is missing , Please check to submit the issue.',
        ]);

        if($request->type == '1'){
            $validator->addRules([
                'tour_id' => 'required',
            ]);
            $validator->setAttributeNames([
                'tour_id.required' => 'Please select tour for submit the issue.'
            ]);
        }
        
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => false,
                'code' => 422
            ], 422);
        }

        $user = User::where([['id', Auth::user()->id],['user_group_id', '2']])->first();

        if ($user) {

            $tour = TourPlace::where('id', $request->tour_id)->select('title')->first();

            $userReport = new Report;
            $userReport-> user_id = $user->id;
            $userReport-> type = $request->type;

            if($request->type == '1'){
                $userReport-> tour_id = $request->tour_id ?? null;
                $userReport-> tour_name = $tour->title ?? null;
            }else{
                $userReport-> tour_id = null;
                $userReport-> tour_name = null; 
            }
            
            $userReport-> problem_type = $request->problem_type;
            $userReport-> description = $request->description;
            $userReport-> create_date = Carbon::now('Asia/Kolkata');
            $userReport->save();

            if ($request->image) {

                foreach ($request->image as $reportImage) {
                    $imageName = time() . '_' . Str::random(10) . '.' . $reportImage->getClientOriginalExtension();
                    $path = $reportImage->storeAs('user-report-image', $imageName, 'public');
                    
                    $newImage = new ReportImage;
                    $newImage->report_id = $userReport->id;
                    $newImage->image = url("storage/" . $path);
                    $newImage->save();
                }
            }

            return response()->json(['message' => 'ok', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'Please login to access the tour', 'status' => true, 'code' => 404], 404);
        }
    }
}
