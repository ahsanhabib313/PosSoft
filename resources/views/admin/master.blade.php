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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/css/employee.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
   
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css')}}">
    <style>
    .loader {
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
        .modal-lg {
            max-width: 100%;
        }
        .alert-success, .alert-danger{
            font-size: 15px;
            font-weight: 600;
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
                <li class="treeview"><a href="{{route('admin.company')}}">
                    <i class="icon icon icon-package light-green-text s-18"></i>
                    <span  style="color:#8B0000">কোম্পানী</span>
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
                    <a href="{{ route('admin.merchant') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">আড়ৎদার </span>
                    </a>
                </li>
                <li class="treeview no-b">
                    <a href="{{ route('admin.bank') }}">
                        <i class="icon icon-package light-green-text s-18"></i>
                        <span style="color:#8B0000">ব্যাংক</span>
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
        <div class="navbar navbar-expand d-flex navbar-dark justify-content-between bd-navbar blue accent-3 shadow" style="padding: 10px;">
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
                    <li style="margin-top:3px;margin-right: 10px;">
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#notification-modal" id="notification_btn">
                            নোটিফিকেশন <span class="badge badge-danger text-white" style="font-size: 18px;" id="totalAlert">{{ $totalAlert }}</span>
                          </button>
                          
                {{-- start notification Modal--}}
                
                    <div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">নোটিফিকেশন</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="engFont">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <ul class="menu" id="notification_menu">
                                    
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
                            </div>
                          </div>
                        </div>
                      </div>
                {{-- end Calculator Modal--}}
                   
                    </li>
                    <li style="margin-top:5px">
                        <a href="{{ route('admin.logout') }}">
                            
                            <div class="pt-1 font-weight-bold text-white"><i class='fas fa-sign-out-alt' style='font-size: 25px;
                                color: red;'></i></div>
                            
                        </a>
                    </li>
                </ul>
            </div>
        </div>
       
            @yield('content')
       
        
    
</div>


<script src="{{ asset('admin/assets/js/app.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" async integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.company').select2();
</script>    
<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>

</body>
</html>

