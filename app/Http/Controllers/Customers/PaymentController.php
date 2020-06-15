<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Cart;

use Midtrans;

use Validator;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CustomerLibrary;
use App\Models\Coupon;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;

class PaymentController extends Controller
{

    function __construct()
    {
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY', '');
    }

    public function index($invoice)
    {
        $user = Auth::user();
        $order = Order::where(['customer_id' => $user->id])->orderBy('id', 'desc')->first();
        if($order){
            if($order->status != 'pending'){
                return redirect('/?message=payment_required');
            }
        }

        $order = Order::where(['invoice' => strval($invoice), 'status' => 'pending', 'customer_id' => $user->id])->first();

        return view('customers.payment.index')->with([
            'order' => $order
        ]);
    }

    public function uploadFilePayment(Request $request, $invoice)
    {
        if(!$_FILES){
            return response()->json([
            'status' => 'fail',
            ], 400);
        }

        $user = Auth::user();
        $order = Order::where(['invoice' => strval($invoice), 'status' => 'pending', 'customer_id' => $user->id])->first();

        if(!$order){
            return response()->json([
            'status' => 'fail',
            ], 404);
        }

        $file = $request->file('file');
        $destination_path = 'files';
        $path = $request->file('file')->store('file_proof/'. date('F'). date('Y'), 'cloud_kilat');

        $cloud_kilat_path = Storage::disk('cloud_kilat')->url($path);

        Order::find($order->id)->update(['status' => 'waiting', 'file_proof' => $cloud_kilat_path]);

        $url_arr[0]['text'] = 'Terima';
        $url_arr[0]['url'] = env('APP_URL_TELEGRAM') .'payment/accept/'. $order->id .'/'. $order->invoice;
        // $url_arr[0]['url'] = 'http://google.com';
         
        $url_arr[1]['text'] = 'Tolak';
        $url_arr[1]['url'] = env('APP_URL_TELEGRAM') .'payment/decline/'. $order->id .'/'. $order->invoice;
        // $url_arr[1]['url'] = 'http://google.com';

        $response = Telegram::sendPhoto([
            'chat_id' => '746433464', 
            'photo' => InputFile::create($cloud_kilat_path, 'Bukti pembayaran'), 
            'caption' => 'Total tagihan Invoice '. $order->invoice .' senilai Rp. '. $order->real_amount .',- menunggu verifikasi anda.',
            'parse_mode' => 'html',
            'reply_markup' => json_encode(['inline_keyboard' => [$url_arr]])
        ]);

        return response()->json([
            'status' => 'success',
        ], 200);
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
        //   $paymentUrl = Midtrans\Snap::createTransaction($params)->redirect_url;
          $paymentUrl = url('customers/payment/'. $invoice);
          
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

    public function accept_or_decline_payment(Request $request, $type, $id, $invoice)
    {
        $getOrder = Order::where(['id' => $id, 'invoice' => $invoice])->first();
        if($getOrder){
            if($getOrder->status != 'pending'){
                return response()->json([
                    'status' => $getOrder->status,
                    'message' => 'Invoice sudah di verifikasi pada '. $getOrder->updated_at,
                ], 200);
            }else{
                if($type == 'accept')
                {
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
                }else if($type == 'decline')
                {
                    Order::find(['id' => $getOrder->id, 'invoice' => $invoice])->update(['status' => 'failed']);
                }

                return response()->json([
                    'status' => $type,
                    'message' => 'Invoice berhasil di verifikasi'
                ], 200);
            }
        }else{
            return response()->json([
                'status' => 'fail',
                'message' => 'Invoice tidak dapat ditemukan',
            ], 404);
        }

    }
    
}

