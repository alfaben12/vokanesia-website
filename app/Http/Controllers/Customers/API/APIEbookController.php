<?php

namespace App\Http\Controllers\Customers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PdfProduk;

class APIEbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($limit = 10, $offset = 0)
    {
        $data["sumary"] = PdfProduk::count();
        $book = array();
        foreach (PdfProduk::select('pdf_produks.*','users.name as publisher','categories.name as kategori')
                            ->take($limit)
                            ->skip($offset)
                            ->leftjoin('users', 'users.id', '=', 'pdf_produks.user_id')
                            ->leftjoin('categories', 'categories.id', '=', 'pdf_produks.kategori_id')
                            ->get() as $p) {
            $item = $p;
            

            array_push($book, $item);
        }

        return response()->json([
            'success' => true,
            'data' => $book,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data["sumary"] = PdfProduk::count();
        $book = array();
        $book = PdfProduk::select('pdf_produks.*','users.name as publisher','categories.name as kategori')
                            ->where('pdf_produks.id', $id)
                            ->leftjoin('users', 'users.id', '=', 'pdf_produks.user_id')
                            ->leftjoin('categories', 'categories.id', '=', 'pdf_produks.kategori_id')
                            ->first();
        return response()->json([
        'success' => true,
        'data' => $book,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function find(Request $request, $limit = 10, $offset = 0)
    {
        $find = $request->find;
        $book = PdfProduk::where("id","like","%$find%")
        ->orWhere("name","like","%$find%");
        $data["count"] = $book->count();
        $books = array();
        foreach ($book->skip($offset)->take($limit)->get() as $p) {
          $item = $p;
          array_push($books,$item);
        }
        return response()->json([
        'success' => true,
        'data' => $books,
        ], 200);
    }
}
