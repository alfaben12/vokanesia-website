@extends('layouts.base')

@section("style")
@endsection

@section('body')
<div class="content-wrapper bg-background-wrapper oh">
<!-- Dashboard Profile -->
    <section class="section-wrap bg-shadow pt-60 pb-60 pb-sml-0">
        <div class="container">
                <div class="col-md-6">
                <br/>
                    <h2>Konfirmasi Pembayaran</h2>
                    <form id="form-giftcode" method="post" action="#" class="flex-form">
                      <div class="col-sm-12 text-left">
                            <hr style="margin-top:23px;"/>
                      </div>
                      <div class="row mt-20">
                        <div class="col-sm-6">
                          <input type="file" name="file" id="file" class="form-control main-payment-input">
                        </div>
                        <div class="col-sm-12">
                          <br>
                          <p style="color:rgb(250, 40, 40);">Pastikan gambar (.jpg, .png, .jpeg) sebelum "Konfirmasi"</p>
                          <br>
                        </div>
                      </div>
                    </form>

                    <div id="signup-alertbox" class="alertbox"></div>
                        <div id="subscription-form-data" action="#" method="post">
                            <div class="form-group">
                              <button type="submit" id="pay_button" class="form-control btn mt-10 mt-sml-20">Konfirmasi</button>
                            </div>
                        </div>
                    </div>
                </div>
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
  $('#pay_button').on('click', function(e){
    e.preventDefault();    
    var formData = new FormData();
    formData.append('file', $('#file')[0].files[0]);

    $.ajax({
      type : 'POST',
      url : '/customers/payment/confirm/{{ Request::segment(3) }}',
      cache: false,
      contentType: false,
      processData: false,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data : formData,
      success : function success(result){
        location.reload()
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
