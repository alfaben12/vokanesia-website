@extends('layouts.base')

@section('title', $data->name)

@section("style")
  <link href="https://vjs.zencdn.net/7.7.6/video-js.css" rel="stylesheet" />
  <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet" />
  <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <link rel="stylesheet" href="{{ asset("css/fontawesome-stars.css") }}">
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> --}}
  {{-- <link rel="stylesheet" href="{{ asset("upturn/css/quiz.css") }}"> --}}
  <style media="screen">
  /* #quiz {
  height: auto;
  display: block;
  } */
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
  @include('layouts.customer_header')
  <section class="xs-section-padding blog-single-post-section py-0">
    <div class="container mb-5">
      <div class="row">
        <div class="col-12 col-lg-8 mb-3 mb-lg-0">
          <div class="single-blog-post post-list format-gallery">
            <div class="post-body p-0">
              <div class="entry-header">
                <div class="entry-content my-0">
                  <div class="row my-auto">
                    <div class="col-12 mb-lg-0 mb-2">
                      <div class="single-case-studies text-center wow fadeInUp">
                        <video id="my-video" class="video-js vjs-theme-fantasy vjs-16-9" controls poster="{{ asset("storage/". str_replace("\\", "/", $data->courseDetails()->cover)) }}" data-setup="{}">
                          @if(isset($data->youtube_url))
                            <source src="{{$data->videoUrl()}}" type="video/youtube"/>
                          @else
                            <source src="{{ Voyager::image($data->videoUrl()) }}" type="video/mp4" />
                          @endif
                            <p class="vjs-no-js">
                              To view this video please enable JavaScript, and consider upgrading to a web browser that
                              <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                            </p>
                          </video>
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
                      <div class="col-12 mb-lg-5 mb-2">
                        <div class="single-case-studie wow fadeInUp">
                          <h4 class="small">{{$data->name}}</h4>
                          <h5>{{$data->userDetails()->name}}</h5>
                          <hr>
                          <a href="{{ Voyager::image($data->pdfUrl()) }}" class="btn btn-primary style2 btn-block px-0">
                            <i class="fa fa-file-text-o" aria-hidden="true"></i> Download Ringkasan
                          </a>
                          <hr>
                          <i>* Apabila video gagal diputar, harap muat ulang halaman</i>
                          <hr>
                          <div style="max-height: 250px; overflow-x: auto">
                            @foreach ($data->courseDetails()->hasAsset() as $video)
                              <a href="{{ route('customers.video.show', ['video' => $data->courseDetails()->id, 'prod_id' => $video->id]) }}" style="color: unset">
                                <div class="col-12">
                                  <div class="row">
                                    <div class="col-2">
                                      <i class="fa fa-play-circle-o fa-2x" style="min-height: 100%; display: flex; align-items: center;"></i>
                                    </div>
                                    <div class="col">
                                      <div class="col-12">
                                        {{ $video->name }}
                                      </div>
                                      <div class="col-12">
                                        xx Menit
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </a>
                              <hr>
                            @endforeach
                          </div>
                          <a href="{{ route('customers.video.kelas', ['video' => $data->course_id]) }}" class="btn btn-primary style2 btn-block" id="xs-register-submit">KEMBALI</a>
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

    @if ($data->quiz->count())
      <section class="xs-section-padding blog-single-post-section mt-5 py-0" id="section_quiz">
        <div class="container my-5">
          <div class="row">
            <div class="col-12 mb-3 mb-lg-0">
              <div class="single-blog-post post-list format-gallery">
                <div class="post-body p-0">
                  <div class="entry-header">
                    <div class="entry-content my-0">
                      <div class="row my-auto">
                        <div class="col-12 mb-lg-0 mb-2">
                          <div id="quiz-container" class="wow fadeInUp">
                            <div id="quiz_page" style="padding:40px">
                              <h3 class="text-center mb-5" style="color: #181818;">QUIZ: {{ strtoupper($data->name) }}</h3>
                              @php($i = 1)
                              @foreach($data->quiz as $row)
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
          </div>
        </div>
      </section>
    @endif
    <div class="modal fade" id="alertMessage" tabindex="-1" role="dialog" aria-labelledby="alertMessageLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title mx-auto" id="alertMessageLabel">Quiz Complete</h4>
          </div>
          <div class="modal-body text-center">
            <b><p id="message"></p></b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary mx-auto" id="modalDismiss" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  @endsection

  @section("plugin")
    <script src="https://vjs.zencdn.net/7.7.6/video.js"></script>
    <script src="{{ asset("js/jquery.barrating.min.js") }}"></script>
    <script src="{{ asset("js/youtube.js") }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> --}}
    {{-- <script src="{{ asset("upturn/js/quiz.js") }}" charset="utf-8"></script> --}}
  @endsection

  @section('script')
    <script>
    $('input:radio[name="jawaban"]').change(function(){
      if ($(this).is(':checked')) {
        var id = this.id.split("_")[2]; // ID Soal
        var val = this.value // val
        // var course = $(this).filter(':checked').attr("data-course");
        // alert(course)
        var sisa_soal = $("#quiz_page > div").length;
        $.ajax({
          type: "POST",
          url: "{{ url("customers/quiz/pilihjawaban") }}",
          data: {
            _token: "{{ csrf_token() }}",
            choice: val,
            id_soal: id,
            id_video: {{ $data->id }}
          },
          dataType: 'JSON',
          success: function (data) {
            if (sisa_soal > 1) {
              $('html, body').animate({
                scrollTop: $("#section_quiz").offset().top
              }, 1000);
            }
            $("#div_soal_" + id).fadeOut('5000', function(){ $(this).remove();});
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alert("Terjadi kesalahan di sistem");
          }
        })
        if (sisa_soal == 1) {
          setTimeout(function() {
            $("#section_quiz").fadeOut('5000', function(){ $(this).remove();});
            $('html, body').animate({scrollTop: '0px'}, 450);
            $('#alertMessage').modal('show');
            $("#message").html("All question already anwered");
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
