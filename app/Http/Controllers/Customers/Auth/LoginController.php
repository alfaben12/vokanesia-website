<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Validator;
use App\Models\Customer;
class LoginController extends Controller
{
  public function index()
  {
    return view('auth/login');
  }

  public function messages()
  {
    return [
      'email.required' => 'Email Di butuhkan',
      'password.required' => 'Password Di butuhkan'
    ];
  }

  public function do_login(Request $request)
  {
    $validator = Validator::make($request->all(),
    [
      'email' => 'required|email',
      'password' => 'required|min:8'
    ],
    [
      'password.min' => 'Password must be at least 8 characters.'
    ]);
    if ($validator->passes()) {
      $findEmail = Customer::where('email', $request->input('email'))->first();

      if(!$findEmail){
        return response()->json([
          'status' => 'error',
          'message' => 'Email Tidak Terdaftar'
        ], 200);
      }

      $credentials = $request->only('email', 'password');

      if(Auth::guard('web_customers')->attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
        $url = null;
        if ($request->filled("url")) $url = $request->url;
        return response()->json([
          'status' => 'success',
          'message' => 'success',
          'url' => $url
        ], 200);
      }else{
        return response()->json([
          'status' => 'error',
          'message' => 'Kombinasi Email Dan Password Salah'
        ], 200);
      }
    }
    else {
      return response()->json([
        "status" => "error",
        "message" => implode(",<br />", $validator->errors()->all())
      ], 200);
    }

  }
}
