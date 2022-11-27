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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white" onclick="hideCategory(this)" hide="off" id="hide-btn"> <i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link btn btn-info text-white ml-3" href="javascript:void(0)" onclick="getCategories()"><i class="fa fa-list-alt" aria-hidden="true"></i></a>

                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info text-white ml-3" href="#calculator-modal" data-toggle="modal"><i class="fa fa-calculator" aria-hidden="true"></i></a>

                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link engFont" href="#">{{Auth::user()->username}}</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link engFont" href="{{route('user.logout')}}"><i class='fas fa-sign-out-alt' style='    font-size: 25px;
                      color: #dae0e5;'></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
 </div>
</div>