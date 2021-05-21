<header class="main-header">
  <!-- Start Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
    <div class="container">
      <!-- Start Header Navigation -->
      <div class="navbar-header">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand" href="#"><img src="{{ asset('thewayshop/images/logo1.png') }}" class="logo" alt=""></a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
          <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
              <li class="nav-item active"><a class="nav-link" href="\">Beranda</a></li>
              @guest
                <li class="nav-item submenu dropdown">
                  <a class="nav-link" href="/login">Login</a>
                </li>
                @else
                <li class="nav-item">
                  <a class="nav-link" href="/transaksi/{{Auth::user()->id}}">Transaction</a>
                </li>
                <li class="nav-item submenu dropdown">
                    <a class="dropdown-item nav-link" href="{{ url('/user/logout') }}"
										   onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
                    <form id="logout-form"  action="{{ url('/user/logout') }}" method="GET" style="display: none;">
											@csrf
										</form>
								</li>
              @endguest
          </ul>
      </div>
      <div class="attr-nav">
        <ul>
          <li class="search"><a href="#"><i class="fa fa-bell"></i></a></li>
          <li class="nav-item">
            @auth
            <a href="/cart" class="icons">
              <i class="fa fa-shopping-bag"><span class="badge badge-pill badge-info" id="jumlahcart">{{Auth::user()->cart->where('status','=','notyet')->count()}}</span></i>
            </a>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
