<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use Auth;
use App\Models\Cart;
use App\Models\Order;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $order = Order::where(['customer_id' => $user->id])->orderBy('id', 'desc')->first();
        if($order->status != 'pending'){
            return redirect('/?message=payment_required');
        }
        $user = Auth::user();
        $get = Cart::where(['customer_id' => $user->id])->get();
        $data = [];
        $total = 0;
        foreach($get as $row){
            $data[] = array(
                'produk_id' => $row->produk_id,
                'produk' => $row->produkDetails()
            );
        };
        return view('customers.cart.index')->with([
            'user' => $user,
            'data' => $data,
            'total' => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $getOrder = Order::where(['customer_id' => $user->id])->orderBy('id', 'desc')->first();
        if($getOrder){
            if($getOrder->status != 'pending'){
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Pembayaran belum diselesaikan',
                    'order' => $getOrder
                ], 402);
            }
        }

        $data = Cart::firstOrCreate([
            'produk_id' => $request->input('produk_id'),
            'customer_id' => $user->id,
            'type' => $request->input('produk_type')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk Telah Ditambahkan Ke Dalam Cart',
            'cartcount' => $user->totalCart()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $data = Cart::where(['customer_id' => $user->id, 'produk_id' => $id])->delete();

        return redirect()->back();
    }
}
