<?php

namespace App\Models;
use Storage;
use Illuminate\Database\Eloquent\Model;
use Auth;

use Illuminate\Database\Eloquent\SoftDeletes;
class VideoProduk extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'video_name',
        'pdf_name',
        'name',
        'youtube_url'
    ];

    public function videoUrl()
    {

        if(!$this->youtube_url){
            $dest = $this->video_name;
        }else{
            $dest = $this->youtube_url;
        }
        return $dest;
    }

    public function pdfUrl()
    {
        $origin = $this->pdf_name;
        $dest =  json_decode($origin);
        if(!isset($dest[0]->download_link)){
            $dest = '';
        }else{
            $dest = str_replace('\\', '/', $dest[0]->download_link);
        }
        return $dest;
    }

    public function userDetails()
    {
        return $this->relationUserDetails;
    }

    public function relationUserDetails()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function courseDetails()
    {
        return $this->relationCourseDetails;
    }

    public function relationCourseDetails()
    {
        return $this->hasOne('App\Models\CourseProduk', 'id', 'course_id');
    }
    public function countAnsweredQuiz()
    {
        return $this->quiz->count();
    }

    public function quiz() {
      return $this->hasMany("App\Models\VideoSoal", "video_id", "id")->whereNotIn('video_soals.id', $this->soaljawaban->pluck("soal_id")->toArray());
    }

    public function soalJawaban()
    {
        $user = Auth::user();
        return $this->hasMany('App\Models\SoalJawabanCustomer','video_produk_id', 'id')->where('customer_id', $user->id);
    }
}
