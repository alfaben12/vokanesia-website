@extends('layouts.base')

@section("title", $produk->name)

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
          <h2 class="product_title">{{ $produk->name }}</h2>
          <div class="product-meta-group">
            <div class="product_meta">
              <strong>{{ $type == 'video' ? 'Mentor' : 'Penjual' }} :</strong>
              {{ $type == "video" ? $produk->userDetails()->name : $produk->userDetails()->name }}
            </div>
          </div>
          <div class="woocommerce-product-details__short-description">
            <p>{!! $produk->deskripsi !!}</p>
          </div>
          @auth('web_customers')
          @if($type == 'video')
          @if (!in_array($produk->id, Auth::guard('web_customers')->user()->libraryVideo->pluck("produk_id")->toArray()))
          <span class="price">
            <ins>
              <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
              </span>
            </ins>
          </span>
          @endif
          @else
          @if (!in_array($produk->id, Auth::guard('web_customers')->user()->libraryPdf->pluck("produk_id")->toArray()))
          <span class="price">
            <ins>
              <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
              </span>
            </ins>
          </span>
          @endif
          @endif
          @endauth
          @guest('web_customers')
          <span class="price">
            <ins>
              <span class="woocommerce-Price-amount amount">
                <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
              </span>
            </ins>
          </span>
          @endguest
          <div class="row">
            <div class="col-12 col-lg-6 px-0">
              @auth('web_customers')
              @if($type == 'video')
              @if (!in_array($produk->id, Auth::guard('web_customers')->user()->libraryVideo->pluck("produk_id")->toArray()))
              @if (in_array($produk->id, Auth::guard('web_customers')->user()->cart->pluck("produk_id")->toArray()))
              <button disabled type="submit" id="to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Already In Cart </button>
              @else
              @if (Auth::guard("web_customers")->user()->verivied == "yes")
              <button type="submit" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Add to Cart</button>
              @else
              <a href="{{ route("customers.otp") }}" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Verify Phone Number</a>
              @endif
              @endif
              @else
              <a href="{{ route('customers.video.kelas', ['video' => $produk->id]) }}" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Lihat Kelas</a>
              @endif
              @else
              @if (!in_array($produk->id, Auth::guard('web_customers')->user()->libraryPdf->pluck("produk_id")->toArray()))
              @if (in_array($produk->id, Auth::guard('web_customers')->user()->cart->pluck("produk_id")->toArray()))
              <button disabled type="submit" id="to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Already In Cart </button>
              @else
              @if (Auth::guard("web_customers")->user()->verivied == "yes")
              <button type="submit" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Add to Cart</button>
              @else
              <a href="{{ route("customers.otp") }}" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Verify Phone Number</a>
              @endif
              @endif
              @else
              <a href="{{route('customers.pdf.read', ['pdf' => $produk->id])}}" id="add_to_cart" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2">Lihat Ebook</a>
              @endif
              @endif
              @endauth
              @guest('web_customers')
              <button type="button" data-target="#loginMessage" data-toggle="modal" class="btn btn-primary btn-block icon-left ml-0 ml-lg-2"><i class="icon icon-shopping-cart2"></i> Add to Cart</button>
              @endguest
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
                    @auth('web_customers')
                    <div class="row">
                      <div class="col-4">
                        @if (isset($row->youtube_url) || in_array($produk->id, Auth::guard('web_customers')->user()->libraryVideo->pluck("produk_id")->toArray()))
                        <a href="{{ route('customers.video.show', ['video' => $produk->id, 'prod_id' => $row->id]) }}">
                          <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                        </a>
                        @else
                        <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                        @endif
                      </div>
                      <div class="col-4">
                        @if (isset($row->youtube_url) || in_array($produk->id, Auth::guard('web_customers')->user()->libraryVideo->pluck("produk_id")->toArray()))
                        <a href="{{ Voyager::image($row->pdfUrl()) }}">
                          <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                        </a>
                        @else
                        <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endauth
                  @guest('web_customers')
                  <div class="row">
                    <div class="col-4">
                      @if (isset($row->youtube_url))
                      <a href="{{ route('customers.video.show', ['video' => $produk->id, 'prod_id' => $row->id]) }}">
                        <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                      </a>
                      @else
                      <i class="fa fa-2x fa-play-circle-o" title="Video"></i>
                      @endif
                    </div>
                    <div class="col-4">
                      @if (isset($row->youtube_url))
                      <a href="{{ Voyager::image($row->pdfUrl()) }}">
                        <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                      </a>
                      @else
                      <i class="fa fa-2x fa-file-pdf-o" title="Ringkasan"></i>
                      @endif
                    </div>
                  </div>
                </div>
                @endguest
              </div>
            </div>
            @endforeach
          </div>
          @endif
        </div><!-- .single-product-slider END -->
      </div><!-- .product-slider END -->
    </div>
  </div>
  </div>
</section>
<div class="modal fade" id="loginMessage" tabindex="-1" role="dialog" aria-labelledby="loginMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{ url('auth/login/do') }}" class="xs-from has-error" method="post" id="xs-login-form">
        <!-- kalau error ditambah has-error -->
        <div class="modal-header">
          <h4 class="mx-auto" id="loginMessageLabel">Please Login First to Buy This Product</h4>
        </div>
        <div class="modal-body text-center">
          <div class="form-group">
            <input type="email" name="email" id="xs-login-email" placeholder="Email" class="form-control"> <!-- kalau error ditambah is-invalid -->
          </div>
          <div class="form-group">
            <input type="password" secret name="password" id="xs-login-password" placeholder="Passwords" class="form-control">
          </div>
        </div>
        <input type="hidden" id="url" name="url" value="{{ url()->current() }}">
        <div class="d-flex justify-content-between modal-footer">
          <button type="submit" name="submit" class="btn btn-primary style2" id="xs-login-submit">Login</button>
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="alertMessage" tabindex="-1" role="dialog" aria-labelledby="alertMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mx-auto" id="alertMessageLabel">Login Failed</h4>
      </div>
      <div class="modal-body text-center">
        <b>
          <p id="message"></p>
        </b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mx-auto" id="modalDismiss" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('#add_to_cart').on('click', function(e) {
    $("#add_to_cart").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>LOADING...');
    $.ajax({
      type: "POST",
      url: '/customers/cart',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        'produk_id': '{{$produk->id}}',
        'produk_type': '{{$type}}'
      },
      success: function success(result) {
        location.replace('/customers/dashboard');
        $("#add_to_cart").prop("disabled", true).html('Produk Sudah Dikeranjang');
      },
      error: function error(error) {
        $("#add_to_cart").prop("disabled", false).html('<i class="icon icon-shopping-cart2"></i> Add to Cart');
      }
    })
  })
</script>
@endsection