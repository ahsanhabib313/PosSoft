<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    


    <link rel="icon" href="{{ asset('admin/assets/img/basic/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/employee.css')}}">
   
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css')}}">
   {{--  <link rel="stylesheet" href="{{asset('css/home.css')}}"> --}}
    <style>.loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
        <section class="sidebar">
            <ul class="sidebar-menu" style="color:#000">
                <li class="header"><strong>MAIN NAVIGATION</strong></li>
                <li class="treeview">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-columns blue-text s-18 mr-4"></i>
                    <span style="color:#8B0000">Dashboard</span>
                </a>
                </li>
                <li class="treeview"><a href="{{ route('admin.category.index') }}">
                    <i class="icon icon icon-package light-green-text s-18"></i>
                    <span  style="color:#8B0000">Categories</span>
                </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Products</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.order.show') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Orders</span>
                    </a>
                </li>

                <li class="treeview no-b">
                    <a href="{{ route('admin.designation') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span  style="color:#8B0000">Designations</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.bank') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Banks</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.merchant') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Merchant</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.employee') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Employees</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.employee.payment') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Employees Payment</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.transaction') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">Transaction</span>
                    </a>
                </li>
            
            </ul>
        </section>
    </aside>
    <!--Sidebar End-->
    <div class="page has-sidebar-left">
        <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                <div class="search-bar">
                    <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                        placeholder="start typing...">
                </div>
                <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
                aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
            </div>
        </div>
    </div>
        <div class="navbar navbar-expand d-flex navbar-dark justify-content-between bd-navbar blue accent-3 shadow">
            <div class="relative">
                <div class="d-flex">
                    <div>
                        <a href="panel-page-dashboard2.html#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                            <i></i>
                        </a>
                    </div>
                    <div class="d-none d-md-block">
                        <h1 class="nav-title text-white">Dashboard</h1>
                    </div>
                </div>
            </div>
              <!--Top Menu Start -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages-->
                
                    <!-- Notifications -->
                    <li class="dropdown custom-dropdown notifications-menu">
                        <a href="panel-page-dashboard2.html#" class=" nav-link" data-toggle="dropdown" aria-expanded="false">
                            <i class="icon-notifications" id="icon_notification"></i>
                        <span class="badge badge-danger badge-mini rounded-circle" id="totalAlert"  >{{ $totalAlert }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="header">You have  <span class="totalAlert">{{ $totalAlert }}</span> notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="notification_menu">
                                    
                                </ul>
                            </li>
                           
                        </ul>
                    </li>
                  
                    <li class="dropdown custom-dropdown user user-menu ">
                        <a href="panel-page-dashboard2.html#" class="nav-link" data-toggle="dropdown">
                            <img src="assets/img/dummy/u8.png" class="user-image" alt="User Image">
                            <i class="icon-more_vert "></i>
                        </a>
                        <div class="dropdown-menu p-4 dropdown-menu-right">
                            <div class="row box justify-content-between my-4">
                                <div class="col">
                                    <a href="#">
                                        <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                                        <div class="pt-1">Apps</div>
                                    </a>
                                </div>
                                <div class="col"><a href="#">
                                    <i class="icon-beach_access pink lighten-1 avatar  r-5"></i>
                                    <div class="pt-1">Profile</div>
                                </a></div>
                                <div class="col">
                                    <a href="{{ route('admin.logout') }}">
                                        <i class="icon-perm_data_setting indigo lighten-2 avatar  r-5"></i>
                                        <div class="pt-1 font-weight-bold ">Logout</div>
                                        
                                    </a>
                                    
                                </div>
                            </div>
                          
                        </div>
                    </li>
                </ul>
            </div>
        </div>
       
            @yield('content')
       
        
    
</div>


<script src="{{ asset('admin/assets/js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>


//create notification and show
function createShowNotify(){
    
    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            // store data using ajax
            $.ajax({
                url: '/admin/show/notification/',
                type: 'GET',
                processData: false,
                contentType: false,
                success: function(data){
                  
                    if(data.status == 'success'){
                        $('#totalAlert').text(data.totalAlert);
                        $('.totalAlert').text(data.totalAlert);
                        $('#notification_menu').html(data.productNotification);
                    } 
                

                },
                error: function(data){
                   
                }

            });
}

createShowNotify();


// show notificaion after a interval
 setInterval(() => {
     createShowNotify();
    }, 300000); 
 
    $(document).on('click','#icon_notification', function(e){

        e.preventDefault();
        $('#totalAlert').text(0);
   
   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
   // store data using ajax
   $.ajax({
     url: '/admin/notification/mark/read',
     type: 'GET',
     processData: false,
     contentType: false,
     success: function(data){
       if(data.status == 'success'){
            $('#totalAlert').text(0);
       }

     },
     error: function(data){
        
     }

   });
})
    
</script>



<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

</body>
</html>

