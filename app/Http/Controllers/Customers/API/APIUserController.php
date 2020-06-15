<?php

namespace App\Http\Controllers\Customers\API;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIUserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }
        $email = $request->email;
       

        try {
            $credentials = $request->only(['email', 'password']);
            $user = User::where('email', $email)->first();
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'invalid_credentials'],
                    400);
            }
            
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'could_not_create_token'],
                500);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
            'token' => $token,
        ], 200);
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer',
            'password' => 'required|string|min:6',
        ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors()->toJson(), 400);
        // }

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role_id' => $request->get('role_id'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        // return response()->json(compact('user','token'),201);
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,

        ], 200);

    }

     public function updateUser(Request $request) 
     {
        
         try {
            if (! $account = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            } 
             $user = User::where('id', $account['id'])->first();
             $data = User::findOrFail($user->id);
             $data->name = $request->input('name');
             $data->email = $request->input('email');
             $data->avatar = $request->input('avatar');
             $data->update();
             return response()->json([
                'success' => true,
                'message' => 'Success Update Data',
    
            ], 200);

         }
              catch(JWTException $e){
              return response()->json([
                  'status' => '400', 'message' => 'Failed Update Data' 
              ]);
        }
         }

         public function logout(Request $request)
         {
             if(JWTAuth::invalidate(JWTAuth::getToken())){
                 return response()->json([
                     "logged" => false,
                     "message" => 'Logout Success'
                 ], 200);
             }
             else {
                 return response()->json([
                     "logged"=> true,
                     "message"=> 'Logout Failed'
                 ], 400);
             }
         }
    
    

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

}
