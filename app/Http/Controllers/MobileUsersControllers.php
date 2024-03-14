<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Mobile_user;
use Illuminate\Support\Facades\Validator;

class MobileUsersControllers extends Controller
{
    //
    public function Register(Request $request)
    {
   // echo "TEst";
   // echo "<pre>"; print_r($request->all()); exit;
            $register = Validator::make($request->all(), [  
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'mobile' => 'required',
            ]);

            if ($register->fails()) {   
                $response = [
                    'success' => false,
                    'message' => $register->errors(),
                ];
                return response()->json($response, 400); //-----400 is showing errors
            }

                $input = $request->all();
                $input [ 'password'] = Hash::make($input['password']);
                // $input['mobile'] = bcrypt($input['mobile']);
                $user = Mobile_user::create($input);

                // $success ['token'] = $user->createToken('MyApp')->plainTextToken;

                $response = [
                    'success'=> true,
                    'data ' => $user,
                    'message' => 'User Reigistered Successfull',
                ];

                return response()->json($response,200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|required',
            'password' => 'required',
        ]);    
        $user = Mobile_user::where('mobile', $request->mobile)->first();
    
        if ($user) {
            // Check if the user is already logged in
            $existingToken = $user->tokens;
            if ($existingToken && $existingToken->isNotEmpty()) {
                $response = [
                    'success' => false,
                    'message' => 'User is already logged in with the same mobile number.',
                ];
                return response()->json($response, 403);
            }
    
            // Validate the password
            if (Hash::check($request->password, $user->password)) {
           
            $success['mobile_user'] = $user;
           
                $response = [
                    'success' => true,
                    'data' => $success,
                    'message' => 'User logged in successfully',
                ];
    
                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Incorrect password',
                ];
                return response()->json($response, 401);
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'User not found',
            ];
            return response()->json($response, 404);
        }
    }
    

}