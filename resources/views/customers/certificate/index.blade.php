@extends('layouts.base')

@section('title', 'Sertifikat')

@section('style')
  <style media="screen">
  .list-group-2 {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
  }
  .widget .list-group-2 li:not(:last-child){
    margin-bottom: 15px;
  }
  .list-group-2>li:not(:last-child) {
    margin-bottom: 10px;
  }
  .widget .list-group-2 li {
    font-size: 0.9333333333rem;
  }
  .list-group-2>li {
    font-size: 1.0666666667rem;
    color: #999999;
  }
  .widget .list-group-2 li a {
    -webkit-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
  }
  .widget .list-group-2 li a, .widget .list-group-2 li span {
    color: #919191;
    padding: 1.2rem 2.1rem;
  }
  .widget .list-group-2 .menu-active a {
    color: #0c5adb;
    font-weight: bolder;
  }
  .menu-before {
    -webkit-box-align: stretch;
    align-items: stretch;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    -webkit-box-flex: 0;
    flex-grow: 0;
    flex-shrink: 0;
    min-height: 0pt;
    min-width: 0pt;
    user-select: none;
    position: absolute;
    height: 100%;
    width: 0.4rem;
    top: 0px;
    left: 0px;
    border-top-left-radius: 0.2rem;
    border-bottom-left-radius: 0.2rem;
    background-color: rgb(19, 95, 220);
    border-width: 0pt;
    border-style: solid;
    margin: 0pt;
    padding: 0pt;
  }
  .menu-active {
    -webkit-box-align: stretch;
    align-items: stretch;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    -webkit-box-flex: 0;
    flex-grow: 0;
    flex-shrink: 0;
    position: relative;
    min-height: 0pt;
    min-width: 0pt;
    user-select: none;
    margin: 0pt;
    font-weight: bolder;
  }
  </style>
@endsection

@section('body')
  @include('layouts.customer_header')
  <section class="xs-section-padding blog-single-post-section pt-0">
    <div class="container">
      <div class="row">
        <div class="col-12 d-md-none d-sm-block mb-3">
          <select class="form-control" onchange="location = this.value;">
            <option value="customer-sertifikat.html">Semua</option>
            <option value="customer-sertifikat.html">Selesai Seluruh Materi</option>
            <option value="customer-sertifikat.html">Lulus Exam</option>
          </select>
        </div>
        <div class="col-lg-4 d-md-block d-none">
          <div class="widget widget-categories">
            <ul class="list-group-2">
              <li class="menu-active">
                <div class="menu-before"></div>
                <a href="#">Semua</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-8 col-12">
          <div class="single-blog-post post-list format-gallery">
            <div class="post-body py-3">
              <div class="entry-header">
                <div class="entry-content my-3">
                  <div class="row my-auto">
                    @php($count = 0)
                    @foreach ($courses as $course)
                      @if ($course->scoreCustomer()->get("pass") == true)
                        <div class="col-12 col-lg-6">
                          <div class="single-case-studies text-center wow fadeInUp">
                            <div class="image">
                              <img src="{{ asset("storage/". $course->cover) }}" alt="">
                            </div>
                            <div class="case-body py-0">
                              <div class="row">
                                <div class="col-12 text-center">
                                  <span>Sertifikat Lulus Exam</span>
                                  <h4 class="small mb-0"><a href="{{ route("customers.certificate.show", $course->id) }}">{{ $course->name }}</a></h4>
                                  <p style="font-weight: bolder">Tanggal Diperoleh: {{ Carbon\Carbon::parse($course->soalJawaban->last()->created_at)->format("d-m-Y h:i:s") }}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @php($count++)
                      @endif
                    @endforeach
                    @if ($count == 0)
                      <h4 class="mx-auto my-5 text-center" style="color: #181818;">Anda Belum Memiliki Sertifikat</h4>
                    @endif
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
