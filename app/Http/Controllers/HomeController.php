<?php

namespace App\Http\Controllers;

use App\Models\PdfProduk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_pdf = PdfProduk::limit(3)->get();
        return view('home')->with(['pdfs' => $data_pdf]);
    }
}
