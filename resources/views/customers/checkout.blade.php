@extends('layouts.base')

@section('body')
<section class="xs-section-padding mt-3"></section>

  <!-- Start Work Here -->
  <div class="content-wrapper bg-background-wrapper oh">

    <!-- Dashboard Profile -->
    <section class="section-wrap bg-shadow pt-60 pb-60 pb-sml-0">
      <div class="container">

        <div class="col-md-6">
        <h2>Konfirmasi Pembelian</h2>
        <table class="table table-hover product-table">
          <thead>
          <tr>
            <th>Produk</th>
            <th>Harga</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Ryan Ogilvy - Self Makeup</td>
            <td>
              <span style="text-decoration: line-through; font-size: 14px; color: rgb(34, 85, 161)">Rp 490,000</span>
              <div id="old-price">Rp 250,000</div>
              <div id="new-price"></div>
            </td>
          </tr>
          <thead>
            <tr>
              <th>Total</th>
              <td>Rp 250,000</td>
            </tr>
          </thead>
        </tbody>
        </table>

        <div class="giftcode-alert"></div>

        <form id="form-giftcode" method="post" action="#" class="flex-form">
          <div class="col-sm-12 text-left">
                <input type="checkbox" id="gift_code" class="input-radio" onchange="showgiftcode(this)">
                <label class="mt-0" for="gift_code" style="color: #000000; font-size: 14px;">Saya mempunyai kode hadiah / voucher</label>
                <hr style="margin-top:23px;"/>
          </div>
          <div class="row mt-20 hidden" id="showcode">
            <div class="col-sm-6">
              <input type="text" name="gift_code" class="form-control main-payment-input gift-code" placeholder="Ada Kode Hadiah?">
            </div>
            <div class="col-sm-6">
              <input name=product_id value="1" type="hidden">
              <button id="btn-giftcode" type="button" class="btn btn-stroke btn-block btn-giftcode" style="line-height: 28px">Masukan Kode</button>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <p style="color:rgb(250, 40, 40);">Pastikan tekan "Masukan Kode" sebelum "Lanjut"</p>
                <p style="color:rgb(255, 40, 40);">Bagi partisipan Prakerja, harap ambil kelas sesuai dengan yang ada di dasbor Prakerja, untuk mendapatkan sertifikat"</p>
              </div>
            </div>

          </div>
        </form>

        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div></div>          </div>
        </div>

        <div id="signup-alertbox" class="alertbox"></div>
          
             
                        <form id="subscription-form-data" action="#" method="post">

              
              <div class="form-group">
                <input type="submit" class="form-control btn mt-10 mt-sml-20" value="Lanjut">
              </div>

              <p>* Dengan melanjutkan anda telah menyetujui <a href="#">Syarat & Ketentuan</a></p>
              <hr>
              <hr>
              <input type="hidden" name="product_id" value="1">
              <input type="hidden" name="gcid" value="">
              <input type="hidden" name="affiliate" value="">
            </form>
          
          <!-- Modal -->
          <div class="text-left modal fade" id="modalAccountExistConfirmation" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
              <div class="modal-content ">
                <!-- Modal Header -->
                <div class="modal-header" style="background: #c19b70">
                  
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Apakah ini akun Anda?</h4>
                </div> <!-- Modal Body -->

                <div class="modal-body">
                  <p>Akun dengan email <strong></strong> sudah terdaftar!</p>
                  <p>Klik tombol dibawah apabila ini adalah akun Anda</p>

                  <form id="subscription-form-data"  action="#" method="post">


                    <div class="form-group">
                      <input type="submit" class="form-control btn mt-10 mt-sml-20" value="Beli Kelas">
                    </div>
                    <input type="hidden" name="email" value="">
                    <input type="hidden" name="product_id" value="1">
                    <input type="hidden" name="gcid" value="">
                    <input type="hidden" name="affiliate" value="">
                  </form>
              </div>

              <div class="modal-footer" id="modal_footer">
              </div>

            </div>
            </div>
            </div>
      </div>
      </div>
      </section>>
@endsection