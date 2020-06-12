@extends('layouts.base')

@section('body')
@include('layouts.customer_header')
@if (($message = Session::get('success')) || ($message = Session::get('error')))
  <section class="xs-section-padding py-0 my-5">
    <div class="container">
      <div class="alert alert-{{ Session::get('success') ? 'success' : 'danger'}} text-center alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>{!! $message !!}</b>
      </div>
    </div>
  </section>
@endif
<section class="xs-section-padding blog-single-post-section pt-0 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="single-blog-post post-list format-gallery">
          <div class="post-body py-3">
            <div class="entry-header">
              <div class="entry-content my-3">
                <div class="row my-auto">
                  <div class="col-12 mb-lg-5 mb-2">
                    <div class="col-12">
                      <h4 class="small">Ubah Profil</h4>
                    </div>
                    <form action="{{url("customers/settings/$user->id")}}" class="xs-from" method="post">
                    @csrf
                    @method("PUT")  
                      <div class="form-group">
                          <input type="text" name="nama" require class="form-control" placeholder="Nama" value="{{$user->nama}}">
                      </div>
                      <div class="form-group">
                        <input id="xs-register-email" type="email" name="email" placeholder="Email" class="form-control" value="{{$user->email}}">

                      </div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                          </div>
                          <input id="xs-register-no_hp" type="number" name="no_hp" value="{{$user->no_hp}}" class="form-control" placeholder="812345xxxxx" aria-label="Np. Hp" aria-describedby="basic-addon1">
                        </div>
                      </div>
                      <input type="hidden" name="profil">
                      <div class="form-group text-center">
                        <input type="submit" value="SIMPAN" class="btn btn-primary style2">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="blog-single-post-section pb-5 pt-0 xs-section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="single-blog-post post-list format-gallery">
          <div class="post-body py-3">
            <div class="entry-header">
              <div class="entry-content my-3">
                <div class="row my-auto">
                  <div class="col-12 mb-lg-5 mb-2">
                    <div class="col-12">
                      <h4 class="small">Ubah Password</h4>
                    </div>
                    <form action="{{url("customers/settings/$user->id")}}" class="xs-from" method="post">
                    @csrf
                    @method("PUT")
                      <div class="form-group">
                        <input id="xs-register-old-password" name="password_lama" type="password" secret placeholder="Password lama" class="form-control">
                      </div>
                      <div class="form-group">
                        <input id="xs-register-password" name="password_baru" type="password" secret placeholder="Password baru" class="form-control">
                      </div>
                      <div class="form-group">
                        <input id="xs-register-c_password" name="password_konfirmasi" type="password" secret placeholder="Ulangi Password" class="form-control">
                      </div>
                      <input type="hidden" name="ubah_password">
                      <div class="form-group text-center">
                        <input type="submit" value="SIMPAN" class="btn btn-primary style2">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
