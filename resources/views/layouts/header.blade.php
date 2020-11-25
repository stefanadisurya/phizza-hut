<div class="collapse navbar-collapse d-inline-block" id="navbarNav">
  <img src="{{ asset('/image/pizza-logo.png') }}" alt="" height="60" width="60" style="margin-right:10px">
  @guest
    <a class="navbar-brand text-white" href=" {{ route('root') }}">PHizza Hut</a>
  @else
    <a class="navbar-brand text-white" href=" {{ route('home') }}">PHizza Hut</a>
  @endguest
  
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav ml-auto">
      @guest
          <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>

          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link text-white js-scroll-trigger ml-3" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          @if(auth()->user()->role=="admin")
            <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger mr-3" href="#">View All User Transaction</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger ml-3 mr-3" href="{{ route('getUser') }}">View All User</a>
            </li>

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white ml-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->username ?? '' }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="{{ route('add') }}">{{ __('Add Pizza') }}</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                </div>
            </li>

          @elseif(auth()->user()->role=="member")
            <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger mr-3" href="#">View Transaction History</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-white js-scroll-trigger ml-3 mr-3" href="#">View Cart</a>
            </li>

            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-white ml-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->username ?? '' }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                  </form>
              </div>
            </li>
          @endif
      @endguest
    </ul>
</div>