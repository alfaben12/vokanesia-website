<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Order;
class HistoryController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $data = Order::where('customer_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('customers.history')->with(['data' => $data]);
    }
}
