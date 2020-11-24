<div class="collapse navbar-collapse d-inline-block" id="navbarNav">
    <ul class="navbar-nav ml-auto">  
      @if (Route::has('login'))
          @auth
            @if(auth()->user()->role=="admin")
              <li class="nav-item">
                <a class="nav-link text-white js-scroll-trigger mr-3" href="#">View All User Transaction</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white js-scroll-trigger ml-3 mr-3" href="#">View All User</a>
              </li>
              <li class="dropdown ml-3">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user text-white">
                  <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->username  ?? ''}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>Log out
                  </a>
                </div>
              </li>
            @elseif(auth()->user()->role=="member")
              <li class="nav-item">
                <a class="nav-link text-white js-scroll-trigger mr-3" href="#">View Transaction History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white js-scroll-trigger ml-3 mr-3" href="#">View Cart</a>
              </li>
              <li class="dropdown ml-3">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user text-white">
                  <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->username  ?? ''}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>Log out
                  </a>
                </div>
              </li>
            @endif
          @else
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link text-white js-scroll-trigger mr-3">Login</a>  
          </li>        
            @if (Route::has('register'))
            <li class="nav-item">
              <a href="{{ route('register') }}" class="nav-link text-white js-scroll-trigger ml-3">Register</a>
            </li>
            @endif
          @endauth
      @endif
    </ul>
</div>