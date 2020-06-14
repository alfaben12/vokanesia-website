<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice',
        'customer_id',
        'gross_amount',
        'real_amount',
        'coupon_id',
        'status',
        'file_proof'
    ];

    public function getCustomerDetails()
    {
        return $this->relationCustomerDetails;
    }

    public function relationCustomerDetails()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function getOrderDetails()
    {
        return $this->relationOrderDetails;
    }

    public function relationOrderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }
}
