<div class="row">
  <div class="col-md-12">
      {{--start navbar--}}   
      <div class="navigation">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
          <!-- Brand -->
          <a class="navbar-brand" href="#"><img class="rounded" src="{{ asset('img/logo/logo.jpg') }}" height="50" width="50"></a>

          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Navbar links -->
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
              @if (Auth::check() && Auth::user()->role == 1)
                  <li class="nav-item">
                    <a class="nav-link engFont font-weight-bold" href="{{ route('dashboard') }}">Dashboard</a>
                  </li>
              @endif
             
             <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="{{asset('img/profile/userAvatar.png')}}" height="25" width="25" class="round-circle">
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item  engFont" href="{{route('logout')}}">Logout</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link engFont" href="#">{{Auth::user()->username}}</a>
              </li>
             
            </ul>
          </div>
        </nav>
      </div>
 </div>
</div>