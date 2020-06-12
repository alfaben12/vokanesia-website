<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketBox extends Model
{

    protected $table = 'ticket_boxes';
    protected $fillable = [
        'ticket_id',
        'user_id',
        'customer_id',
        'reply',
    ];
}
