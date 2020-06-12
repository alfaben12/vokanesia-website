<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\Ticket;
use App\Models\TicketBox;
class MessagesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = Ticket::where('customer_id', $user->id)->get();
        return view('customers.messages')->with('data', $data);
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        
        $dataInput = array(
            'customer_id' => $user->id,
            'judul' => $request->input('judul'),
            'message' => $request->input('message'),
            'status' => 'open'
        );

        $input = Ticket::create($dataInput);

        $tiket_no = Ticket::where('id', $input->id)->update(['ticket_no' => '#Tck'. date('Ymd').$input->id]);

        return redirect()->back();
    }

    public function replay($id, Request $request)
    {
        $user = Auth::user();

        $dataInput = array(
            'customer_id' => $user->id,
            'reply' => $request->input('replay'),
            'ticket_id' => $id, 
        );

        TicketBox::create($dataInput);

        return redirect()->back();
    }
}
