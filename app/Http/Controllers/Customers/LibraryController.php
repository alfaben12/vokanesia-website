<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\CustomerLibrary;

class LibraryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = CustomerLibrary::where(['customer_id' => $user->id])->get();
        return view('customers.library')->with(['data' => $data]);
    }
}
