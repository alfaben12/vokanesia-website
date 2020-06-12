<section class="inner-banner-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="inner-banner-content">
          <div class="row">
            <div class="col-12 col-lg-2 mt-3 mt-lg-0 text-center">
              <img src="{{ asset('upturn/images/team/team-12.jpg') }}" class="img-thumbnail" alt="">
            </div>
            <div class="col-12 col-lg-6 mt-3 my-lg-auto text-center text-lg-left">
              <h1 class="inner-banner-title">{{ Auth::guard("web_customers")->user()->nama }}</h1>
              <h5 class="text-white">Location</h5>
            </div>
            <div class="col-lg-4 col-12 my-lg-auto mt-3 text-center text-lg-left">
              <div class="row">
                <div class="col-6">
                  <div class="col-12 text-center">
                    <h1 class="text-white">{{Auth::guard("web_customers")->user()->totalVideo()}}</h1>
                  </div>
                  <div class="col-12 text-center">
                    <h5 class="text-white">Video</h3>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="col-12 text-center">
                      <h1 class="text-white">{{Auth::guard("web_customers")->user()->totalEbook()}}</h1>
                    </div>
                    <div class="col-12 text-center">
                      <h5 class="text-white">E-Book</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="banner-image" style="background-image:url('assets/images/backgrounds/background-1.jpg')"></div>
  </div>
</section>
<section class="pb-0 pt-5 xs-section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-md-none mb-3">
          <select class="form-control" onchange="location = this.value;">
            <option value="{{ route('customers.c.dashboards') }}" {{ Request::is("customers/dashboard*") ? "selected" : "" }}>Dashboard</option>
            <option value="{{ route('customers.settings.index') }}" {{ Request::is("customers/settings*") ? "selected" : "" }}>Pengaturan</option>
            <option value="{{ route("customers.history.index") }}" {{ Request::is("customers/history*") ? "selected" : "" }}>Riwayat Pembelian</option>
            <option value="{{ route("customers.library.index") }}" {{ Request::is("customers/library*") ? "selected" : "" || Request::is("customers/video*") ? "selected" : "" }}>Library</option>
            <option value="{{ route("customers.messages.index") }}" {{ Request::is("customers/messages*") ? "selected" : "" }}>Messages</option>
            <option value="{{ route("customers.certificate.index") }}" {{ Request::is("customers/certificate*") ? "selected" : "" }}>Sertifikat</option>
          </select>
        </div>
        <div class="agency-filter-wraper d-none d-md-block">
          <div class="filter-button-wraper">
            <ul id="filters" class="clearfix main-filter">
              <li><a href="{{ route('customers.c.dashboards') }}" {{ Request::is("customers/dashboard*") ? "class=selected" : "" }}>Dashboard</a></li>
              <li><a href="{{ route('customers.settings.index') }}" {{ Request::is("customers/settings*") ? "class=selected" : "" }}>Pengaturan</a></li>
              <li><a href="{{ route("customers.history.index") }}" {{ Request::is("customers/history*") ? "class=selected" : "" }}>Riwayat Pembelian</a></li>
              <li><a href="{{ route("customers.library.index") }}" {{ Request::is("customers/library*") ? "class=selected" : "" || Request::is("customers/video*") ? "class=selected" : "" }}>Library</a></li>
              <li><a href="{{ route("customers.messages.index") }}" {{ Request::is("customers/messages*") ? "class=selected" : "" }}>Messages</a></li>
              <li><a href="{{ route("customers.certificate.index") }}" {{ Request::is("customers/certificate*") ? "class=selected" : "" }}>Sertifikat</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
