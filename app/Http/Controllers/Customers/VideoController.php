<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client;

use App\Models\VideoSoal;
use App\Models\VideoProduk as Video;
use App\Models\CourseProduk;

class VideoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
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
  public function show($video, $prod_id)
  {
    //
    $data = Video::find($prod_id);
    $urlVideo = $data->videoUrl();
    return view('customers.video.index')->with([
      'data' => $data,
    ]);
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
  /**
   * Course check berapa video asset
   * Di hitung score dari masing2 asset
   * Count score = video asset -> baru dapat sertifikate
   * Score di rumus
   * todo: buat table score: isinya => id_video_asset, score
   * Course -> video_asset -> score -> count()
   */
  public function kelas($video) {
    $course = CourseProduk::find($video);
    return view("customers.video.kelas")->with([
      'course' => $course
    ]);
  }

  public function soal(Request $request) {
    $i = 1;
    $soals = VideoSoal::where("video_id", $request->id)->get();
    foreach ($soals as $quiz) {
      switch ($quiz->jawaban) {
        case 'opsi_a':
        $key = 0;
        break;

        case 'opsi_b':
        $key = 1;
        break;

        case 'opsi_c':
        $key = 2;
        break;

        case 'opsi_d':
        $key = 3;
        break;

        case 'opsi_e':
        $key = 4;
        break;
      }
      $q[] = array(
        'correct' => array("index" => $key),
        'answers' => (object) [
          $quiz->opsi_a,
          $quiz->opsi_b,
          $quiz->opsi_c,
          $quiz->opsi_d,
          $quiz->opsi_e,
          ],
          "number" => $i++,
          "prompt" => $quiz->soal
        );
      }
      return response()->json([
        "questions" => $q,
        "title" => "Quiz Section"
      ],200);
  }
}
