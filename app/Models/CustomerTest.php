<?php

namespace App\MOdels;

use Illuminate\Database\Eloquent\Model;

class CustomerTest extends Model
{
    protected $table = [
        'customer_id',
        'course_id',
        'start',
        'end',
        'expired_at',
        'customer_score',
    ];

    public function customerDetails()
    {
        return $this->relationCustomerDetails;
    }

    public function relationCustomerDetails()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function courseDetails()
    {
        return $this->relationCourseDetails;
    }

    public function relationCourseDetails()
    {
        return $this->belongsTo('App\Models\CourseProduk', 'course_id');
    }

}
