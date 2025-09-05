<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Mail\UpdatePasswordMail;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\UniqueCodeMail;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mail' => 'required|email|unique:users,email',
            'mobile_number' => 'required|unique:users,mobile_no',
            'password' => 'required',
        ],[
            'name.required' => 'The name is required  to setup an account.',
            'mail.required' => 'The email address is required to setup an account',
            'mail.email' => 'Please enter valid email address',
            'mail.unique' =>  'The email you entered is already associated with an account',
            'mobile_number.required' => 'The mobile number  is required to setup an account',
            'mobile_number.unique' => "The mobile number you entered is already associated with an account",
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false, 'code' => 422,], 422);    
        } else {

            $uniqueCode = rand(1000, 9999);

            $newUser = new User;
            $newUser->name = $request->name;
            $newUser->email = $request->mail;
            $newUser->mobile_no = $request->mobile_number;
            $newUser->password = bcrypt($request->password);
            $newUser->hash_password = $request->password;
            $newUser->user_group_id = '2';
            $newUser->verify_code = $uniqueCode;
            $newUser->device_id = $request->device_id ?? null;
            $newUser->one_signal_id = $request->one_signal_id ?? null;
            $newUser->push_token = $request->pushToken ?? null;
            $newUser->device_brand = $request->device_brand ?? null;
            $newUser->device_model = $request->device_model ?? null;
            $newUser->device_SDK = $request->device_SDK ?? null;
            $newUser->device_manufacture = $request->device_manufacture ?? null;
            $newUser->app_release = $request->app_release ?? null;
            $newUser->save();

            $token = 'Bearer ' . $newUser->createToken('MyApp')->accessToken;

            $name=$request->name;
            $email = $request->mail;

            try {
                Mail::to($email)->send(new UniqueCodeMail($uniqueCode, $name));
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                return response()->json(['message' => 'Mail sending failed', 'status' => false], 500);
            }

            $data = [
                'user_id' => $newUser->id,
                'token' => $token,
            ];

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
        }
    }

    public function verifyEmail(Request $request)
    {
        $user = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();

        if ($user) {

            if ($request->verify_code == $user->verify_code) {

                $user->verify_status = '1';
                $user->update();

                return response()->json(['message' => 'Success', 'status' => true, 'code' => 200], 200);

            } else {

                return response()->json(['message' => 'The verification code you entered is incorrect.', 'status' => false, 'code' => 404], 404);
            }
        } else {
            return response(['message' => 'User not found.', 'status' => false, 'code' => 404], 404);
        }
    }

    public function login(Request $request)
    {
        if ($request->type == '1') {

            $user = User::where([['mobile_no', $request->input_value], ['user_group_id', '2']])->first();

            if($user){

                if ($user->hash_password == $request->password) {

                    if ($user->delete_account_status == '1') {
                        
                        $user->tokens()->delete();
                        
                        $user->update([
                            'active_status' => '1',
                            'device_id' => $request->device_id ?? null,
                            'one_signal_id' => $request->one_signal_id ?? null,
                            'push_token' => $request->pushToken ?? null,
                            'device_brand' => $request->device_brand ?? null,
                            'device_model' => $request->device_model ?? null,
                            'device_SDK' => $request->device_SDK ?? null,
                            'device_manufacture' => $request->device_manufacture ?? null,
                            'app_release' => $request->app_release ?? null,
                        ]);
                        
                        $token = 'Bearer ' . $user->createToken('MyApp')->accessToken;
                        
                        return response()->json(['data' => ['user_id' => $user->id, 'verify_status' => $user->verify_status, 'token' => $token,],'message' => 'Ok','status' => true,], 200);
                    
                    } else {
                        return response()->json([
                            'message' => 'Your account has been deleted. Please contact the support team for assistance.', 
                            'status' => false, 
                            'code' => 404
                        ], 404);
                    }
                }else{
                    return response()->json([
                        'message' => 'Please enter the correct password.',
                        'status' => false, 
                        'code' => 404
                    ], 404);
                }
            }else{

                return response()->json([
                    'message' => 'The mobile number you entered is not associated with an account.',
                    'status' => false, 
                    'code' => 404
                ], 404);
            }   
        }
        
        if ($request->type == '2') {

            $user = User::where([['email', $request->input_value],['user_group_id', '2']])->first();

            if($user){

                if ($user->hash_password == $request->password) {
                
                    if ($user->delete_account_status == '1') {
                        
                        $user->tokens()->delete();
                        $user->update([
                            'active_status' => '1',
                            'device_id' => $request->device_id ?? null,
                            'one_signal_id' => $request->one_signal_id ?? null,
                            'push_token' => $request->pushToken ?? null,
                            'device_brand' => $request->device_brand ?? null,
                            'device_model' => $request->device_model ?? null,
                            'device_SDK' => $request->device_SDK ?? null,
                            'device_manufacture' => $request->device_manufacture ?? null,
                            'app_release' => $request->app_release ?? null,
                        ]);
                        
                        $token = 'Bearer ' . $user->createToken('MyApp')->accessToken;
                        
                        return response()->json([
                            'data' => ['user_id' => $user->id, 'verify_status' => $user->verify_status, 'token' => $token,],'message' => 'Ok',' status' => true,'code' => 200
                        ], 200);
    
                    } else {
                        return response()->json([
                            'message' => 'Your account has been deleted. Please contact the support team for assistance.', 
                            'status' => false, 
                            'code' => 404
                        ], 404);
                    }
                }else{
                    return response()->json([
                        'message' => 'Please enter the correct password.', 
                        'status' => false, 
                        'code' => 404
                    ], 404);
                }
            }else{
                return response()->json([
                    'message' => 'The email you entered is not associated with an account.', 
                    'status' => false, 
                    'code' => 404
                ], 404);
            }
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {

            $userData = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();
            $userData->active_status = '0';
            $userData->update();

            $user->token()->revoke();
            return response([
                'status' => true,
                'message' => 'User logout successfully',
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Please login to access the tour',
            ], 401);
        }
    }

    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->mail)->first();

        if ($user) {

            $uniqueCode = rand(1000, 9999);

            $name=$user->name;
            $email = $user->email;
            $user->verify_code = $uniqueCode;
            $user->update();

            try {
                Mail::to($email)->send(new UpdatePasswordMail($uniqueCode, $name));
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                return response()->json(['message' => "The request didn't send to your email address due to mail server issue", 'status' => false], 500);
            }

            $token = 'Bearer ' . $user->createToken('MyApp')->accessToken;

            $data=[
                'user_id'=>$user->id,
                'token'=> $token,
            ];
            
                return response()->json(['data'=>$data, 'status' => true, 'code' => 200], 200);

        } else {
            return response(['message' => 'The email you entered is not associated with an account.', 'status' => false, 'code' => 404], 404);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();

        if ($user) {

            if($request->password){

                $user->password = bcrypt(value: $request->password);
                $user->hash_password = $request->password;
                $user->update();
                
                return response()->json(['message'=>'ok', 'status' => true, 'code' => 200], 200);

            }else{
                return response(['message' => 'Password Is Required', 'status' => false, 'code' => 404], 404); 
            }

        } else {
            return response(['message' => 'Please login to access the tour', 'status' => false, 'code' => 401], 401);
        }
    }

    public function register_resend_mail(Request $request)
    {
        $user = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();
        
        if($user){
            
            $uniqueCode = rand(1000, 9999);
            $user->verify_code = $uniqueCode;
            $user->update();

            $name=$user->name;
            $email = $user->email;

            try {
                Mail::to($email)->send(new UniqueCodeMail($uniqueCode, $name));
            } catch (\Exception $e) {
                
                return response()->json(['message' => "The request didn't send to your email address due to mail server issue", 'status' => false], 500);
            }

            return response()->json(['message' => 'Ok', 'status' => true, 'code' => 200], 200);

        }else{
            return response(['message' => 'Please login to access the tour', 'status' => false, 'code' => 401], 401);
        }
    }


    public function forgot_password_resend_mail(Request $request)
    {
        $user = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();
        
        if($user){
            
            $uniqueCode = rand(1000, 9999);
            $user->verify_code = $uniqueCode;
            $user->update();

            $name=$user->name;
            $email = $user->email;

            try {
                Mail::to($email)->send(new UpdatePasswordMail($uniqueCode, $name));
            } catch (\Exception $e) {
                
                return response()->json(['message' => "The request didn't send to your email address due to mail server issue", 'status' => false], 500);
            }

            return response()->json(['message' => 'Ok', 'status' => true, 'code' => 200], 200);

        }else{
            return response(['message' => 'Please login to access the tour', 'status' => false, 'code' => 401], 401);
        }
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user) {

            $user = User::where([['id', Auth::user()->id], ['user_group_id', '2']])->first();
            $user->delete_account_status = '0';
            $user->update();

            return response([
                'status' => true,
                'message' => 'Successfully',
                'code' => 200
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Please login to access the tour',
            ], 401);
        }
    }
}
