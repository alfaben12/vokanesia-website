<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Storage;
use Carbon;
use App\Models\PdfProduk;
class EbookController extends Controller
{
    public function show($id)
    {
        $data = PdfProduk::find($id);
        $asset = (json_decode($data->pdf_uri)[0]->download_link);
        //$asset = str_replace('.pdf', '', $asset_url);
        return view('customers.ebook')->with(['data' => $data, 'asset' => $asset]);
    }
}
