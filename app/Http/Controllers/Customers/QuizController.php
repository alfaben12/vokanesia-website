<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VideoSoal;
use App\Models\CourseProduk;
use App\Models\SoalJawabanCustomer;
use Auth;

class QuizController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    return view("customers.quiz");
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
    $course = CourseProduk::find($id);
    $soal = VideoSoal::whereNotIn("id", $course->soaljawaban->pluck("soal_id")->toArray())->get();
    return view('customers.quiz')->with([
      'course' => $course,
      'soal' => $soal
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

  public function pilihjawaban(Request $request)
  {
    $soaljawaban = SoalJawabanCustomer::firstOrCreate(
      [
        'customer_id' => Auth::guard("web_customers")->id(),
        'video_produk_id' => $request->id_video,
        'soal_id' => $request->id_soal
      ],
      [
        'jawaban' => $request->choice
      ]);
      return response()->json("success");
    }
  }
