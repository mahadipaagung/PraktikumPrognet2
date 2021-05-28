<!-- HEADER =============================-->
<header class="item header margin-top-0">
  <div class="wrapper">
    <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle navigation</span>
        </button>
        <a href="/" class="navbar-brand brand">TheGADGET 2</a>
      </div>
      <div id="navbar-collapse-02" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item active"><a class="nav-link" href="\">Home</a></li>
          <li class="nav-item active"><a class="nav-link" href="\shop">Shop</a></li>
          @guest
            <li class="nav-item submenu dropdown">
              <a class="nav-link" href="/login">Login</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="/transaksi/{{Crypt::encrypt(Auth::user()->id)}}">Transaction</a>
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
          @auth
          <li class="nav-item active"><a class="nav-link" href="\cart">Cart</a></li>
          <li class="nav-item avatar dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span class="badge badge-danger ml-2">4</span>
              <i class="fa fa-bell"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-5">
              <a class="dropdown-item waves-effect waves-light" href="#">Notification 1</a><br>
              <a class="dropdown-item waves-effect waves-light" href="#">Notification 2</a><br>
              <a class="dropdown-item waves-effect waves-light" href="#">Notification 3</a><br>
            </div>
          </li>
          @endauth
        </ul>
      </div>
    </div>
    </nav>
  </div>
  <div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="text-homeimage">
					<div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
						Welcome To
					</div>
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
						TheGADGET 2
					</div>
				</div>
			</div>
		</div>
	</div>
</header>