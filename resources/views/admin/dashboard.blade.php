@extends('admin.master')
@section('title', 'Dashboard')
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
                                <div class="counter-title">Today's Sell</div>
                                <h5 class="sc-counter mt-3">{{$dailySells}} </h5><span> TK</span>
                            </div>
                            <div class="counter-title">Today's Orders</div>
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
                                <div class="counter-title">Monthly Sell</div>
                                <h5 class="sc-counter mt-3">{{$monthlySells}} </h5><span> TK</span>
                            </div>
                        
                            <div class="counter-title">Monthly Orders</div>
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
                                <div class="counter-title"> Yearly Sell</div>
                                <h5 class="sc-counter mt-3">{{$yearlySells}} </h5><span> TK</span>
                            </div>
                        
                            <div class="counter-title">Yearly Orders</div>
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

@endsection       