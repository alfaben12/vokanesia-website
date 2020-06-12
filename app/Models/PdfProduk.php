<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
class PdfProduk extends Model
{

    use Sluggable, SoftDeletes;
    

    protected $dates = ['deleted_at'];

    public function userDetails()
    {
        return $this->userDetailRelation;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public function getCoverAttribute($value)
    {
        return str_replace('\\', '/', $value);
    }

    public function pdfUrl()
    {
        $origin = $this->pdf_uri;
        $dest =  (json_decode($origin))[0]->download_link;
        $dest = str_replace('\\', '/', $dest);
        return $dest;
    }

    public function kategoriDetails()
    {
        return $this->relationKategoriDetails;
    }

    public function relationKategoriDetails()
    {
        return $this->belongsTo('App\Models\Category', 'kategori_id');
    }

    public function userDetailRelation()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->id;
        }

        parent::save();
    }

    public function scopeCurrentUser($query)
    {
        if(Auth::user()->role_id !== 1){
            return $query->where('user_id', Auth::user()->id);
        }
    }

    public function jumlahOrderan()
    {
        $use = Auth::user();

        $totalPenjualanPerProduk = DB::table('pdf_produks AS pp')
            ->join('order_details AS od', 'od.produk_id', '=', 'pp.id')
            ->join('orders AS o', 'o.id', '=', 'od.order_id')
            ->where('od.type', 'pdf')
            ->where('o.status', 'success')
            ->where('pp.user_id',Auth::user()->id)
            ->where('pp.id', $this->id)
            ->count();

        return $totalPenjualanPerProduk;
    }
}
