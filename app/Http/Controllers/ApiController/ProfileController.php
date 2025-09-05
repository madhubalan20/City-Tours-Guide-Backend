<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\AudioType;
use App\Models\CurrencyType;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = User::where([['id', Auth::user()->id],['user_group_id', '2']])->first();

        if ($user) {

            $user->update_date = Carbon::now('Asia/Kolkata');
            $user->active_status = '1';
            $user->update();

            $currency = CurrencyType::where('id', $user->currency_id)->first();
            $audio = AudioType::where('id', $user->audio_id)->first();

            $currencyData=[
                'currency_id'=>$currency ->id ?? null,
                'currency_name'=>$currency ->name ?? null,
                'currency_symbol'=>$currency ->symbol ?? null,
                'currency_code'=>$currency ->code ?? null,
            ];

            $audioData=[
                'audio_id'=>$audio ->id ?? null,
                'audio_name'=>$audio ->name ?? null,
                'audio_code'=>$audio ->lang_code ?? null,
            ];

            $data = [
                'user_id' => $user->id,
                'user_name' => $user->name ?? null,
                'user_phone_number' => $user->mobile_no ?? null,
                'user_email' => $user->email ?? null,
                'user_image' => $user->profile_photo_path ?? null,
                'active_status' => $user->active_status,
                'verify_status' => $user->verify_status,
                'currency' => $currencyData,
                'audio' => $audioData,
            ];

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        } else {
            return response()->json(['message' => 'Please login to access the tour', 'status' => true, 'code' => 401], 401);
        }
    }
    
    public function EditUser(Request $request){

        $user=User::where('id',Auth::user()->id)->first();

        if($user){

            $request->validate([
                'name' => 'required|string',
                'image' => 'image|max:1024|mimes:jpg,jpeg,png',
            ],[
                'image.max' => 'The image must be less than 1 MB.'
            ]);

            $user->name = $request->name;

            if ($request->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();
                $path = $request->image->storeAs('profileimage', $imageName, 'public');
                $user->profile_photo_path = url("storage/" . $path);
            }

            $user->save();

            return response()->json(['message' => 'Ok', 'status' => true, 'code' => 200], 200); 

        }else{

            return response()->json(['message' => 'Please login to access the tour', 'status' => false, 'code' => 401], 401);

        }
    }

    public function EditUserPreference(Request $request){

        $user=User::where('id',Auth::user()->id)->first();

        if($user){

            if($request->currency_id ){

                if($request->audio_id ){

                    $user->currency_id = $request->currency_id;
                    $user->audio_id = $request->audio_id;
                    $user->save();
        
                    return response()->json(['message' => 'Ok', 'status' => true, 'code' => 200], 200);
                }else{

                return response()->json(['message' => 'The audio field is required.', 'status' => false, 'code' => 404], 404);

                }
            }else{
                return response()->json(['message' => 'The currency field is required.', 'status' => false, 'code' => 404], 404);
            }
        }else{
            return response()->json(['message' => 'Please login to access the tour', 'status' => false, 'code' => 401], 401);

        }
    }
}
