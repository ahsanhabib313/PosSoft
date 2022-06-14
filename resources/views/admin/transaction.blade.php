@extends('admin.master')
@section('title', 'Employee Payment')

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-white">All Transaction List</h3> 
      </div>
      <div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif
       
      </div>
      <div>
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">Add Transaction</button>

      </div>
     
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <h3 class="text-center py-2" id="exampleModalLabel">Create Transaction</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.transaction.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">Merchant Name</label>
                                                        <select name="merchant" class="form-control">
                                                              <option value="" selected>Select Merchant</option>
                                                              @isset($merchants)
                                                                    @foreach ($merchants as $merchant)
                                                                          <option value="{{ $merchant->name }}">{{ $merchant->name}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('merchant')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Transaction Type</label>
                                                    <select name="transactionType" class="form-control" onchange="getTransFunction(this.value)">
                                                            <option value="" selected>Select Transaction Type</option>
                                                            @isset($transactionTypes)
                                                                    @foreach ($transactionTypes as $transactionType)
                                                                          <option value="{{ $transactionType->name }}">{{ $transactionType->name }}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                    </select>
                                                    @error('transactionType')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                           <div class="bank_section">
                                               <div class="form-group">
                                                      <label for="">Bank Name</label>
                                                        <select name="bank" class="form-control">
                                                              <option value="" selected>Select Bank</option>
                                                              @isset($banks)
                                                                    @foreach ($banks as $bank)
                                                                          <option value="{{ $bank->name }}">{{ $bank->name}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('bank_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">
                                                      <label for="">Bank Branch</label>
                                                        <select name="branch" class="form-control">
                                                              <option value="" selected>Select Bank Branch</option>
                                                              @isset($banks)
                                                                    @foreach ($banks as $bank)
                                                                          <option value="{{ $bank->branch }}">{{ $bank->branch}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('branch')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                              </div>
                                               
                                               
                                               <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input class="form-control" name="amount" id="amount">
                                                    @error('amount')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                               <div class="form-group">
                                                    <label for="">Transaction Evidence</label>
                                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                                    @error('photo')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                  <label for=""> Date</label>
                                                  <input type="date" class="form-control" name="date">
                                                  @error('date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                             </div>
                                           </div>
                                        </div>
                                            <div class="form-row">
                                              <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">Save
                                                  </button>
                                                </div>
                                              </div>
                                      </form>
                                    </div>
                                 </div>
                            </div>
                      </div>
            </div>
          </div>
        </div>
     
    </div>
    <div class="row my-5">
      <div class="col-md-12">
        <table class="table table-light text-dark font-weight-bold table-hover text-center" id="transaction_table">
             <thead>
               <tr>
                 <td>Seril No.</td>
                 <td>Merchant</td>
                 <td>Transaction Type</td>
                 <td>Bank</td>
                 <td>Branch</td>
                 <td>Amount</td>
                 <td>Transaction Evidence</td>
                 <td>Date</td>
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($transactions)
                        @foreach ($transactions as $transaction)
                        <tr>
                       

                            <td>{{ $loop->index + 1 }}</td>

                            <td class="merchant_{{ $transaction->id }}">{{ucfirst($transaction->merchant)}}</td>
                            <td class="transactionType_{{ $transaction->id }}">{{ucfirst($transaction->transactionType)}}</td>
                            <td class="bank_{{ $transaction->id }}">{{ucfirst($transaction->bank)}}</td>
                            <td class="branch_{{ $transaction->id }}">{{ucfirst($transaction->branch)}}</td>
                            <td class="amount_{{ $transaction->id }}">{{ucfirst($transaction->amount)}}</td>
                            <td><img height="50" width="50" src="{{ asset('/img/transaction/'.$transaction->photo)}}" alt=""></td>
                            <td class="date_{{ $transaction->id }}">{{$transaction->date}}</td>
                            <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$transaction->id}})">Edit</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$transaction->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
               @endisset
             </tbody>
        </table>
      </div>
    </div>
 
     <!--Edit Modal -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h4 class="header-title text-light">
              Edit Transaction
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row d-flex justify-content-center">
              <div class="col-10">
                    <div class="card">
                       <div class="card-body bg-light">
                          <form action="{{ route('admin.transaction.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id">
                            <div class="form-row">
                              <div class="col-md-8 offset-1">
                                  <div class="form-group">
                                         <label for="">Merchant Name</label>
                                           <select name="merchant" class="form-control">
                                                
                                                 @isset($merchants)
                                                       @foreach ($merchants as $merchant)
                                                             <option value="{{ $merchant->name }}">{{ $merchant->name}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('merchant')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                  <div class="form-group">
                                       <label for="">Transaction Type</label>
                                       <select name="transactionType" class="form-control" onchange="getTransFunction(this.value)">
                                              
                                               @isset($transactionTypes)
                                                       @foreach ($transactionTypes as $transactionType)
                                                             <option value="{{ $transactionType->name }}">{{ $transactionType->name }}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                       </select>
                                       @error('transactionType')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                  </div>
                            
                                  <div class="form-group">
                                         <label for="">Bank Name</label>
                                           <select name="bank" class="form-control">
                                                <option value=""></option>
                                                 @isset($banks)
                                                       @foreach ($banks as $bank)
                                                             <option value="{{ $bank->name }}">{{ $bank->name}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('bank_name')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                  <div class="form-group">
                                         <label for="">Bank Branch</label>
                                           <select name="branch" class="form-control">
                                            <option value=""></option>
                                                 @isset($banks)
                                                       @foreach ($banks as $bank)
                                                             <option value="{{ $bank->branch }}">{{ $bank->branch}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('branch')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                
                                  
                                  
                                  <div class="form-group">
                                       <label for="amount">Amount</label>
                                       <input class="form-control" name="amount" id="amount">
                                       @error('amount')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                  </div>
                                  <div class="form-group">
                                       <label for="">Transaction Evidence</label>
                                       <input type="file" class="form-control" name="photo" accept="image/*">
                                       @error('photo')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                    <div class="form-group">
                                      <label for="">Transaction Date</label>
                                      <input type="date" class="form-control trans_date" name="date" >
                                      @error('trans_date')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                    </div>
                              </div>
                           </div>
                               <div class="form-row">
                                  <div class="col-md-5 offset-1 ">
                                     <button type="submit" class="text-center btn btn-success">Update
                                     </button>
                                   </div>
                                 </div>
                          </form>

                       </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




     <!--Delete Modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="">Delete Transaction</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">Are you want to permanently delete the transaction...? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.transaction.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </div>
                 
               </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>

      //initially hide the bank section
      $('.bank_section').css('display', 'none');
      
      function getTransFunction(value){
       if(value.toLowerCase() == 'bank'){
          $('.bank_section').css('display', 'block');
       }else{
          $('.bank_section').css('display', 'none');
       }
      }

      /*** employee payment edit section *****/
      function editFunction(id){
        
        let merchant = $('#transaction_table').find('.merchant_'+id).text(); 
        let transactionType = $('#transaction_table').find('.transactionType_'+id).text(); 
        console.log(transactionType)
        let bank = $('#transaction_table').find('.bank_'+id).text(); 
        let branch = $('#transaction_table').find('.branch_'+id).text(); 
        let amount = $('#transaction_table').find('.amount_'+id).text(); 
        let date = $('#transaction_table').find('.date_'+id).text(); 

         
        //set the value in id input
         $('#editModal').find('input[name="id"]').val(id); 

         // unselected all the options of merchant
          $('#editModal select[name="merchant"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct employee name options
         $('#editModal select[name="merchant"]').find('option').each(function(){
           if( $(this).val().toLowerCase() == merchant.toLowerCase()){
            $(this).prop('selected', true);
           }
         });

         // unselected all the options of transactiontype
          $('#editModal select[name="transactionType"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct employee name options
         $('#editModal select[name="transactionType"]').find('option').each(function(){
           if( $(this).val().toLowerCase() == transactionType.toLowerCase()){
            $(this).prop('selected', true);
           }
         });

         // unselected all the options of bank
          $('#editModal select[name="bank"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct bank name options
         $('#editModal select[name="bank"]').find('option').each(function(){
           if( $(this).val().toLowerCase() == bank.toLowerCase()){
            $(this).prop('selected', true);
           }
         });

         // unselected all the options of bank
          $('#editModal select[name="branch"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct bank name options
         $('#editModal select[name="branch"]').find('option').each(function(){
           if( $(this).val().toLowerCase() == branch.toLowerCase()){
            $(this).prop('selected', true);
           }
         });


         //set the amount set
         $('#editModal').find('input[name="amount"]').val(amount);

         //set the amount set
         $('#editModal').find('input[name="date"]').val(date);

         

       
      }


       /*** end employee profile edit section *****/

      /***start employee profile delete section *****/
      function deleteFunction(id){
        
        //set the id value in delete form
        $('#deleteForm').find('input[name="id"]').val(id);

      }

  </script>

@endsection   

    