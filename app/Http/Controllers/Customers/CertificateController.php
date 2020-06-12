<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\VideoSoal;
use App\Models\VideoProduk;
use App\Models\CourseProduk;
use App\Models\SoalJawabanCustomer;
use Auth;
class CertificateController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
    $courses = CourseProduk::all();
    return view("customers.certificate.index")->with([
      "courses" => $courses
    ]);
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
    if($course->countQuiz->count() > 0) {
      return redirect()->route('customers.video.kelas', ['video' => $id]);
    }
    if($course->scoreCustomer()->get("pass")) {
      $data = collect([
        "user" => Auth::guard("web_customers")->user(),
        "score" => $course->scoreCustomer()->get("score")
      ]);
      $pdf = \PDF::loadView('customers.certificate.pdf', compact("data", $data))->setPaper('a4', 'landscape');
      return $pdf->stream();
    }
    else {
      return redirect()->back();
    }
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
}
