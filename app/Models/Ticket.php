<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
class Ticket extends Model
{
    //

    protected $fillable = [
        'ticket_no',
        'judul',
        'customer_id',
        'message',
        'status'
    ];

    public function ticketMessages()
    {
        return $this->relationTicketMessages;
    }

    public function relationTicketMessages()
    {
        return $this->hasMany('App\Models\TicketBox');
    }

    public function customerDetails()
    {
        return $this->relationCustomerDetails;
    }

    public function relationCustomerDetails()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
