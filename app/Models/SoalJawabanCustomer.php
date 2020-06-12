<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalJawabanCustomer extends Model
{
    //
    protected $table = "soal_jawaban_customers";
    protected $fillable = ['customer_id', 'video_produk_id', 'soal_id', 'jawaban'];
}
