@extends('admin.master')
@section('title', 'কর্মচারীর বেতন')
@push('styles')
  <style>
     svg.h-5{
            height:20px !important;
        }
        nav > span {
            display:none !important;
        }
        nav  p{
          display: none;
        }
        nav > div.flex{
            display:none;
        }
  </style>
@endpush

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <a href="{{route('admin.employee.payment')}}"><h4 class="text-dark font-weight-bold ml-3">কর্মচারীর বেতনের তালিকা</h4></a> 
      </div>
      <div>
        @if($errors->any())
        <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">কর্মচারীর বেতন যোগ করুন</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">কর্মচারীর বেতন তৈরি করুন</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.employee.payment.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">কর্মচারী</label>
                                                        <select name="employee_id" class="form-control">
                                                              <option value="" selected>বাছাই করুন</option>
                                                              @isset($employees)
                                                                    @foreach ($employees as $employee)
                                                                          <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('employee_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               
                                               <div class="form-group">
                                                    <label for=""> মাসের নাম</label>
                                                    <select name="payment_month" class="form-control">
                                                            <option value="" selected>বাছাই করুন</option>
                                                            <option value="বৈশাখ">বৈশাখ</option>
                                                            <option value="জৈষ্ঠ্য">জৈষ্ঠ্য</option>
                                                            <option value="আষাঢ়">আষাঢ়</option>
                                                            <option value="শ্রাবণ">শ্রাবণ</option>
                                                            <option value="ভাদ্র">ভাদ্র</option>
                                                            <option value="আশ্বিন">আশ্বিন</option>
                                                            <option value="কার্তিক">কার্তিক</option>
                                                            <option value="অগ্রহায়ণ">অগ্রহায়ণ</option>
                                                            <option value="পৌষ">পৌষ</option>
                                                            <option value="মাঘ">মাঘ</option>
                                                            <option value="ফাল্গুণ">ফাল্গুণ</option>
                                                            <option value="চৈত্র">চৈত্র</option>
                                                    </select>
                                                    @error('payment_month')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                               <div class="form-group">
                                                    <label for="">সাল</label>
                                                    <select name="payment_year" class="form-control">
                                                            <option value="" selected>বাছাই করুন</option>
                                                            <option value="১৪২৮">১৪২৮</option>
                                                            <option value="১৪২৯">১৪২৯</option>
                                                            <option value="১৪৩০">১৪৩০</option>
                                                            <option value="১৪৩১">১৪৩১</option>
                                                            <option value="১৪৩২">১৪৩২</option>
                                                            <option value="১৪৩৩">১৪৩৩</option>
                                                            <option value="১৪৩৪">১৪৩৪</option>
                                                            <option value="১৪৩৫">১৪৩৫</option>
                                                            <option value="১৪৩৬">১৪৩৬</option>
                                                            <option value="১৪৩৭">১৪৩৭</option>
                                                            <option value="১৪৩৮">১৪৩৮</option>
                                                            <option value="১৪৩৯">১৪৩৯</option>
                                                            <option value="১৪৪০">১৪৪০</option>
                                                    </select>
                                                    @error('payment_year')
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
                                                  <label for="">বেতনের তারিখ</label>
                                                  <input type="date" class="form-control engFont" name="payment_date">
                                                  @error('payment_date')
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
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                    <h4 class="card-title font-weight-bold">কর্মচারীর বেতন দেখুন</h4>
            </div>
            <div class="card-body">
                 <form action="{{route('admin.employee.payment.search')}}" id="searchForm" method="POST">
                  @csrf    
                  <div class="form-group">
                             <label for="name">কর্মচারীর নাম</label>
                             <select id="name" class="form-control" name="employee_id">
                                    <option value="">বাছাই করুন</option>
                                    @isset($employees)
                                    @foreach ($employees as $employee)
                                          <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                    @endforeach
                              @endisset
                             </select>
                       </div>
                       <div class="form-group">
                          <button type="submit" class="btn btn-info" >খোঁজ করুন</button>
                       </div>
                 </form>
            </div>
        </div>
  </div>
    </div>
    <div class="row my-5">
      <div class="col-md-12">
        <table class="table table-light text-dark font-weight-bold table-hover text-center" id="employee_payment_table">
             <thead>
               <tr>
                 <td>সিরিয়াল নং.</td>
                 <td>কর্মচারী</td>
                 <td>মাস</td>
                 <td>সাল</td>
                 <td>বেতনের রশিদ</td>
                 <td> তারিখ</td>
                 <td>কার্যক্রম</td>
               </tr>
             </thead>
             <tbody>
               @isset($employees_payment)
                        @foreach ($employees_payment as $employee_payment)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{($employee_payment->employee->name) }}
                              <input type='hidden' class='employee_id_{{ $employee_payment->id }}' value="{{ $employee_payment->employee_id }}">
                            </td>
                            <td class="payment_month_{{ $employee_payment->id }}">{{ $employee_payment->payment_month }}</td>

                            <td class="payment_year_{{ $employee_payment->id }}">{{ $employee_payment->payment_year }}</td>

                            <td class="photo_{{ $employee_payment->id }}"><img height="50" width="50" src="{{ asset('/img/employeePayment/'.$employee_payment->photo)}}" alt=""></td>
                            
                            <td class="payment_date_{{ $employee_payment->id }}">{{  $employee_payment->payment_date   }}</td>

                            <td>
                              <button class="btn btn-sm btn-success d-inline-block mb-1" data-toggle="modal" data-target="#viewInvoiceModal"  onclick="viewInvoiceFunction('{{$employee_payment->photo}}')">রশিদ দেখুন</button>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$employee_payment->id}})">সংস্করণ</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$employee_payment->id}})">বাতিল</button>
                            </td>
                        </tr>
                    @endforeach
               @endisset
             </tbody>
        </table>
        <p style=" font-family: SutonnyMJ;">{{$employees_payment->links()}}</p>
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
              কর্মচারীর বেতন সংস্করণ
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
                          <form action="{{ route('admin.employee.payment.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input name="id" type="hidden">
                            <div class="form-row">
                              <div class="col-md-8 offset-1">
                                  <div class="form-group">
                                         <label for="">কর্মচারী</label>
                                           <select name="employee_id" class="form-control">
                                                 <option value="" selected>বাছাই করুন</option>
                                                 @isset($employees)
                                                       @foreach ($employees as $employee)
                                                             <option value="{{ $employee->id }}">{{ $employee->name}}</option>
                                                       @endforeach
                                                 @endisset
                                               
                                           </select>
                                         @error('employee_id')
                                           <p class="text-danger">{{ $message }}</p>
                                         @enderror
                                  </div>
                                  
                                  <div class="form-group">
                                       <label for="">মাস</label>
                                       <select name="payment_month" class="form-control">
                                              <option value="" selected>বাছাই করুন</option>
                                              <option value="বৈশাখ">বৈশাখ</option>
                                              <option value="জৈষ্ঠ্য">জৈষ্ঠ্য</option>
                                              <option value="আষাঢ়">আষাঢ়</option>
                                              <option value="শ্রাবণ">শ্রাবণ</option>
                                              <option value="ভাদ্র">ভাদ্র</option>
                                              <option value="আশ্বিন">আশ্বিন</option>
                                              <option value="কার্তিক">কার্তিক</option>
                                              <option value="অগ্রহায়ণ">অগ্রহায়ণ</option>
                                              <option value="পৌষ">পৌষ</option>
                                              <option value="মাঘ">মাঘ</option>
                                              <option value="ফাল্গুণ">ফাল্গুণ</option>
                                              <option value="চৈত্র">চৈত্র</option>
                                       </select>
                                       @error('payment_month')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                              </div>
                                  <div class="form-group">
                                       <label for="">সাল</label>
                                       <select name="payment_year" class="form-control">
                                              <option value="" selected>বাছাই করুন</option>
                                              <option value="১৪২৮">১৪২৮</option>
                                              <option value="১৪২৯">১৪২৯</option>
                                              <option value="১৪৩০">১৪৩০</option>
                                              <option value="১৪৩১">১৪৩১</option>
                                              <option value="১৪৩২">১৪৩২</option>
                                              <option value="১৪৩৩">১৪৩৩</option>
                                              <option value="১৪৩৪">১৪৩৪</option>
                                              <option value="১৪৩৫">১৪৩৫</option>
                                              <option value="১৪৩৬">১৪৩৬</option>
                                              <option value="১৪৩৭">১৪৩৭</option>
                                              <option value="১৪৩৮">১৪৩৮</option>
                                              <option value="১৪৩৯">১৪৩৯</option>
                                              <option value="১৪৪০">১৪৪০</option>
                                       </select>
                                       @error('payment_year')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                              </div>
                                  <div class="form-group">
                                       <label for="">বেতনের রশিদ</label>
                                       <input type="file" class="form-control engFont" name="photo" accept="image/*">
                                       @error('photo')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="form-group">
                                     <label for="">তারিখ</label>
                                     <input type="date" class="form-control engFont" name="payment_date">
                                     @error('payment_date')
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
            <h5 class="modal-title " id="">বেতন বাতিল করুন</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">আপনি কি নিশ্চিত...? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.employee.payment.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
                    <button type="submit" class="btn btn-danger">হ্যা</button>
               </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
     

      /*** employee payment edit section *****/
      function editFunction(id){
        
        let employee_id = $('#employee_payment_table').find('.employee_id_'+id).val();
        let payment_month = $('#employee_payment_table').find('.payment_month_'+id).text();
        let payment_year = $('#employee_payment_table').find('.payment_year_'+id).text();
        payment_year = (payment_year);

        let payment_date = $('#employee_payment_table').find('.payment_date_'+id).text();
         
        //set the value in id input
         $('#editModal').find('input[name="id"]').val(id); 

        //set the value in date input
         $('#editModal').find('input[name="payment_date"]').val(payment_date); 

         //select the employee  name 
         // unselected all the options of employee name
          $('#editModal select[name="employee_id"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct employee name options
         $('#editModal select[name="employee_id"]').find('option').each(function(){
           if( $(this).val() == employee_id){
            $(this).prop('selected', true);
           }
         });

         //select the payment month
         // unselected all the options of payment month
          $('#editModal select[name="payment_month"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct designation options
         $('#editModal select[name="payment_month"]').find('option').each(function(){
           if( $(this).val() == payment_month){
            $(this).prop('selected', true);
           }
         });

         //select the payment year
         // unselected all the options of payment year
          $('#editModal select[name="payment_year"]').find('option').each(function(){
                      $(this).prop('selected', false);

                  });

         //selected the correct designation options
         $('#editModal select[name="payment_year"]').find('option').each(function(){
           if( $(this).val() == payment_year){
            $(this).prop('selected', true);
           }
         });

         

       
      }


       /*** end employee profile edit section *****/

      /***start employee profile delete section *****/
      function deleteFunction(id){
        
        //set the id value in delete form
        $('#deleteForm').find('input[name="id"]').val(id);

      }


      /***** view invoice modal ******/
      function viewInvoiceFunction(photo){
        $('#viewInvoiceModal').find('.invoiceImg').attr('src','http://127.0.0.1:8000/img/employeePayment/'+photo);
      }

  </script>

@endsection   

    