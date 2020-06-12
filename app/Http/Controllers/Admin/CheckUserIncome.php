<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\User;
use App\Models\RoyaltyBookStore as RBS;
use DB;
class CheckUserIncome extends Controller
{
    public function check(Request $request)
    {
        $user = User::find($request->input('user_id'));

        
        if($user->role_id == 4)
        {
            $find = RBS::where('user_id', $user->id)->first();
            $royalti = $find ? $find->royalty : 0;
            $type = 'pdf';
        }else{
            $royalti = setting('admin.royalty_course') ? setting('admin.royalty_course') : 0;
            $type = 'video';
        }

        $penjualan = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', $type)
                        ->whereYear('orders.updated_at', date('Y'))
                        ->whereMonth('orders.updated_at', date('m'))
                        ->where('user_id', '=', $user->id);

        if($penjualan->sum('harga') > 0)
        {
            $keuntungan = ($penjualan->sum('harga') / 100) * (100 - $royalti);
        }else{
            $keuntungan = 0;
        }

        $res = array(
            'nama_rekening' => $user->nama_rekening,
            'bank' => $user->bank,
            'nomor_rekening' => $user->nomor_rekening,
            'nominal' => round($keuntungan)
        );



        return response()->json([
            'data' => $res
        ], 200);


    }
}
