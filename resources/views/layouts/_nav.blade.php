<div class="header nav-sticky header-tranparent header-tranparent-style2">
  <!-- top bar section -->
  <div class="xs-top-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <ul class="xs-top-bar-info">
            <li>
              <p><a href="tel:0341-8205510"><i class="icon icon-phone"></i>0341-8205510</a></p>
            </li>
            <li>
              <a href="mailto:halo@vokanesia.id"><i class="icon icon-email"></i>halo@vokanesia.id</a>
            </li>
          </ul>
        </div>
        <div class="col-md-6">
          <ul class="xs-list list-inline">
            <li><a href="https://www.facebook.com/vokanesia"><i class="icon icon-facebook"></i></a></li>
            <li><a href="https://twitter.com/vokanesia"><i class="icon icon-twitter"></i></a></li>
            <li><a href="https://www.instagram.com/vokanesia.id"><i class="icon icon-instagram"></i></a></li>
            <li><a href="https://www.youtube.com/channel/UCycepOpin1oi0tDET4Hx45g"><i class="icon icon-youtube-v"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- end of top bar -->
  <header class="xs-header header-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
          <div class="xs-logo-wraper">
            <a href="{{route('home')}}" class="xs-logo">
              <img src="{{asset('assets/images/logo.png')}}" alt="vocanesia">
            </a>
          </div>
        </div>
        <div class="col-lg-10">
          <nav class="xs-menus align-to-right">
            <div class="nav-header">
              <a href="#" class="nav-brand"></a>
              <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper">
              <ul class="nav-menu align-to-right single-page-menu">
                @guest('web_customers')
                  <li><a href="{{route('home')}}">Beranda</a></li>
                  <li><a href="{{route('shop.index', ['type' => 'video'])}}">Video</a></li>
                  <li><a href="{{route('shop.index', ['type' => 'ebook'])}}">Ebook</a></li>
                  <li><a href="{{route('blog.index')}}">Blog</a></li>
                  <li><a href="{{route('auth.login')}}">Masuk</a></li>
                  <li><a href="{{route('auth.register')}}">Daftar</a></li>

                  <!--li>
                  <div class="btn-wraper">
                  <a href="{{route('auth.login')}}" class="btn btn-primary">Masuk</a>
                </div>
              </li-->
            @endguest
            @auth('web_customers')
              <li><a href="{{route('customers.c.dashboards')}}">Dashboard</a></li>
              <li><a href="{{route('shop.index', ['type' => 'video'])}}">Video</a></li>
              <li><a href="{{route('shop.index', ['type' => 'ebook'])}}">Ebook</a></li>
              <li><a href="{{route('blog.index')}}">Blog</a></li>
              <li>
                <a href="#">{{ Auth::guard('web_customers')->user()->nama }}</a>
                <ul class="nav-dropdown xs-icon-menu clearfix">
                  <li class="single-menu-item">
                    <a href="{{route('customers.settings.index')}}">Edit Profil</a>
                  </li>
                  <li class="single-menu-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Keluar
                    </a>
                    <form id="logout-form" action="{{ url('customers/logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
              <li>
                <a href="{{route('customers.cart.index')}}" id="cart">
                  <span class="d-none d-lg-block">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>{{Auth::guard('web_customers')->user()->totalCart() > 0 ? Auth::guard('web_customers')->user()->totalCart() : ''}}
                  </span>
                  <span class="d-lg-none">
                    Cart {{Auth::guard('web_customers')->user()->totalCart() > 0 ? "(". Auth::guard('web_customers')->user()->totalCart() .")" : ''}}
                  </span>
                </a>
              </li>
            @endauth
          </ul>
        </div>
      </nav>
    </div>
  </li>
</ul>
</div>
</nav>
</div>
</div>
</div>
</header>
</div>
