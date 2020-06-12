@extends('layouts.base')
@section('style')

  <link rel="stylesheet" href='{{asset("upturn/css/jquery.pinlogin.css")}}'>
  <style media="screen">
  .pinlogin .pinlogin-field{
    margin-right: 0px;
  }
</style>
@endsection
@section('body')
  <section class="xs-section-padding">
    <div class="container mt-5">
      <div class="row">
        <div class="card mx-auto" style="width: 35rem;">
          <div class="col-lg-12 text-center py-5">
            <p class="mb-0" style="font-weight: bolder"><b>Silahkan Masukkan Kode 6-Digit Yang Sudah Kami Kirimkan Via Whatsapp:</b></p>
            <small id="message" style="color:red; display:none">Pin Yang Anda Masukkan Salah</small>
            <form action="#" id="otp_submit" method="post">
              <div class="col-12 mx-auto mt-3" id="pinwrapper"></div>
              <!-- <div class="col-12 mt-3">
              <h5 id="time">02:00</h5>
            </div> -->
            <button type="submit" id="submit" name="button" class="btn btn-primary btn-sm mt-2">VERIFIKASI</button>
          </form>

          <!-- <div class="mt-3">
          Tidak Meneri Kode?<br>
          <a href="#">Kirim Ulang Kode Pin</a><br>
          <a href="#">Ubah No Hp</a>
        </div> -->
      </div>
    </div>
  </div>
</div>
</section>
@if (isset($error) && $error)
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mx-auto" id="exampleModalLongTitle">Send OTP Error</h5>
        </div>
        <div class="modal-body text-center">
          <b>Error happened while sending OTP<br />Please try again</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary mx-auto" onClick="window.location.reload();">RELOAD</button>
        </div>
      </div>
    </div>
  </div>
@endif
@endsection

@section('script')
  <script src='{{ asset("upturn/js/jquery.pinlogin.js")}}' charset="utf-8"></script>
  <script>
  $(function(){
    @if (isset($error) && $error)
      $("#exampleModalCenter").modal("show");
    @endif
    var otp = null; // nanti hasil OTP masuk di sini
    var pinlogin = $('#pinwrapper').pinlogin({
      fields: 6,
      hideinput: false,
      complete : function(pin){
        otp = pin;
      },
      reset: false
    });
    $("#otp_submit").on("submit", function(e){
      e.preventDefault();
      $("#submit").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>LOADING...');
      $.ajax({
        type : 'POST',
        url : '/customers/otp/verief',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data : {
          'otp_code': otp
        },
        success : function success(result){
          if(result.status == 'success')
          {
            //console.log(result)
            location.replace('/customers/dashboard')
          }else{
            $('#message').show();
            $("#submit").prop("disabled", false).html('VERIFIKASI');
            pinlogin.reset()
          }
        },
        error : function (xhr, ajaxOptions, thrownError){
          $('#message').show();
          $("#submit").prop("disabled", false).html('VERIFIKASI');
          pinlogin.reset()
        }
      }) // ini hasil submit
    });
    function startTimer(duration, display) {
      var timer = duration, minutes, seconds;
      setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(minutes + ":" + seconds);

        if (--timer < 0) {
          timer = duration;
          //
        }
      }, 1000);
    }

    jQuery(function ($) {
      var time = 60 * 2,
      display = $('#time');
      startTimer(time, display);
    });
  });
  </script>
@endsection
