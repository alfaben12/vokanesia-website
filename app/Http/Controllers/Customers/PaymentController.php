<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Cart;

use Midtrans;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CustomerLibrary;

use App\Models\Coupon;
class PaymentController extends Controller
{

    function __construct()
    {
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
    }

    private function createOrderDetails($data)
    {
        OrderDetail::create($data);
    }

    public function create(Request $request)
    {

        $user = Auth::user();
        $couponInput = $request->input('promo_code');
        $cart = Cart::where(['customer_id' => $user->id])->get();
        $grandTotal = 0;
        foreach($cart as $row)
        {
            $grandTotal += $row->produkDetails()->harga;
        }

        $dataOrderInput['customer_id'] = $user->id;
        $coupon = Coupon::where('code', $couponInput)->whereDate('expired_at', '>', date('Y-m-d'))->first();
        
        if($coupon)
        {
            $dataOrderInput['coupon_id'] = $coupon->id;
            $dataOrderInput['gross_amount'] = $this->grandTotalDiskon($coupon->discount, $grandTotal);
        }else{
            $dataOrderInput['gross_amount'] = $grandTotal;
        }
        $dataOrderInput['real_amount'] = $grandTotal;
        $dataOrderInput['status'] = 'pending';

        $createOrder = Order::create($dataOrderInput);

        $orderId = $createOrder->id;
        $invoice = 'Inv-'.date('Ymd').$orderId;
        Order::find($orderId)->update(['invoice' => $invoice]);
        foreach($cart as $row)
        {

            if($coupon){
                $harga = $this->grandTotalDiskon($coupon->discount, $row->produkDetails()->harga);
                $dataOrderDetailInput['coupon_id'] = $coupon->id;
            }else{
                $harga = $row->produkDetails()->harga;
            }
            
            $dataOrderDetailInput = array(
                'customer_id' => $user->id,
                'order_id' => $orderId,
                'type' => $row->type,
                'produk_id' => $row->produk_id,
                'harga' => $harga,
                'harga_real' => $row->produkDetails()->harga,
                'user_id' => $row->produkDetails()->user_id
            );

            $createOrderDetails = OrderDetail::Create($dataOrderDetailInput);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice,
                'gross_amount' => $createOrder->gross_amount,
            )
        );
        
        try {
            // Get Snap Payment Page URL
          $paymentUrl = Midtrans\Snap::createTransaction($params)->redirect_url;
          
          // Redirect to Snap Payment Page
          return response()->json([
              'status' => 'success',
              'midtrans_uri' => $paymentUrl
          ], 200);
        }
        catch (Exception $e) {
          return response()->json([
              'status' => 'error',
              'message' => 'Something Worng With Server Please Try Again Later'
          ], 200);
        }
    }

    private function grandTotalDiskon($diskon, $total)
    {
        $total = ($total / 100) * (100 - $diskon);

        return $total;
    }

    public function checkCoupon(Request $request)
    {
        $coupon = $request->input('promo_code');
        $coupon = Coupon::where('code', $coupon)->whereDate('expired_at', '>', date('Y-m-d'))->first();
        if(!$coupon)
        {
            return response()->json([
                'state' => 'error',
                'message' => 'Promo Code Tidak Valid Atau Sudah Kadaluarsa'
            ], 200);
        }
        return response()->json([
            'state' => 'success',
            'data' => $coupon
        ], 200);
    }

    public function notification(Request $request)
    {
        $req = file_get_contents('php://input');
        $req = json_decode($req, TRUE);
        if($req['status_code'] == '200')
        {
            $getOrder = Order::where(['invoice' => $req['order_id']])->first();
            if($getOrder)
            {
                Order::find($getOrder->id)->update(['status' => 'success']);

                foreach($getOrder->getOrderDetails() as $row)
                {
                    $cLibraryInput = array(
                        'customer_id' => $row->customer_id,
                        'produk_id' => $row->produk_id,
                        'type' => $row->type
                    );

                    CustomerLibrary::firstOrCreate($cLibraryInput);
                    Cart::where('produk_id', $row->produk_id)->delete();
                }
            }
        }else if($req['status_code'] == '202')
        {
            Order::find($getOrder->id)->update(['status' => 'failed']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'success'
        ], 200);
    }
    
}

