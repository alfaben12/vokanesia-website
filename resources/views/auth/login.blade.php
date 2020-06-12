@extends('layouts.base')

@section("style")
  <style media="screen">
  .has-error .form-control.is-invalid{
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
  }
  .has-error .form-control.is-invalid:focus{
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem #dc3545;
  }
  </style>
@endsection

@section('body')
  <section class="xs-section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="login-from-wraper wow fadeIn">
            <div class="xs-heading style4">
              <h3 class="section-title">Login Sekarang</h3>
            </div>
            <form action="{{ url('auth/login/do') }}" class="xs-from has-error" method="post" id="xs-login-form"> <!-- kalau error ditambah has-error -->
              <div class="form-group">
                <input type="email" name="email" id="xs-login-email" placeholder="Email" class="@error('email') is-invalid @enderror form-control"> <!-- kalau error ditambah is-invalid -->
                <!-- Error message -->
                @error('email')
                  <div class="alert alert-danger alert-dismissible mt-2">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @enderror
                <!-- End error message -->
              </div>
              <div class="form-group">
                <input type="password" secret name="password" id="xs-login-password" placeholder="Passwords" class="form-control @error('password') is-invalid @enderror">
              </div>
              @error('password')
                <div class="alert alert-danger alert-dismissible mt-2">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @enderror
              <button type="submit" name="submit" class="btn btn-primary style2" id="xs-login-submit">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
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
