<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Banner;
use App\Models\PdfProduk;
use App\Models\CourseProduk;
use App\Models\Category as Kategori;
use App\Models\OrderDetail;
class ShopController extends Controller
{
    public function index($type)
    {

        $banner = Banner::get();
        if($type == 'ebook' || $type == 'pdf'){
            $type = 'ebook';
            $dataProduk = PdfProduk::all("id", "name", "harga", "cover", "slug", "kategori_id")->sortByDesc('created_at');
        }else if($type == 'video'){
            $type = 'video';
            $dataProduk = CourseProduk::all("id", "name", "harga", "cover", "slug", "kategori_id")->sortByDesc('created_at');
        }else{
            $dataProduk = [];
        }

        $page = 1;
        if (isset($_GET["page"])) {
          $page = $_GET["page"];
        }
        return view('shop.index')->with([
            'produk_list' => $dataProduk->forPage($page, 9),
            'page' => $page,
            'type' => $type
        ]);
    }

    public function search($type, Request $request)
    {
      //
      if (!$request->filled("q")) {
        return redirect()->route("shop.index", ['type' => $type])->withError("Masukkan kata kunci pencarian anda");
      }
      $search = preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $request->q);
      if($type == 'video'){
        $type = 'video';
        $dataProduk = CourseProduk::where("name", "like", "%$search%")->get(["id", "harga", "name", "cover", "kategori_id", "slug"])->sortByDesc('created_at');
      }else if($type == 'ebook' || $type == 'pdf'){
        $type = 'ebook';
        $dataProduk = PdfProduk::where("name", "like", "%$search%")->get(["id", "name", "harga", "cover", "kategori_id", "slug"])->sortByDesc('created_at');
      }else{
        $dataProduk = [];
      }
      
      $page = 1;
      if (isset($_GET["page"])) {
        $page = $_GET["page"];
      }
      return view('shop.index')->with([
        'produk_list' => $dataProduk->forPage($page, 9),
        'page' => $page,
        'search' => $search,
        'type' => $type
      ]);
    }

    public function show($type, $kategori, $title)
    {
      $kat = Kategori::where('slug', $kategori)->first();
      if(!$kat){
        return redirect()->route("customers.shop.index")->withError("Tidak ditemukan produk dengan data tersebut");
      }
      if($type == 'video')
      {
        $type = 'video';
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
        $type = 'ebook';
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
}
