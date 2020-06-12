<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Validator;

use App\Service\WooWa;
class RegisterController extends Controller
{
  public function index()
  {
    return view('auth/register');
  }

  public function do(Request $request)
  {
    $validator = Validator::make($request->all(),
    [
      'email' => 'required|email|unique:customers,email',
      'f_name' => 'required',
      'l_name' => 'required',
      'password' => 'required|min:8',
      'c_password' => 'required|same:password|min:8',
      'no_hp' => 'required|min:9|unique:customers,no_hp',
    ],
    [
      'email.required' => 'Email is empty',
      'email.unique' => 'Email already used',
      'f_name.required' => 'First name is empty',
      'l_name.required' => 'Last name is empty',
      'password.required' => 'Password is empty',
      'password.min' => 'Password must be at least 8 character',
      'c_password.min' => 'Confirmation Password must be at least 8 character',
      'c_password.required' => 'Confirmation password confirmation is empty',
      'c_password.same' => 'Confirmation password must be same with password',
      'no_hp.required' => 'Phone number is empty',
      'no_hp.min' => 'Phone number must be at least 9 character',
      'no_hp.unique' => 'Phone already used',
    ]);

    if ($validator->passes()) {
      $client = new WooWa;

      $randOtp = rand(111111, 999999);
      try {
        $send = $client->sendOtp($request->input('no_hp'), $randOtp);
        $dataInput = array(
          'email' => $request->input('email'),
          'nama' => $request->input('f_name').' '.$request->input('l_name'),
          'password' => Hash::make($request->input('c_password')),
          'no_hp' => $request->input('no_hp'),
          'verivied' => 'no',
          'otp' => $randOtp
        );

        $create = Customer::create($dataInput);

        return response()->json([
          'status' => 'success',
          'message' => 'otp_sended'
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'error' => true,
          'message' => $e->getMessage()
        ], 500);
      }

    }

    else {
      return response()->json([
        "status" => "failed",
        "message" => implode(",<br />", $validator->errors()->all())
      ]);
    }
  }
}
