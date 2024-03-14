<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    //
    public function Register(Request $request)
    {
            $register = validator::make($request->all(), [  
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'mobile' => 'required',
                'status' => '1',
            ]);

            if ($register->fails()) {   
                $response = [
                    'success' => false,
                    'message' => $register->errors(),
                ];
                return response()->json($response, 400); //-----400 is showing errors
            }

                $input = $request->all();
                // $input['mobile'] = bcrypt($input['mobile']);
                $user = User::create($input);

                // $success ['token'] = $user->createToken('MyApp')->plainTextToken;
                $success ['name'] = $user->name;

                $response = [
                    'success'=> true,
                    'data ' => $success,
                    'message' => 'User Reigistered Successfull',
                ];

                return response()->json($response,200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'password' => 'required',
        ]);
    
        $user = User::where('mobile', $request->mobile)->first();
    
        if ($user) {
            // Check if the user is already logged in
            if (auth()->check()) {
                $response = [
                    'success' => false,
                    'message' => 'User is already logged in with the same mobile number.',
                ];
                return response()->json($response, 403);
            }
    
            // Validate the password
            if (Hash::check($request->password, $user->password)) {
                $success['name'] = $user->name;
    
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
