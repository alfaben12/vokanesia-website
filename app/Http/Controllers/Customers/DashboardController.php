<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\CourseProduk;
use App\Models\PdfProduk;
class DashboardController extends Controller
{
    public function index()
    {
      $courseproduk = CourseProduk::inRandomOrder()->limit(6)->get();
      $ebookproduk = PdfProduk::inRandomOrder()->limit(6)->get();
        return view('customers.dashboard')->with([
          'courseproduk' => $courseproduk,
          'ebookproduk' => $ebookproduk,
        ]);
    }

    public function logout(Request $request)
    {
      Auth::guard("web_customers")->logout();
      return redirect()->route("auth.login");
    }
}
