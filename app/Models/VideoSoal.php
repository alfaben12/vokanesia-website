<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VideoSoal extends Model
{

  use SoftDeletes;

  protected $dates = ['deleted_at'];
  
  public function courseDetails()
  {
    return $this->relationCourseDetails;
  }

  public function relationCourseDetails()
  {
    return $this->belongsTo('App\Models\CourseProduk', 'course_id');
  }
}
