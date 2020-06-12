

<div class="row service-block-group">
@foreach ($pdfs as $produk)
<div class="col-md-6 col-lg-4">
   <div class="xs-single-product text-center">
      <div class="d-none d-lg-inline-flex product-header" style="height: 250px;
         width: 250px;
         display: flex;
         align-items: center;
         flex-wrap: wrap;">
         <img src="{{ Voyager::image($produk->cover) }}" style="height: 250px;
            width: 250px;
            padding-top: 10px;
            object-fit: cover;" alt="">
         <div class="hover-area">
            <div class="btn-wraper">
               @if ($produk->getTable() == "course_produks")
               <a href="{{ route('shop.show', ['type' => 'video', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}" class="video-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Detail</a>
               @elseif ($produk->getTable() == "pdf_produks")
               <a href="{{ route('shop.show', ['type' => 'pdf', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}" class="pdf-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Detail</a>
               @endif
            </div>
         </div>
      </div>
      <div class="d-lg-none product-header">
         <img src="{{ Voyager::image($produk->cover) }}" alt="">
         <div class="hover-area">
            <div class="btn-wraper">
               @if ($produk->getTable() == "course_produks")
               <a href="{{ route('shop.show', ['type' => 'video', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}" class="video-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Detail</a>
               @elseif ($produk->getTable() == "pdf_produks")
               <a href="{{ route('shop.show', ['type' => 'pdf', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}" class="pdf-{{ $produk->id }} btn btn-primary icon-left style3"><i class="icon icon-shopping-cart2"></i> Detail</a>
               @endif
            </div>
         </div>
      </div>
      <div class="product-footer">
         @if ($produk->getTable() == "course_produks")
         <h2 class="product-title"><a href="{{ route('shop.show', ['type' => 'video', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}">{{ $produk->name }}</a></h2>
         @elseif ($produk->getTable() == "pdf_produks")
         <h2 class="product-title"><a href="{{ route('shop.show', ['type' => 'pdf', 'kategori' => $produk->kategoriDetails()->slug, 'title' => $produk->slug])}}">{{ $produk->name }}</a></h2>
         @endif
         <span class="price">
         <ins>
         <span class="woocommerce-Price-amount amount">
         <span class="woocommerce-Price-currencySymbol">Rp. </span>{{ number_format($produk->harga, 0, ",", ".") }}
         </span>
         </ins>
         </span>
      </div>
   </div>
   </div>
   <!-- .xs-single-product END -->
   @endforeach
</div>
<!-- .row .service-block-group END -->
    </div><!-- .container END -->
</section><!-- end service info block section -->