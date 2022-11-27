@extends('admin.master')
@section('title', 'এডমিন ড্যাসবোর্ড')
@section('content')
<div class="container-fluid relative animatedParent animateOnce " style="height: 100vh">
    <div class="tab-content pb-3" id="v-pills-tabContent">
          <!--Today Tab Start-->
          <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <div class="counter-title">আজকের বিক্রি</div>
                                <h5 class="sc-counter mt-3">{{$dailySells}} </h5><span> টাকা</span>
                            </div>
                            <div class="counter-title">আজকের অর্ডার</div>
                            <h5 class="sc-counter mt-3">{{$dailyOrders}}</h5>
                        </div>
                        <div class="progress progress-xs r-0">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="128"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <div class="counter-title">মাসিক বিক্রি</div>
                                <h5 class="sc-counter mt-3">{{$monthlySells}} </h5><span> টাকা</span>
                            </div>
                        
                            <div class="counter-title">মাসিক অর্ডার</div>
                            <h5 class="sc-counter mt-3">{{$monthlyOrders}}</h5>
                        </div>
                        <div class="progress progress-xs r-0">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="128"></div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-4">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <div class="counter-title">বার্ষিক বিক্রি</div>
                                <h5 class="sc-counter mt-3">{{$yearlySells}} </h5><span> টাকা </span>
                            </div>
                        
                            <div class="counter-title">বার্ষিক অর্ডার</div>
                            <h5 class="sc-counter mt-3">{{$yearlyOrders}}</h5>
                        </div>
                        <div class="progress progress-xs r-0">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="128"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   
        
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
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
    
        $(document).on('click','#notification_btn', function(e){
    
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
@endsection       