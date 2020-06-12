<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
class InvoiceController extends Controller
{
    public function index($id)
    {
        $data = Order::find($id);
        return view('customers.invoice')->with(['data' => $data ]);
    }
}
