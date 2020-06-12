<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;

class MessageBoxController extends VoyagerBaseController
{

    public function show(Request $request, $id)
    {

        $data = \App\Models\Ticket::find($id);
        return view('vendor.voyager.tickets.read')->with('data', $data);
    }
}
