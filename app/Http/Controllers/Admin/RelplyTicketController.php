<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TicketBox;
use App\Models\Ticket;
use Auth;
class RelplyTicketController extends Controller
{
    public function reply(Request $request, $id)
    {
        $user = Auth::user()->id;
        
        $data = array(
            'ticket_id' => $id,
            'user_id' => $user,
            'reply' => $request->input('reply')
        );

        TicketBox::create($data);

        return response()->json([
            'status' => 'success'
        ], 200);
    }

    public function resolve($id)
    {
        Ticket::find($id)->update(['status' => 'closed']);

        return redirect('/admin/tickets');
    }
}
