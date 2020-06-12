
@extends('layouts.base')

@section("title", $produk->nama)

@section('body')
  <section class="xs-section-padding py-0 my-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="product-slider owl-carousel">
            <div class="single-product-slider">
              <div class="product-header">
                <img src="{{ Voyager::image($produk->cover)}}" class="mx-auto" alt="">
              </div>
            </div><!-- .single-product-slider END -->
          </div><!-- .product-slider END -->
        </div>
        <div class="col-lg-6">
          <div class="product-summary">
            <h2 class="product_title">{{ $type == "video" ? $produk->name : $produk->judul_course }}</h2>
            <div class="product-meta-group">
              <div class="product_meta">
                <strong>{{ $type == 'video' ? 'Mentor' : 'Penjual' }} :</strong>
                <b>{{ $type == "video" ? $produk->userDetails()->name : $produk->userDetails()->name }}</b>
              </div>
            </div>
            <div class="woocommerce-product-details__short-description">
              <p>{!! $produk->deskripsi !!}</p>
            </div>
            @if($type == 'video')
              @if (!in_array($produk->id, Auth::user()->libraryVideo->pluck("produk_id")->toArray()))
                <span class="price">
                  <ins>
                    <span class="woocommerce-Price-amount amount">
                      <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
                    </span>
                  </ins>
                </span>
              @endif
            @else
              @if (!in_array($produk->id, Auth::user()->libraryPdf->pluck("produk_id")->toArray()))
                <span class="price">
                  <ins>
                    <span class="woocommerce-Price-amount amount">
                      <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
                    </span>
                  </ins>
                </span>
              @endif
            @endif
            <div class="row">
              <div class="col-12 col-lg-6 px-0">
                @if($type == 'video')
                  @if (!in_array($produk->id, Auth::user()->libraryVideo->pluck("produk_id")->toArray()))
                    @if (in_array($produk->id, Auth::user()->cart->pluck("produk_id")->toArray()))
                      <button disabled type="submit" id="to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Already In Cart </button>
                    @else
                      <button type="submit" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Add to Cart</button>
                    @endif
                  @else
                    <a href="{{ route('customers.video.kelas', ['video' => $produk->id]) }}" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Lihat Kelas</a>
                  @endif
                @else
                  @if (!in_array($produk->id, Auth::user()->libraryPdf->pluck("produk_id")->toArray()))
                    @if (in_array($produk->id, Auth::user()->cart->pluck("produk_id")->toArray()))
                      <button disabled type="submit" id="to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Already In Cart </button>
                    @else
                      <button type="submit" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Add to Cart</button>
                    @endif
                  @else
                    <a href="#" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Lihat Ebook</a>
                  @endif
                @endif
              </div>
              @if ($produk->getTable() == "course_produks")
                <div class="col-12 my-5">
                  <h5><b>Kelas ini meliputi:</b></h5>
                  <div class="row">
                    <div class="col-1 px-0 text-right">
                      <i class="fa fa-play-circle-o"></i>
                    </div>
                    <div class="col-10">
                      {{ $produk->hasAsset()->count() }} Video Pembelajaran
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-1 px-0 text-right">
                      <i class="fa fa-file-pdf-o"></i>
                    </div>
                    <div class="col-10">
                      {{ $produk->hasAsset()->count() }} Ebook Pembelajaran
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-1 px-0 text-right">
                      <i class="fa fa-trophy"></i>
                    </div>
                    <div class="col-10">
                      Sertifikat Kelulusan
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="product-slider owl-carousel">
            <div class="single-product-slider">
              <div class="product-summary">
                @if ($produk->getTable() == "course_produks")
                  <div class="container">
                    @php($i = 0)
                    @foreach($produk->hasAsset() as $row)
                      <div class="col-lg-12 border border-primary rounded my-3 py-3">
                        <div class="row">
                          <div class="col-6 my-auto text-center">
                               <span style="font-size: x-large;">{{ ++$i }}. {{$row->name}}</span>
                          </div>
                          <div class="col-6 px-0 my-auto text-right">
                            <div class="row">
                              <div class="col-4">
                                @if (isset($row->youtube_url) || in_array($produk->id, Auth::user()->libraryVideo->pluck("produk_id")->toArray()))
                                  <a href="{{ route('customers.video.show', ['video' => $produk->id, 'prod_id' => $row->id]) }}">
                                    <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                                  </a>
                                @else
                                  <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                                @endif
                              </div>
                              <div class="col-4">
                                @if (isset($row->youtube_url) || in_array($produk->id, Auth::user()->libraryVideo->pluck("produk_id")->toArray()))
                                  <a href="{{ Voyager::image($row->pdfUrl()) }}">
                                    <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                                  </a>
                                @else
                                  <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            </div><!-- .single-product-slider END -->
          </div><!-- .product-slider END -->
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
  $('#add_to_cart').on('click', function(e){
    $("#add_to_cart").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>LOADING...');
    $.ajax({
      type : "POST",
      url : '/customers/cart',
      headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data : {
        'produk_id' : '{{$produk->id}}' ,
        'produk_type' : '{{$type}}'
      },
      success : function success(result) {
        location.replace('/customers/dashboard');
        $("#add_to_cart").prop("disabled", true).html('Produk Sudah Dikeranjang');
      },
      error : function error(error)
      {
        $("#add_to_cart").prop("disabled", false).html('<i class="icon icon-shopping-cart2"></i> Add to Cart');
      }
    })
  })
  </script>
@endsection
