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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/employee.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
   
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css')}}">
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

    @stack('styles')
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
                <li class="header"><strong></strong></li>
                <li class="treeview">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-columns blue-text s-18 mr-4"></i>
                    <span style="color:#8B0000">ডেসবোর্ড </span>
                </a>
                </li>
                <li class="treeview"><a href="{{ route('admin.category.index') }}">
                    <i class="icon icon icon-package light-green-text s-18"></i>
                    <span  style="color:#8B0000">পণ্যের শ্রেণী</span>
                </a>
                </li>
                <li class="treeview">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">পণ্য</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.order.show') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">অর্ডার</span>
                    </a>
                </li>

                <li class="treeview no-b">
                    <a href="{{ route('admin.designation') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span  style="color:#8B0000">পদবি</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.bank') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">ব্যাংক</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.merchant') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">আড়ৎদার </span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.employee') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">কর্মচারী</span>
                    </a>
                </li>
               
                <li class="treeview no-b">
                    <a href="{{ route('admin.employee.payment') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">কর্মচারীর বেতন</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.transactionType.index') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000"> আর্থিক লেনদেনের প্রকার</span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.transaction') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000"> আর্থিক লেনদেন</span>
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
                        <h1 class="nav-title text-white">ড্যাসবোর্ড</h1>
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
                            <li class="header">আপনার  <span class="totalAlert">{{ $totalAlert }}</span> টি নোটিফিকেশন আছে</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="notification_menu">
                                    
                                </ul>
                            </li>
                           
                        </ul>
                    </li>
                  
                    <li class="dropdown custom-dropdown user user-menu ">
                        <a href="panel-page-dashboard2.html#" class="nav-link" data-toggle="dropdown">
                            <img src="{{asset('admin\assets\img\dummy\u1.png')}}" class="user-image" alt="User Image">
                            <i class="icon-more_vert "></i>
                        </a>
                        <div class="dropdown-menu p-4 dropdown-menu-right">
                            <div class="row box justify-content-between my-4">
                                <div class="col">
                                    <a href="#">
                                        <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                                        <div class="pt-1">এপস</div>
                                    </a>
                                </div>
                                <div class="col"><a href="#">
                                    <i class="icon-beach_access pink lighten-1 avatar  r-5"></i>
                                    <div class="pt-1">প্রোফাইল</div>
                                </a></div>
                                <div class="col">
                                    <a href="{{ route('admin.logout') }}">
                                        <i class="icon-perm_data_setting indigo lighten-2 avatar  r-5"></i>
                                        <div class="pt-1 font-weight-bold ">লগ আউট</div>
                                        
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" async integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@stack('scripts')
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

