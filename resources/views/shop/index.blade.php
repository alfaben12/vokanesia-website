@extends('layouts.base')

@section('style')

@endsection
@section('title', 'Toko Ebook')
@section('body')
  @if (($message = Session::get('success')) || ($message = Session::get('error')))
    <section class="xs-section-padding py-0 mb-5">
      <div class="container">
        <div class="alert alert-{{ Session::get('success') ? 'success' : 'danger'}} text-center alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <b>{!! $message !!}</b>
        </div>
      </div>
    </section>
  @endif

  @if (isset($search))
    <section class="xs-section-padding py-0 mb-5">
      <div class="container">
        <div class="alert alert-success text-center">
          Hasil Pencarian: <b>{!! $search !!}</b>
        </div>
      </div>
    </section>
  @endif

  <!-- shop strart -->
  <section class="xs-section-padding py-0 my-5">
    <div class="container">
      <div class="product-filter-area">
        <div class="row">
          <div class="col-12">
            <div class="col-md-12 col-lg-3 float-lg-right py-0">
              <form action="{{ route('shop.search', ['type' => $type]) }}" class="xs-serach style2" method="get">
                <div class="input-group">
                  <input type="search" name="q" placeholder="Search Here...">
                  <button type="submit" class="search-btn"><i class="icon icon-search"></i></button>
                </div>
              </form><!-- .xs-serach END -->
            </div>
          </div>
        </div><!-- .row END -->
      </div><!-- .product-filter-area END -->
      <div class="tab-content">
        <div class="tab-pane fade show active" id="product-cate1" role="tabpanel" aria-labelledby="product-cate1-tab">
          <div class="row">
            @if ($produk_list->count())
              @foreach ($produk_list as $produk)
                <div class="col-lg-4 col-md-6">
                  <div class="xs-single-product text-center">
                    <div class="d-none d-lg-inline-flex product-header" style="height: 250px;
                    width: 250px;
                    display: flex;
                    align-items: center;
                    flex-wrap: wrap;">
                    <img src="{{ Voyager::image($produk->cover) }}" style="height: 250px;
                    width: 250px;
                    object-fit: cover;" alt="">
                    @auth('web_customers')
                      <div class="hover-area">
                        <div class="btn-wraper">
                          @if (in_array($produk->id, Auth::guard('web_customers')->user()->cart->pluck("produk_id")->toArray()))
                            <a href="#" class="btn btn-primary icon-left style3">Already in cart</a>
                          @else
                            @if (Auth::guard("web_customers")->user()->verivied == "yes")
                              <a href="#" id="{{$type}}-{{ $produk->id }}" class="{{$type}}-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Add to Cart</a>
                            @else
                              <a href="{{ route("customers.otp") }}" class="btn btn-primary icon-left style3">Verify Phone Number</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    @endauth
                  </div>
                  <div class="d-lg-none product-header">
                    <img src="{{ Voyager::image($produk->cover) }}" alt="">
                    @auth('web_customers')
                      <div class="hover-area">
                        <div class="btn-wraper">
                          @if (in_array($produk->id, Auth::guard('web_customers')->user()->cart->pluck("produk_id")->toArray()))
                            <a href="#" class="btn btn-primary icon-left style3">Already in cart</a>
                          @else
                            @if (Auth::guard("web_customers")->user()->verivied == "yes")
                              <a href="#" id="{{$type}}mobile-{{ $produk->id }}" class="{{$type}}-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Add to Cart</a>
                            @else
                              <a href="{{ route("customers.otp") }}" class="btn btn-primary icon-left style3">Verify Phone Number</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    @endauth
                  </div>
                  <div class="product-footer">
                    <h2 class="product-title"><a href="{{ route('shop.show', ['type' => $type, 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}">{{ $produk->name }}</a></h2>
                    <span class="price">
                      <ins>
                        <span class="woocommerce-Price-amount amount">
                          <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
                        </span>
                      </ins>
                    </span>
                  </div>
                </div><!-- .xs-single-product END -->
              </div>
            @endforeach
          @else
            <div class="container text-center mb-5">
              <div class="alert alert-danger">
                <b>Hasil pencarian tidak menemukan hasil</b>
              </div>
              <a href="{{ route("shop.index", ['type' => $type]) }}" class="btn btn-primary btn-sm">KEMBALI</a>
            </div>
          @endif
        </div>
        <ul class="pagination justify-content-center">
          @php
          $jumlah_page = ceil($produk_list_2->count() / 9);
          $jumlah_number = 3;
          $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
          $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
          @endphp
          @if ($page > 1)
            <li>
              <a class="page-link" href="{{ route("shop.index",['type' => $type, 'page' => $page-1]) }}">&laquo;</i></a>
            </li>
          @endif
          @for ($i = $start_number; $i <= $end_number; $i++)
            <li class="page-item {{ $i == $page ? "active" : "" }}"><a class="page-link" href="{{ route("shop.index", ['type' => $type, 'page' => $i]) }}">{{ $i }}</a></li>
          @endfor
          @if ($page < $jumlah_page)
            <li>
              <a class="page-link" href="{{ route("shop.index", ['type' => $type, 'page' => $page+1]) }}">&raquo;</a>
            </li>
          @endif
        </ul>
      </div><!-- #product-cate1 END -->
    </div>
  </div><!-- .container END -->
</section><!-- end shop -->
@endsection

@section('script')
  <script type="text/javascript">
  $(document).ready(function() {
    $("[class^=pdf]").each(function(i) {
      $(this).on("click", function(){
        var id = this.id.split("-")[1];
        var cartbutton = $("[class^=pdf]");
        var cart_nav = $("#cart");
        $.ajax({
          type: "POST",
          url: "{{ route("customers.cart.store") }}",
          data: {
            _token: "{{ csrf_token() }}",
            produk_id: id,
            produk_type: "pdf"
          },
          success: function (data) {
            var cartcount = data.cartcount
            cartbutton.each(function(){
              $(this).html("Success").prop("disabled", true);
            })
            cart_nav.html("<i class='fa fa-shopping-cart' aria-hidden='true'></i> " + cartcount);
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $('#alertMessage').modal('show');
            $("#alertMessageLabel").html("Add To Cart Failed");
            $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
          }
        });
      });
    });
    $("[class^=video]").each(function(i) {
      $(this).on("click", function(){
        var id = this.id.split("-")[1];
        var cartbutton = $("[class^=video]");
        var cart_nav = $("#cart");
        $.ajax({
          type: "POST",
          url: "{{ route("customers.cart.store") }}",
          data: {
            _token: "{{ csrf_token() }}",
            produk_id: id,
            produk_type: "video"
          },
          success: function (data) {
            var cartcount = data.cartcount
            cartbutton.each(function(){
              $(this).html("Success").prop("disabled", true);
            })
            cart_nav.html(`
              <span class="d-none d-lg-block">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>`+ cartcount +`
              </span>
              <span class="d-lg-none">
              Cart (`+ cartcount +`)
              </span>
              `
            );
          },
          error: function (xhr, ajaxOptions, thrownError) {
            $('#alertMessage').modal('show');
            $("#alertMessageLabel").html("Add To Cart Failed");
            $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
          }
        });
      });
    })
  })
  </script>
@endsection
