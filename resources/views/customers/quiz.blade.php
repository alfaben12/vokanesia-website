@extends('layouts.base')

@section('title', 'Quiz')

@section('style')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset("upturn/css/quiz.css") }}">
  <style>
  #quiz {
    height: auto;
    display: block;
  }
  .funkyradio div {
    clear: both;
    overflow: hidden;
  }

  .funkyradio label {
    width: 100%;
    border-radius: 3px;
    border: 1px solid #D1D3D4;
    font-weight: normal;
  }

  .funkyradio input[type="radio"]:empty,
  .funkyradio input[type="checkbox"]:empty {
    display: none;
  }

  .funkyradio input[type="radio"]:empty ~ label,
  .funkyradio input[type="checkbox"]:empty ~ label {
    position: relative;
    line-height: 2.5em;
    padding-left: 3.25em;
    margin-top: 2em;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .funkyradio input[type="radio"]:empty ~ label:before,
  .funkyradio input[type="checkbox"]:empty ~ label:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    content: '';
    width: 2.5em;
    background: #D1D3D4;
    border-radius: 3px 0 0 3px;
  }

  .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
  .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
    color: #888;
  }

  .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
  .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
    content: '\2714';
    text-indent: .9em;
    color: #C2C2C2;
  }

  .funkyradio input[type="radio"]:checked ~ label,
  .funkyradio input[type="checkbox"]:checked ~ label {
    color: #777;
  }

  .funkyradio input[type="radio"]:checked ~ label:before,
  .funkyradio input[type="checkbox"]:checked ~ label:before {
    content: '\2714';
    text-indent: .9em;
    color: #333;
    background-color: #ccc;
  }

  .funkyradio input[type="radio"]:focus ~ label:before,
  .funkyradio input[type="checkbox"]:focus ~ label:before {
    box-shadow: 0 0 0 3px #999;
  }

  .funkyradio-default input[type="radio"]:checked ~ label:before,
  .funkyradio-default input[type="checkbox"]:checked ~ label:before {
    color: #333;
    background-color: #ccc;
  }

  .funkyradio-primary input[type="radio"]:checked ~ label:before,
  .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #337ab7;
  }

  .funkyradio-success input[type="radio"]:checked ~ label:before,
  .funkyradio-success input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #5cb85c;
  }

  .funkyradio-danger input[type="radio"]:checked ~ label:before,
  .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #d9534f;
  }

  .funkyradio-warning input[type="radio"]:checked ~ label:before,
  .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #f0ad4e;
  }

  .funkyradio-info input[type="radio"]:checked ~ label:before,
  .funkyradio-info input[type="checkbox"]:checked ~ label:before {
    color: #fff;
    background-color: #5bc0de;
  }
  </style>
@endsection

@section('body')
  <section class="xs-section-padding blog-single-post-section mt-5 py-0">
    <div class="container my-5">
      <div class="row">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
          <div class="single-blog-post post-list format-gallery">
            <div class="post-body p-0">
              <div class="entry-header">
                <div class="entry-content my-0">
                  <div class="row my-auto">
                    <div class="col-12 mb-lg-0 mb-2">
                      <div id="quiz-container" class="wow fadeInUp">
                        <div id="start_pages" style="padding:40px" hidden>
                          <h4 class="small">Quiz</h4>
                          <h3 >{{$course->name}}</h3>
                          <div><h4>Waktu : {{$course->time_quiz}} Menit</h4></div>
                          <button class="btn btn-primary style2" style="width: 200px">Mulai</button>
                        </div>
                        <div id="quiz_page" style="padding:40px">
                          @php($i = 1)
                          @foreach($soal as $row)
                            <div id="div_soal_{{ $row->id }}">
                              <div class="col-12">
                                <h4>{{ $i++ }}. {{$row->soal}}</h4>
                              </div>
                              <div class="col-12 mb-5">
                                <div class="funkyradio">
                                  <div class="funkyradio-success">
                                    <input type="radio" name="jawaban" id="course_a_{{ $row->id }}" value="opsi_a"/>
                                    <label for="course_a_{{ $row->id }}">{{$row->opsi_a}}</label>
                                  </div>
                                  <div class="funkyradio-success">
                                    <input type="radio" name="jawaban" id="course_b_{{ $row->id }}" value="opsi_b"/>
                                    <label for="course_b_{{ $row->id }}">{{$row->opsi_b}}</label>
                                  </div>
                                  <div class="funkyradio-success">
                                    <input type="radio" name="jawaban" id="course_c_{{ $row->id }}" value="opsi_c"/>
                                    <label for="course_c_{{ $row->id }}">{{$row->opsi_c}}</label>
                                  </div>
                                  <div class="funkyradio-success">
                                    <input type="radio" name="jawaban" id="course_d_{{ $row->id }}" value="opsi_d"/>
                                    <label for="course_d_{{ $row->id }}">{{$row->opsi_d}}</label>
                                  </div>
                                  <div class="funkyradio-success">
                                    <input type="radio" name="jawaban" id="course_e_{{ $row->id }}" value="opsi_e"/>
                                    <label for="course_e_{{ $row->id }}">{{$row->opsi_e}}</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="single-blog-post post-list format-gallery">
            <div class="post-body py-3">
              <div class="entry-header">
                <div class="entry-content my-3">
                  <div class="row my-auto">
                    <div class="col-12">
                      <div class="single-case-studie wow fadeInUp">
                        <h4 class="small">Examination</h4>
                        <h5 class="mb-0">{{$course->name}}</h5>
                        <span>{{$course->user()->name}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
  $('input:radio[name="jawaban"]').change(function(){
    if ($(this).is(':checked')) {
      var id = this.id.split("_")[2]; // ID Soal
      var val = this.value // val
      // var course = $(this).filter(':checked').attr("data-course");
      // alert(course)
      $.ajax({
        type: "POST",
        url: "{{ url("customers/quiz/pilihjawaban") }}",
        data: {
          _token: "{{ csrf_token() }}",
          choice: val,
          id_soal: id,
          id_course: {{ $course->id }}
        },
        dataType: 'JSON',
        success: function (data) {
          $("#div_soal_" + id).fadeOut('3000', function(){ $(this).remove();});
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert("Terjadi kesalahan di sistem");
        }
      })
      var sisa_soal = $("#quiz_page > div").length;
      if (sisa_soal == 1) {
        setTimeout(function() {
          alert("habis")
        }, 500);
      }
    }
  });
  $(document).on('click', '#quiz_start', function(){
    $.ajax({
      type : 'POST',
      url : 'customers/quiz/'
    })
  })
  </script>
@endsection
