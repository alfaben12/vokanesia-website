<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'invoice',
        'customer_id',
        'order_id',
        'type',
        'user_id',
        'produk_id',
        'harga',
        'harga_real',
        'coupon_id'
    ];

    public function filterSuccess()
    {
        return $this->relationOrderDetails;
    }

    public function relationOrderDetails()
    {
        return $this->hasOne('App\Models\Order', 'id', 'order_id');
    }

    public function getProdukDetails()
    {
        if($this->type == 'video')
        {
            return $this->relationCourseDetails;
        }else{
            return $this->relationPdfDetails;
        }
    }

    public function getCourseDetails()
    {
        return $this->relationCourseDetails;
    }

    public function relationCourseDetails()
    {
        return $this->belongsTo('App\Models\CourseProduk', 'produk_id');
    }

    public function relationPdfDetails()
    {
        return $this->belongsTo('App\Models\PdfProduk', 'produk_id');
    }
}
