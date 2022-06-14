@extends('admin.master')
@section('title', 'Order Page')
<div style="background-color: grey ">
@section('content')
  <div class="container">
    {{--========================== start search box  =========================--}}
    <div class="row d-flex justify-content-center">
          <div class="col-md-10">
                <div class="card mb-5 mt-1" style="border-color:#b1b3b9 !important">
                  <div class="card-header">
                     <h3 class="card-title">Search Order</h3>
                  </div>
                       <div class="card-body">
                          <form action="{{ route('admin.search.order') }}" method="post" id="searchOrder">
                             <div class="row">
                                <div class=" col-6 form-group">
                                  <label>Order Number</label>
                                    <input type="text" name=""   class="form-control form-control-md text-black order_id" placeholder="" aria-describedby="helpId" onchange="searchOrder(this.value) " >
                                  </div>
                                  <div class=" col-6 form-group">
                                    <label>Mobile Number</label>
                                    <input type="text"  class="form-control form-control-md text-black mobile_number" placeholder="" aria-describedby="helpId" onchange="searchOrder(this.value) " >
                                  </div>
                                  <div class="col-6 form-group">
                                    <label>Order Date</label>
                                    <input type="date" class="form-control order_date"  onchange="searchOrder(this.value)">
                                    
                                  </div>
                                
                           
                             </div>
                          </form> 
                      </div>
                </div>
          </div>
   </div> 



  
    {{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between">
     

      <div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('delete'))
        <div class="alert alert-danger">
            {{ Session::get('delete') }}
        </div>
        @endif
      </div>
    </div>
    <div class="row my-5">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
               <h3 class="card-title">Order List</h3>
          </div>
          <div class="card-body bg-white">
            <table class="table text-center text-dark table-hover shadow-lg" id="order_table">
              <thead class="">
                <tr>
                  <td>Draft Number</td>
                  <td>Customer Name</td>
                  <td>Mobile Number</td>
                  <td>Total Bill</td>
                  <td>Date</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @isset($orders)
                   @foreach ($orders as $order)
                     
                      <tr id="tr_{{  $order->id }}">
                        
                         <td>{{ $order->id }}</td>
                         <td>{{ $order->customerName }}</td>
                         <input type="hidden" class="customerName_{{ $order->id }}" value="{{ $order->customerName }}">
                         <td>{{ $order->mobileNumber }}</td>
                         <input type="hidden" class="mobileNumber_{{ $order->id }}" value="{{ $order->mobileNumber }}">
                         <td>{{ $order->totalPrice }}</td>
                         <input type="hidden" class="totalPrice_{{ $order->id }}" value="{{ $order->totalPrice }}">
                         <td>{{ date('Y-m-d h:i:s A', strtotime( $order->created_at)) }} </td>
                         <input type="hidden" class="order_date_{{ $order->id }}" value="{{ date('Y-m-d h:i:s A', strtotime( $order->created_at)) }}">
                        
                         <td>
                          <a href="" onclick="viewOrder({{ $order->id }})" class="btn btn-sm btn-warning text-light  d-inline-block mb-1" data-toggle="modal" data-target="#viewOrder"><i class="fas fa-eye"></i></a>
                          {{--   <a  onclick="editOrder({{ $order->id }})" class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editOrder"><i class="far fa-edit"></i></a> --}}
  
                            <a  onclick="deleteOrder({{ $order->id }})" class="btn btn-sm btn-danger d-inline-block mb-1" data-toggle="modal" data-target="#deleteOrder"><i class="far  fa-trash-alt"></i></a>
                         </td>
                      </tr>
 
                   @endforeach
                @endisset
              </tbody>
         </table>
          </div>
        </div>
       {{ $orders->links() }}
      </div>
    </div>


     <!-- view Modal -->
     <div class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="viewOrder" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" style="max-width: 1100px !important">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">
                      Order Details
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="order-details" style="color: #000">
                          <h6>Order No: <span class="order_no"></span></h6>
                          <h6>Customer Name: <span class="customer_name"></span></h6>
                          <h6>Mobile Number: <span class="mobile_number"></span></h6>
                          <h6>Total Price : <span class="total_price"></span></h6>
                          <h6>Order Date: <span class="order_date"></span></h6>
                    </div>
                    <h3 class="text-success font-weight-bold">Order Items</h3>
                      <div class="table-responsive" id="">
                        <table class="table table-striped text-center text-black" style="color: #000" id="view_order">
                          <thead class="bg-info text-white">
                            <tr>
                              <th>Product Name</th>
                              <th>Sell Type</th>
                              <th>Quantity</th>
                              <th>Product Unit</th>
                              <th>Product Price</th>
                              <th>Per Unit Price</th>
                             
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                          <tfoot class="bg-info text-white">
                            <tr>
                              <th>Product Name</th>
                              <th>Sell Type</th>
                              <th>Quantity</th>
                              <th>Product Unit</th>
                              <th>Product Price</th>
                              <th>Per Unit Price</th>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                  </div>
                </div>
             
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div> 
  </div>

 

   
     <!--Edit Modal -->
     <div class="modal fade" id="editOrder" tabindex="-1" aria-labelledby="editOrder" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title " id="editOrder"></h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body  bg-secondary">
            <div class="row">
              <div class="col-8 offset-2 p-3">

                           <div class="card">
                             <div class="card-header">
                               <div class="card-title">
                                অর্ডার সংশোধন করুন
                               </div>
                             </div>
                                <div class="card-body">
                                      <form>
                                        <input type="hidden" class="order_id">
                                         <div class="form-group">
                                             <input type="text" class="form-control customer_name"> 
                                         </div>
                                         <div class="form-group">
                                              <input type="text" class="form-control mobile_number"> 
                                          </div>
                                          <div class="form-group">
                                              <input class="form-control total_price"> 
                                          </div>
                                          <div class="form-group">
                                              <button type="button" class="btn btn-info">Update</button>
                                          </div>

                                      </form>
                                </div>
                           </div>    
                        
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>

   



     <!--Delete Modal -->
     <div class="modal fade" id="deleteOrder" tabindex="-1" aria-labelledby="deleteOrder" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
             <h6 class="modal-title ">Delete Order</h6> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <h4 class="text-danger">Are You Sure ?</h4> 
                <form action="{{ route('admin.delete.order') }}" method="POST" id="delete_order_form">
                  
                  <input type="hidden" id="order_id">
                </form>
                        
                              
                        
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteConfirmBtn" >Delete</button>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src=" {{ asset('js/jquery-3.6.0.min.js') }}" ></script>
  <script>

           function searchOrder(value){
             
             var searchUrl =$('#searchOrder').attr('action');
             var searchMethod =$('#searchOrder').attr('method');
             
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });


              var formData = new FormData();
              formData.append('value', value);
             

              $.ajax({
                      url: searchUrl,
                      type:searchMethod,
                      data: formData,
                      dataType: 'json',
                      processData: false,
                      contentType:false,
                      success: function(data){
                      
                        $('#order_table').find('tbody').html('');
                        $('#order_table').find('tbody').append(data.table_data);

                      },
                      error: function(){

                      }
              });
           }

            //view the order
      function viewOrder(id){

              //get the order info from order table
              let customer_name = $('#order_table').find('.customerName_'+id).val();
              let mobile_name = $('#order_table').find('.mobileNumber_'+id).val();
              let total_price = $('#order_table').find('.totalPrice_'+id).val();
              let order_date = $('#order_table').find('.order_date_'+id).val();

              //assign the order info on order edit form
              $('#viewOrder').find('.order_no').text(id);
              $('#viewOrder').find('.customer_name').text(customer_name);
              $('#viewOrder').find('.mobile_number').text(mobile_name);
              $('#viewOrder').find('.total_price').text(total_price);
              $('#viewOrder').find('.order_date').text(order_date);

              $.ajax({
                url:'/admin/view/order/items/'+id,
                type: 'get',
                dataType:'json',
                success:function(data){

                  $('#view_order').find('tbody').html('');
                  $('#view_order').find('tbody').append(data);

                },
                error:function(data){

                }
              })

              }


              //edit the order
              function editOrder(id){

              //get the order info from order table
              let customer_name = $('#order_table').find('.customerName_'+id).val();
              let mobile_name = $('#order_table').find('.mobileNumber_'+id).val();
              let total_price = $('#order_table').find('.totalPrice_'+id).val();


              //assign the order info on order edit form
              $('#editOrder').find('.order_id').val(id);
              $('#editOrder').find('.customer_name').val(customer_name);
              $('#editOrder').find('.mobile_number').val(mobile_name);
              $('#editOrder').find('.total_price').val(total_price);

              }


              function  deleteOrder(id) { 

                      $('#delete_order_form').find('#order_id').val(id);


              }

              $('#deleteConfirmBtn').click(function(){

              var order_id =  $('#delete_order_form').find('#order_id').val();
              var formRoute = $('#delete_order_form').attr('action');
              var formMethod = $('#delete_order_form').attr('method');


              var formData = new FormData();
              formData.append('id', order_id);

              $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });

                    
                $.ajax({

                        url: formRoute,
                        type: formMethod,
                        data: formData,
                        dataType: 'json',
                        processData:false,
                        contentType: false,
                        success:function(data){
                            if(data == true){
                              $('#deleteOrder').find('h4').removeClass('text-danger');
                                $('#deleteOrder').find('h4').addClass('text-success');
                                $('#deleteOrder').find('h4').text('Delete Confirmed');

                                setTimeout(() => {
                                  $('#deleteOrder').find('h4').removeClass('text-success');
                                  $('#deleteOrder').find('h4').addClass('text-danger');
                                  $('#deleteOrder').find('h4').text('Are You Sure ?');
                                  $('#tr_'+order_id).remove();
                                  $('.modal').modal('hide');
                                }, 3000);
                            }
                        },
                        error: function(){

                        }
                    })
              })




  </script>


@endsection       
</div>