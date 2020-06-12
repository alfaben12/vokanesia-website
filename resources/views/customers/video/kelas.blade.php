@extends('layouts.base')

@section("body")
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
                        <img src="{{ Voyager::image($course->cover) }}" alt="">
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
                        <h4 class="small">{{ $course->name }}</h4>
                        <p>{{ $course->hasAsset()->count() }} Video Pembelajaran</p>
                        <hr>
                        <div style="max-height: 250px; overflow-x: auto">
                          @foreach ($course->hasAsset() as $video)
                            <a href="{{ route('customers.video.show', ['video' => $course->id, 'prod_id' => $video->id]) }}" style="color: unset">
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
                        @if($course->countQuiz->count() > 0)
                          <button class="btn btn-primary btn-block mt-3">{{ $course->soalJawaban->count() }} / {{ $course->countSoal->count() }} Quiz Progress</button>
                        @else
                          @if ($course->scoreCustomer()->get("pass"))
                            <a href="{{ route("customers.certificate.show", $course->id) }}" class="btn btn-primary btn-block mt-3">Sertifikat</a>
                          @else
                            <button class="btn btn-block btn-primary mt-3 py-3" style="line-height: unset; height: unset; background-color: red;">ANDA TIDAK LULUS DALAM KELAS INI</button>
                          @endif
                        @endif
                        <hr>
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
