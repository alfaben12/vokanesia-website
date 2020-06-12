<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLibrary extends Model
{
    protected $fillable = [
        'customer_id',
        'produk_id',
        'type'
    ];

    public function produkDetails()
    {
        if($this->type == 'video')
        {
            return $this->relationProdukCourseDetails;
        }else{
            return $this->relationPdfProdukDetails;
        }
    }

    public function relationPdfProdukDetails()
    {
        return $this->belongsTo('App\Models\PdfProduk', 'produk_id');
    }

    public function relationProdukCourseDetails()
    {
        return $this->belongsTo('App\Models\CourseProduk', 'produk_id');
    }
}
