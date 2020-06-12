@extends('layouts.base')

@section("style")
@endsection

@section('body')
<div class="content-wrapper bg-background-wrapper oh">
<!-- Dashboard Profile -->
    <section class="section-wrap bg-shadow pt-60 pb-60 pb-sml-0">
        <div class="container">
            @if(count($data) > 0)
                <div class="col-md-6">
                    <h2>Konfirmasi Pembelian</h2>
                    <table class="table table-hover product-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produk</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $row)
                            <tr>
                              <td>
                                  <form action="{{route('customers.cart.destroy', $row['produk']->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                  </form>
                              </td>
                              <td>{{$row['produk']->userDetails()->name}} - {{$row['produk']->name}}</td>
                              <td>
                                <!-- <span style="text-decoration: line-through; font-size: 14px; color: rgb(34, 85, 161)">Rp. {{$row['produk']->harga}}</span> -->
                                <div id="old-price">Rp. {{number_format($row['produk']->harga)}}</div>
                              </td>
                            </tr>
                            @php
                                $total += $row['produk']->harga;
                            @endphp
                          @endforeach
                          <thead>
                            <tr id="grand-total-col">
                              <th colspan="2">Total</th>
                              <td>Rp {{number_format($total)}}</td>
                            </tr>
                          </thead>
                        </tbody>
                    </table>
                    <form id="form-giftcode" method="post" action="#" class="flex-form">
                      <div class="col-sm-12 text-left">
                            <input type="checkbox" id="gift_code" class="input-radio">
                            <label class="mt-0" for="gift_code" style="color: #000000; font-size: 14px;">Saya mempunyai kode hadiah / voucher</label>
                            <hr style="margin-top:23px;"/>
                      </div>
                      <div class="row mt-20" style="display:none" id="showcode">
                        <div class="col-sm-6">
                          <input type="text" name="gift_code" id="gift_code_input" class="form-control main-payment-input gift-code" placeholder="Ada Kode Hadiah?">
                        </div>
                        <div class="col-sm-6">
                          <button id="btn-giftcode" type="button" class="btn btn-stroke btn-block btn-giftcode" style="line-height: 28px">Masukan Kode</button>
                        </div>
                        <div class="col-sm-12">
                          <br>
                          <p style="color:rgb(250, 40, 40);">Pastikan tekan "Masukan Kode" sebelum "Lanjut"</p>
                          <br>
                        </div>
                      </div>
                    </form>

                    <div id="signup-alertbox" class="alertbox"></div>
                        <div id="subscription-form-data" action="#" method="post">
                            <div class="form-group">
                              <button type="submit" id="pay_button" class="form-control btn mt-10 mt-sml-20">Check Out</button>
                            </div>
                            <p>* Dengan melanjutkan anda telah menyetujui <a href="#">Syarat & Ketentuan</a></p>
                            <hr>
                            <hr>
                            <input type="hidden" name="product_id" value="1">
                            <input type="hidden" name="gcid" value="">
                            <input type="hidden" name="affiliate" value="">
                        </div>
                    </div>
                </div>
            @else
              <div style="padding:40px">
                <div style="display:flex;justify-content:center;align-items:center;text-align:center;flex-direction:column">
                <image src="{{asset('upturn/images/cart_empty.png')}}" width="300px"/>
                <br>
                <h4>Anda Belum Memiliki Produk Di Keranjang Anda</h4>
                <br>
                <a href="{{route('customers.c.dashboards')}}" class="btn btn-primary">Beranda</a>
                </div>
              </div>
            @endif
        </div>
    </section>
</div>
<div class="modal fade" id="alertMessage" tabindex="-1" role="dialog" aria-labelledby="alertMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mx-auto" id="alertMessageLabel">Login Failed</h4>
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
@endsection

@section("script")
<script>
  $("input#gift_code").on("change", function() {
    if($("#gift_code").prop('checked')){
      $("#showcode").show();
    }else{
      $("#showcode").hide();
    }
  })

  $("#btn-giftcode").on("click", function(e)
  {
    e.preventDefault;
    $("#pay_button").attr("disabled", true);
    $("#btn-giftcode").attr("disabled", true);
    $.ajax({
      type: 'POST',
      url : '/customers/payment/check_coupon',
      headers : {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data : {
        promo_code : $("#gift_code_input").val()
      },
      success : function success(result){
        if(result.state !== 'success')
        {
          $('#alertMessage').modal('show');
          $("#alertMessageLabel").html("Validasi Promo Code Failed");
          $("#message").html(result.message);
          $('#pay_button').attr("disabled", false);
          $("#btn-giftcode").attr("disabled", false);
        }else{
          var grandTotal = {{$total}}
          var discount = result.data.discount
          var total = (grandTotal / 100) * (100 - discount)
          var total_val = new Intl.NumberFormat().format(total)
          $("#grand-total-col").html("<td>Total</td><td>Rp "+ total_val +"</td><td style='color:red'><del>Rp {{number_format($total)}}<del></td>")
          $('#pay_button').attr("disabled", false);
        }
      },
      error : function(e) {
        $('#alertMessage').modal('show');
        $("#alertMessageLabel").html("Validasi Promo Code Failed");
        $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
        $('#pay_button').attr("disabled", false);
        $("#btn-giftcode").attr("disabled", false);
      }
    })
  })
  
  $('#pay_button').on('click', function(e){
    $('#pay_button').attr("disabled", true);
    e.preventDefault;
    $.ajax({
      type : 'POST',
      url : '/customers/payment/pay',
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data : {
        promo_code : $("#gift_code_input").val(),
      },
      success : function success(result){
        location.replace(result.midtrans_uri)
      },
      error : function(e) {
        //
        $('#alertMessage').modal('show');
        $("#alertMessageLabel").html("Checkout Failed");
        $("#message").html("Whoops something went wrong on our servers<br>Please try again later");
        $('#pay_button').attr("disabled", false);
      }
    })
  })
</script>
@endsection
