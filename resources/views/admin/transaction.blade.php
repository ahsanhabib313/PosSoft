@extends('admin.master')
@section('title', 'আর্থিক লেনদেন')
@push('styles')
    <style>
      @media (min-width: 576px)
        .modal-dialog {
            max-width: 576px;
           
        }
      @media (min-width: 992px)
        .modal-dialog {
            max-width: 992px;
           
        }
    </style>
@endpush

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-dark">আর্থিক লেনদেনের তালিকা</h3> 
      </div>
      <div>
        @if($errors->any())
          <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
          </div>

        @endif
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">লেনদেন যোগ করুন</button>

      </div>
     
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="engFont">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <h3 class="text-center py-2" id="exampleModalLabel">লেনদেন তৈরি করুন</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.transaction.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">আড়ৎদার </label>
                                                        <select name="merchant_id" class="form-control">
                                                              <option value="" selected>বাছাই করুন</option>
                                                              @isset($merchants)
                                                                    @foreach ($merchants as $merchant)
                                                                          <option value="{{ $merchant->id }}">{{ $merchant->name}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('merchant')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">লেনদেনের প্রকার</label>
                                                    <select name="transaction_type_id" class="form-control" onchange="getTranstype(this.value)">
                                                            <option value="" selected>বাছাই করুন</option>
                                                            @isset($transactionTypes)
                                                                    @foreach ($transactionTypes as $transactionType)
                                                                          <option value="{{ $transactionType->id }}">{{ $transactionType->name }}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                    </select>
                                                    @error('transactionType')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                           <div class="bank_section">
                                               <div class="form-group">
                                                      <label for="">ব্যাংক নাম</label>
                                                        <select name="bank_id" class="form-control">
                                                              <option value="" selected> বাছাই করুন</option>
                                                              @isset($banks)
                                                                    @foreach ($banks as $bank)
                                                                          <option value="{{ $bank->id }}">{{ $bank->name.' '.$bank->branch}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('bank_name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                           </div>
                                               <div class="form-group">
                                                    <label for="amount">টাকার পরিমান</label>
                                                    <input class="form-control" name="amount" id="amount">
                                                    @error('amount')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                               <div class="form-group">
                                                    <label for="">লেনদেনের রসিদ</label>
                                                    <input type="file" class="form-control engFont" name="photo" accept="image/*">
                                                    @error('photo')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                  <label for=""> তারিখ</label>
                                                  <input type="date" class="form-control engFont" name="date">
                                                  @error('date')
                                                    <p class="text-danger">{{ $message }}</p>
                                                  @enderror
                                             </div>
                                           </div>
                                        </div>
                                            <div class="form-row">
                                              <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success"> সংরক্ষন করুন
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
                 <td>সিরিয়াল নং.</td>
                 <td>বণিক</td>
                 <td>লেনদেনের প্রকার</td>
                 <td>ব্যাংক</td>
                 <td>টাকার পরিমান</td>
                 <td>লেনদেনের রশিদ</td>
                 <td>তারিখ</td>
                 <td>কার্যক্রম</td>
               </tr>
             </thead>
             <tbody>
               @isset($transactions)
                        @foreach ($transactions as $transaction)
                        <tr>
                            <input type="hidden" class="merchant_{{ $transaction->id }}" value="{{$transaction->merchant_id}}">
                            <input type="hidden" class="transactionType_{{ $transaction->id }}" value="{{$transaction->transaction_type_id}}">
                            <input type="hidden" class="bank_{{ $transaction->id }}" value="{{$transaction->bank_id}}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $transaction->merchant_id ? $transaction->merchant->name : ''}}</td>
                            <td >{{$transaction->transaction_type_id ? $transaction->transactionType->name : ''}}</td>
                            <td >{{$transaction->bank_id ? $transaction->bank->name : ' '}}</td>
                            <td class="amount_{{ $transaction->id }}">{{($transaction->amount)}}</td>
                            <td><img height="50" width="50" src="{{ asset('/img/transaction/'.$transaction->photo)}}" alt=""></td>
                            <td class="date_{{ $transaction->id }}">{{$transaction->date}}</td>
                            <td>
                              <button class="btn btn-sm btn-success d-inline-block mb-1" data-toggle="modal" data-target="#viewInvoiceModal"  onclick="viewInvoiceFunction('{{$transaction->photo}}')">রশিদ দেখুন</button>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$transaction->id}})">সংস্করণ</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$transaction->id}})">বাতিল</button>
                            </td>
                        </tr>
                    @endforeach
               @endisset
             </tbody>
        </table>
      </div>
    </div>

      <!--view invoice  Modal -->
      <div class="modal fade" id="viewInvoiceModal" tabindex="-1" aria-labelledby="viewInvoiceModal" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="engFont">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div>
                    <img class="invoiceImg"  style="width: 100vw; height:100vh" >
               </div>
            </div>
          </div>
        </div>
      </div>
  
 
     <!--Edit Modal -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <h4 class="header-title text-light">
              লেনদেন সংস্করণ
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
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
                                         <label for="">আড়ৎদার</label>
                                           <select name="merchant_id" class="form-control">
                                                
                                                 @isset($merchants)
                                                       @foreach ($merchants as $merchant)
                                                             <option value="{{ $merchant->id }}">{{ $merchant->name}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('merchant')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                  <div class="form-group">
                                       <label for="">লেনদেনের প্রকার</label> 
                                       <select name="transaction_type_id" class="form-control" onchange="getTranstype(this.value)">
                                                <option value="">বাছাই করুন</option>
                                               @isset($transactionTypes)
                                                       @foreach ($transactionTypes as $transactionType)
                                                             <option value="{{ $transactionType->id }}">{{ $transactionType->name }}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                       </select>
                                       @error('transactionType')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                  </div>
                            
                                  <div class="form-group bank-group">
                                         <label for="">ব্যাংক</label>
                                           <select name="bank_id" class="form-control">
                                                <option value="">বাছাই করুন</option>
                                                 @isset($banks)
                                                       @foreach ($banks as $bank)
                                                             <option value="{{ $bank->id }}">{{ $bank->name.' '.$bank->branch}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('bank_name')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                  <div class="form-group">
                                       <label for="amount">টাকার পরিমান</label>
                                       <input class="form-control" name="amount" id="amount">
                                       @error('amount')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                  </div>
                                  <div class="form-group">
                                       <label for="">লেনদেনের রশিদ</label>
                                       <input type="file" class="form-control engFont" name="photo" accept="image/*">
                                       @error('photo')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                    <div class="form-group">
                                      <label for="">লেনদেনের তারিখ</label>
                                      <input type="date" class="form-control trans_date" name="date" >
                                      @error('trans_date')
                                        <p class="text-danger">{{ $message }}</p>
                                      @enderror
                                    </div>
                              </div>
                           </div>
                               <div class="form-row">
                                  <div class="col-md-5 offset-1 ">
                                     <button type="submit" class="text-center btn btn-success">হালনাগাদ করুন
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
            <h5 class="modal-title " id="">লেনদেন বাতিল</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">আপনি কি নিশ্চিত...? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.transaction.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                  </div>
                </div> 
                <div class="modal-footer">
                  <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
                    <button type="submit" class="btn btn-danger">হ্যা</button>
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
      $('.bank_section').fadeOut();
      
      function getTranstype(value){
       if(value == 1){
          $('.bank_section').fadeIn();
          $('#editModal').find('.bank-group').fadeIn();
       }else{
          $('.bank_section').fadeOut();
          $('#editModal').find('.bank-group').fadeOut();
       }
      }

      /*** employee payment edit section *****/
      function editFunction(id){
        
        let merchant = $('#transaction_table').find('.merchant_'+id).val(); 
        let transactionType = $('#transaction_table').find('.transactionType_'+id).val(); 
        let bank = $('#transaction_table').find('.bank_'+id).val(); 
        let amount = $('#transaction_table').find('.amount_'+id).text(); 
        let date = $('#transaction_table').find('.date_'+id).text(); 

         //if bank is empty then hide the bank input from edit modal
         if(bank == ''){
              $('#editModal').find('.bank-group').hide();
         }
        //set the value in id input
         $('#editModal').find('input[name="id"]').val(id); 

         // unselected all the options of merchant
       /*    $('#editModal select[name="merchant_id"]').find('option').each(function(){
                if($(this).val() == )
                    

                  }); */

         //selected the correct employee name options
         $('#editModal select[name="merchant_id"]').find('option').each(function(){
           if( $(this).val() == merchant){
            $(this).prop('selected', true);
           }else{
            $(this).prop('selected', false);
           }
         });

         // unselected all the options of transactiontype
          $('#editModal select[name="transaction_type_id"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct employee name options
         $('#editModal select[name="transaction_type_id"]').find('option').each(function(){
           if( $(this).val() == transactionType){
            $(this).prop('selected', true);
           }
         });

         // unselected all the options of bank
          $('#editModal select[name="bank_id"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });
 
         //selected the correct bank name options
         $('#editModal select[name="bank_id"]').find('option').each(function(){
           if( $(this).val() == bank){
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


         /***** view invoice modal ******/
         function viewInvoiceFunction(photo){
        $('#viewInvoiceModal').find('.invoiceImg').attr('src','http://127.0.0.1:8000/img/transaction/'+photo);
      }

  </script>

@endsection   

    