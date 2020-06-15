<?php

namespace App\Http\Controllers\Customers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoProduk;

class APIVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($limit = 10, $offset = 0)
    {
        $data["sumary"] = VideoProduk::count();
        $video = array();
        foreach (VideoProduk::select('video_produks.*','users.name as publisher', 'course_produks.name as course_name')
                            ->take($limit)
                            ->skip($offset)
                            ->leftjoin('users', 'users.id', '=', 'video_produks.user_id')
                            ->leftjoin('course_produks', 'course_produks.id', '=', 'video_produks.course_id')
                            ->get() as $p) {
                                $item = $p;
                                
                    
                                array_push($video, $item);
                            }
        return response()->json([
        'success' => true,
        'data' => $video,
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
        $data["sumary"] = VideoProduk::count();
        $video = array();
        $video = VideoProduk::select('video_produks.*','users.name as publisher', 'course_produks.name as course_name')
                            ->where('video_produks.id', $id)
                            ->leftjoin('users', 'users.id', '=', 'video_produks.user_id')
                            ->leftjoin('course_produks', 'course_produks.id', '=', 'video_produks.course_id')
                            ->first();
        return response()->json([
            'success' => true,
            'data' => $video,
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
        $video = VideoProduk::where("id","like","%$find%")
        ->orWhere("name","like","%$find%");
        $data["count"] = $video->count();
        $videos = array();
        foreach ($video->skip($offset)->take($limit)->get() as $p) {
          $item = $p;
          array_push($videos,$item);
        }
        return response()->json([
            'success' => true,
            'data' => $videos,
            ], 200);
    }
}

