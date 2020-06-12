<?php

namespace App\Http\Controllers\Customers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

use App\Service\WooWa;
class OtpController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        try {
          $this->sendOtp($user->id);
          return view('customers.otp.index')->with('user');
        } catch (\Exception $e) {
          return view('customers.otp.index')->with([
            'error' => true,
          ]);
        }
    }

    public function send()
    {
        //
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp_code' => 'required'
        ]);

        $user = Auth::user();
        $otp = $request->input('otp_code');

        $check = Customer::where(['id' => $user->id, 'otp' => $otp])->first();

        if(!$check)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'Kode Otp Anda Salah'
            ], 403);
        }

        $update = Customer::where('id', $user->id)->update(['otp' => '000000', 'verivied' => 'yes']);

        return response()->json([
            'status' => 'success',
            'message' => 'Akun Anda Telah Terverifikasi'
        ], 200);
    }

    private function sendOtp($user_id)
    {
        $client = new WooWa;

        $user = Customer::find($user_id);

        $randOtp = rand(111111, 999999);

        Customer::where(['id' => $user_id])->update(['otp' => $randOtp,'no_hp' => $user->no_hp, 'verivied' => 'no' ]);
          $send = $client->sendOtp($user->no_hp, $randOtp);
    }
}
