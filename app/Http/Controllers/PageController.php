<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
class PageController extends Controller
{
    public function index($slug)
    {
        $data = Page::where('slug', $slug)->first();
        if(!$data)
        {
            abort(404);
        }
        return view('pages')->with('data', $data);
    }
}
