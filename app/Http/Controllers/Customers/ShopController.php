<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\PdfProduk;
use App\Models\OrderDetail;
use App\Models\CourseProduk;
use Illuminate\Http\Request;
use Auth;

use App\Models\Category as Kategori;

class ShopController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $courseproduk = CourseProduk::all("id", "name", "harga", "cover", "slug", "kategori_id")->sortByDesc('created_at');
    $pdfproduk = PdfProduk::all("id", "name", "harga", "cover", "slug", "kategori_id")->sortByDesc('created_at');
    $produk_list = collect();
    $produk_list = $produk_list->merge($pdfproduk);
    $produk_list = $produk_list->merge($courseproduk);

    $page = 1;
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    return view('customers.shop.index')->with([
      'produk_list' => $produk_list->forPage($page, 9),
      'page' => $page
    ]);
  }

  public function search(Request $request)
  {
    //
    if (!$request->filled("q")) {
      return redirect()->route("customers.shop.index")->withError("Masukkan kata kunci pencarian anda");
    }
    $search = $request->q;
    $videoproduk = PdfProduk::where("name", "like", "%$search%")->get(["id", "name"])->sortByDesc('created_at');
    $courseproduk = CourseProduk::where("judul_course", "like", "%$search%")->get(["id", "harga", "judul_course", "course_cover"])->sortByDesc('created_at');
    $produk_list = collect();
    $produk_list = $produk_list->merge($videoproduk);
    $produk_list = $produk_list->merge($courseproduk);
    $page = 1;
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    return view('customers.shop.index')->with([
      'produk_list' => $produk_list->forPage($page, 9),
      'page' => $page,
      'search' => $search
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
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($type, $kategori, $title)
  {
    $kat = Kategori::where('slug', $kategori)->first();
    if(!$kat){
      return redirect()->route("customers.shop.index")->withError("Tidak ditemukan produk dengan data tersebut");
    }
    if($type == 'video')
    {
      $produk = CourseProduk::where('slug', $title)->first();
      $oderdetails = OrderDetail::where
      ([
        ["customer_id", Auth::guard("web_customers")->id()],
        ["type", "video"],
        ["produk_id", $produk->id]
      ])
      ->with("relationOrderDetails")->get();
      if(!$produk)
      {
        return redirect()->route("customers.shop.index")->withError("Tidak ditemukan produk dengan data tersebut");
      }
    }else if($type == 'pdf')
    {
      $produk = PdfProduk::where('slug', $title)->first();
      $oderdetails = OrderDetail::where
      ([
        ["customer_id", Auth::guard("web_customers")->id()],
        ["type", "pdf"],
        ["produk_id", $produk->id]
      ])
      ->with("relationOrderDetails")->get();
      if(!$produk)
      {
        return redirect()->route("customers.shop.index")->withError("Tidak ditemukan produk dengan data tersebut");
      }
    }else{
      return redirect()->route("customers.shop.index")->withError("Tidak ditemukan produk dengan data tersebut");
    }

    return view('shop.show')->with([
      'type' => $type,
      'produk' => $produk
    ]);
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
    //
  }
}
