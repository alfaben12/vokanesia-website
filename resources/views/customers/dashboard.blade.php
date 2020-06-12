@extends('layouts.base')

@section('title', "Dashboard")

@section('body')
  @include('layouts.customer_header')
  <section class="xs-section-padding pt-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="about-info">
            <div class="col-12 px-0">
              <h2 class="content-title mb-2">Pilih Kelasmu</h2>
              <h5>Dengan memilih pilihan kelas yang dibawakan oleh mentor ternama Indonesia.</h5>
            </div>
            <div class="col-12 mt-4 px-0">
              <div class="row">
                <div class="col-12">
                  <h2 class="content-title">Video Tersedia</h2>
                </div>
                @foreach ($courseproduk as $row)
                  <div class="col-lg-6 col-12">
                    <div class="single-case-studies text-center wow fadeInUp">
                      <div class="image">
                        <img src="{{Voyager::image($row->cover)}}" alt="">
                      </div>
                      <div class="case-body">
                        <div class="row">
                          <div class="col-lg-7 col-12 text-lg-left text-center">
                            <h4 class="small">{{ ucwords($row->name) }}</h4>
                            <span>{{ ucwords($row->userDetails()->name) }}</span>
                            <!-- {{-- <p style="font-weight: bolder">24 Chapters</p> --}} -->
                          </div>
                          <div class="col-12 col-lg-5 my-lg-auto mt-3 text-lg-right">
                            <a href="{{ route('shop.show', ['type' => 'video', 'kategori' => $row->kategoriDetails()->slug, 'title' => $row->slug]) }}" class="btn btn-primary btn-sm btn-block px-4">BELI SEKARANG</a>
                          </div>
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
  </section>
  <section class="xs-section-padding pt-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="about-info">
            <div class="col-12 px-0">
              <h2 class="content-title mb-2">Pilih E-Book</h2>
              <h5>Dengan memilih pilihan e-book yang ditulis oleh mentor ternama Indonesia.</h5>
            </div>
            <div class="col-12 mt-4 px-0">
              <div class="row">
                <div class="col-12">
                  <h2 class="content-title">E-Book Tersedia</h2>
                </div>
                @foreach ($ebookproduk as $row)
                  <div class="col-lg-4 col-6">
                    <a href="{{ route('shop.show', ['type' => 'pdf', 'kategori' => $row->kategoriDetails()->slug, 'title' => $row->slug])}}" style="color: unset;">
                      <div class="single-case-studies text-center wow fadeInUp">
                        <div class="image">
                          <img src="{{ Voyager::image($row->cover) }}" class="img-thumbnail" alt="">
                        </div>
                        <div class="case-body">
                          <div class="row">
                            <div class="col	-12 text-lg-left text-center">
                              <h4 class="small">{{ ucwords($row->name) }}</h4>
                              <span>Penulis: {{ ucwords($row->userDetails()->name) }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
