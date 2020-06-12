<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

use DB;

use Illuminate\Database\Eloquent\SoftDeletes;
class CourseProduk extends Model
{
  use Sluggable, SoftDeletes;
  protected $dates = ['deleted_at'];
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

  public function kategoriDetails()
  {
    return $this->relationKategoriDetails;
  }

  public function relationKategoriDetails()
  {
    return $this->belongsTo('App\Models\Category', 'kategori_id');
  }

  public function userDetails()
  {
    return $this->relationUserDetails;
  }

  public function relationUserDetails()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function hasAsset()
  {
    return $this->relationHasAsset;
  }

  public function countSoal()
  {
    return $this->hasManyThrough('App\Models\VideoSoal', 'App\Models\VideoProduk',  'course_id', 'video_id');
  }

  public function countQuiz()
  {
    return $this->hasManyThrough('App\Models\VideoSoal', 'App\Models\VideoProduk',  'course_id', 'video_id')->whereNotIn('video_soals.id', $this->soaljawaban->pluck("soal_id")->toArray());
  }

  public function soalJawaban()
  {
    $user = Auth::user();
    return $this->hasManyThrough('App\Models\SoalJawabanCustomer', 'App\Models\VideoProduk','course_id', 'video_produk_id')->where('customer_id', $user->id);
  }

  public function relationHasAsset()
  {
    return $this->hasMany('App\Models\VideoProduk', 'course_id', 'id');
  }

  public function passingGrade()
  {
    $passingGrade = 70;
    return $passingGrade;
  }

  public function scoreCustomer()
  {
    $user = Auth::user();

    $jawabanBenar = DB::table('course_produks AS cp')
    ->join('video_produks AS vp', 'vp.course_id' , '=' , 'cp.id')
    ->join('video_soals AS vs', 'vs.video_id' , '=' , 'vp.id')
    ->join('soal_jawaban_customers AS sjb', 'sjb.soal_id' , '=' , 'vs.id')
    ->whereRaw('sjb.jawaban = vs.jawaban')
    ->whereRaw('sjb.customer_id ='. $user->id)
    ->where('cp.id', $this->id)
    ->count();
    $jumlahSoal = $this->countSoal->count();

    if($jumlahSoal > 0){
      $passingGrade = $this->passingGrade();

      $customerGrade = (100/$jumlahSoal) * $jawabanBenar;

      if ($customerGrade > $passingGrade) {
        $collection = collect([
          "pass" => true,
          "score" => $customerGrade
        ]);
        return $collection;
      }
      else {
        $collection = collect([
          "pass" => false,
        ]);
        return $collection;
      }
    }else{
      $collection = collect([
        "pass" => false,
      ]);
      return $collection;
    }
  }

  public function jumlahOrderan()
    {
        $use = Auth::user();

        $totalPenjualanPerProduk = DB::table('course_produks AS cp')
            ->join('order_details AS od', 'od.produk_id', '=', 'cp.id')
            ->join('orders AS o', 'o.id', '=', 'od.order_id')
            ->where('od.type', 'video')
            ->where('o.status', 'success')
            ->where('cp.user_id',Auth::user()->id)
            ->where('cp.id', $this->id)
            ->count();

        return $totalPenjualanPerProduk;
    }
}
