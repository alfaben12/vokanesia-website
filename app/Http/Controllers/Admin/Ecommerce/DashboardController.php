<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PdfProduk;
use App\Models\CourseProduk;
use App\User;
use DB;
use Auth;
class DashboardController extends VoyagerBaseController
{

    public function showDashboard()
    {
        $role_id = Auth::user()->role_id;
        if($role_id == 1)
        {
            $card_data = $this->showDashboardAdmin();
            $dashboard = 'admin';
        }else if($role_id == 3)
        {
            $card_data = $this->showDashboardMentor();
            $dashboard = 'mentor';
        }else if($role_id == 4 ){
            $card_data = $this->showDashboardBookStore();
            $dashboard = 'book_store';
        }else{
            $card_data = [];
            $dashboard = '';
        }
        
        
        
        return view('admin.e-bookstore.dashboard')->with(['card_data' => $card_data, 'dashboard' => $dashboard]);
    }

    public function showDashboardAdmin()
    {
        $customers = Customer::count();
        $mentor = User::where(['role_id' => 3])->count();
        $book_store = User::where(['role_id' => 4])->count();
        $penjualanVideo = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'video');

        $penjualanPdf = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'pdf');

        if($penjualanVideo->sum('harga') > 0)
        {
            $keuntunganVideo = ($penjualanVideo->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $keuntunganVideo = 0;
        }

        if($penjualanPdf->sum('harga') > 0)
        {
            $keuntunganPdf = ($penjualanPdf->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $keuntunganPdf = 0;
        }

        $card_data = array(
            'customers' => $customers,
            'mentor' => $mentor,
            'book_store' => $book_store,
            'penjualan_course' => $penjualanVideo->count(),
            'penjualan_ebook' => $penjualanPdf->count(),
            'keuntungan_course' =>  $keuntunganVideo,
            'keuntungan_ebook' => $keuntunganPdf
        );

        return $card_data;
        
    }

    public function showDashboardMentor()
    {
        $totalPenjualan = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'video')
                        ->where('user_id', '=', Auth::user()->id);
        $penjualan = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'video')
                        ->whereYear('orders.updated_at', date('Y'))
                        ->whereMonth('orders.updated_at', date('m'))
                        ->where('user_id', '=', Auth::user()->id);

        if($totalPenjualan->sum('harga') > 0)
        {
            $totalKeuntungan = ($totalPenjualan->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $totalKeuntungan = 0;
        }

        if($penjualan->sum('harga') > 0)
        {
            $keuntungan = ($penjualan->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $keuntungan = 0;
        }

        $dataTable = CourseProduk::where('user_id', Auth::user()->id)->get();

        $card_data = array(
            'total_penjualan' => $totalPenjualan->count(),
            'total_keuntungan' =>  $totalKeuntungan,
            'penjualan' => $penjualan->count(),
            'keuntungan' =>  $keuntungan,
            'data_table' => $dataTable
        );

        return $card_data;
    }

    public function showDashboardBookStore()
    {
        $totalPenjualan = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'pdf')
                        ->where('user_id', '=', Auth::user()->id);
        $penjualan = DB::table('order_details')
                        ->join('orders', 'order_details.order_id', '=', 'orders.id')
                        ->where('orders.status', '=', 'success')
                        ->where('order_details.type', '=', 'pdf')
                        ->whereYear('orders.updated_at', date('Y'))
                        ->whereMonth('orders.updated_at', date('m'))
                        ->where('user_id', '=', Auth::user()->id);

        if($totalPenjualan->sum('harga') > 0)
        {
            $totalKeuntungan = ($totalPenjualan->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $totalKeuntungan = 0;
        }

        if($penjualan->sum('harga') > 0)
        {
            $keuntungan = ($penjualan->sum('harga') / 100) * (100 - setting('admin.royalty_bookstore'));
        }else{
            $keuntungan = 0;
        }

        $dataTable = PdfProduk::where('user_id', Auth::user()->id)->get();

        $card_data = array(
            'total_penjualan' => $totalPenjualan->count(),
            'total_keuntungan' =>  $totalKeuntungan,
            'penjualan' => $penjualan->count(),
            'keuntungan' =>  $keuntungan,
            'data_table' => $dataTable
        );

        return $card_data;
        
    }
}
