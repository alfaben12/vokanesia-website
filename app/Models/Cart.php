<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'type',
        'produk_id',
        'customer_id',
    ];

    public function produkDetails()
    {
        if($this->type == 'video')
        {
            return $this->videoProduk;
        }else{
            return $this->pdfProduk;
        }
    }

    public function videoProduk(){
        return $this->belongsTo('App\Models\CourseProduk', 'produk_id');
    }

    public function pdfProduk()
    {
        return $this->belongsTo('App\Models\PdfProduk', 'produk_id');
    }

}
