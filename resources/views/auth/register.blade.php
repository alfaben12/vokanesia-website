@extends('layouts.base')

@section('style')
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
          <div class="contact-from-wraper wow fadeIn">
            <div class="xs-heading style4">
              <h3 class="section-title">Daftar Sekarang</h3>
            </div>
            <form action="#" class="xs-from" method="post" id="xs-register-form">
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <input id="xs-register-f_name" type="text" class="form-control" placeholder="Nama Depan">
                  </div>
                  <div class="col-6">
                    <input id="xs-register-l_name" type="text" class="form-control" placeholder="Nama Belakang">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input id="xs-register-email" type="email" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input id="xs-register-password" type="password" secret placeholder="Password" class="form-control">
              </div>
              <div class="form-group">
                <input id="xs-register-c_password" type="password" secret placeholder="Ulangi Password" class="form-control">
              </div>
              <div class="form-group">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                  </div>
                  <input id="xs-register-no_hp" type="number" class="form-control" placeholder="812345xxxxx" aria-label="Np. Hp" aria-describedby="basic-addon1" min="0">
                </div>
              </div>
              <button type="submit" class="btn btn-primary style2" id="xs-register-submit">Daftar</button>
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
          <h4 class="modal-title mx-auto" id="alertMessageLabel">Registration Failed</h4>
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
