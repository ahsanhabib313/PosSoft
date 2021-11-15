<div class="row">
  <div class="col-md-12">
      {{--start navbar--}}   
      <div class="navigation">
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
          <!-- Brand -->
          <a class="navbar-brand" href="#">Logo</a>

          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Navbar links -->
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
             <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><img src="{{asset('img/profile/userAvatar.png')}}" height="25" width="25" class="round-circle">
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Logout</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Super Admin</a>
              </li>
             
            </ul>
          </div>
        </nav>
      </div>
 </div>
</div>