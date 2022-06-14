@extends('admin.master')
@section('title', 'Employee Payment')

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-white">Employee Payment List</h3> 
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">Add Employee Payment</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">Craete Employee Payment</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.employee.payment.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">Employee</label>
                                                        <select name="employee_id" class="form-control">
                                                              <option value="" selected>Select Employee</option>
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
                                                    <label for="">Payment Month</label>
                                                    <select name="payment_month" class="form-control">
                                                            <option value="" selected>Select Payment Month</option>
                                                            <option value="January">January</option>
                                                            <option value="February">February</option>
                                                            <option value="March">March</option>
                                                            <option value="April">April</option>
                                                            <option value="May">May</option>
                                                            <option value="June">June</option>
                                                            <option value="July">July</option>
                                                            <option value="August">August</option>
                                                            <option value="September">September</option>
                                                            <option value="October">October</option>
                                                            <option value="November">November</option>
                                                            <option value="December">December</option>
                                                    </select>
                                                    @error('payment_month')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                               <div class="form-group">
                                                    <label for="">Payment Year</label>
                                                    <select name="payment_year" class="form-control">
                                                            <option value="" selected>Select Payment Year</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                          
                                                           
                                                    </select>
                                                    @error('payment_year')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                           </div>
                                               <div class="form-group">
                                                    <label for="">Payment Evidence</label>
                                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                                    @error('photo')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                  <label for="">Payment Date</label>
                                                  <input type="date" class="form-control" name="payment_date">
                                                  @error('payment_date')
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
        <table class="table table-light text-dark font-weight-bold table-hover text-center" id="employee_payment_table">
             <thead>
               <tr>
                 <td>Seril No.</td>
                 <td>Employee</td>
                 <td>Payment Month</td>
                 <td>Payment Year</td>
                 <td>Payment Evidence</td>
                 <td>Payment Date</td>
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($employees_payment)
                        @foreach ($employees_payment as $employee_payment)
                        <tr>
                        {{--   <input type="hidden" class="employee_payment_id_{{ $employee_payment->id }}" value="{{ $employee_payment->id }}"> --}}

                            <td>{{ $loop->index + 1 }}</td>

                            <td>{{ ucfirst         ($employee_payment->employee->name) }}
                              <input type='hidden' class='employee_id_{{ $employee_payment->id }}' value="{{ $employee_payment->employee_id }}">
                            
                            </td>
                          
                            <td class="payment_month_{{ $employee_payment->id }}">{{ $employee_payment->payment_month }}</td>

                            <td class="payment_year_{{ $employee_payment->id }}">{{ $employee_payment->payment_year }}</td>

                            <td class="photo_{{ $employee_payment->id }}"><img height="50" width="50" src="{{ asset('/img/employeePayment/'.$employee_payment->photo)}}" alt=""></td>
                            
                            <td class="payment_date_{{ $employee_payment->id }}">{{  $employee_payment->payment_date   }}</td>

                            <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$employee_payment->id}})">Edit</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$employee_payment->id}})">Delete</button>
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
              Edit Employee Payment
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
                          <form action="{{ route('admin.employee.payment.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input name="id" type="hidden">
                            <div class="form-row">
                              <div class="col-md-8 offset-1">
                                  <div class="form-group">
                                         <label for="">Employee</label>
                                           <select name="employee_id" class="form-control">
                                                 <option value="" selected>Select Employee</option>
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
                                       <label for="">Payment Month</label>
                                       <select name="payment_month" class="form-control">
                                              
                                               <option value="January">January</option>
                                               <option value="February">February</option>
                                               <option value="March">March</option>
                                               <option value="April">April</option>
                                               <option value="May">May</option>
                                               <option value="June">June</option>
                                               <option value="July">July</option>
                                               <option value="August">August</option>
                                               <option value="September">September</option>
                                               <option value="October">October</option>
                                               <option value="November">November</option>
                                               <option value="December">December</option>
                                       </select>
                                       @error('payment_month')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                              </div>
                                  <div class="form-group">
                                       <label for="">Payment Year</label>
                                       <select name="payment_year" class="form-control">
                                             
                                                             <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                             
                                              
                                       </select>
                                       @error('payment_year')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                              </div>
                                  <div class="form-group">
                                       <label for="">Payment Evidence</label>
                                       <input type="file" class="form-control" name="photo" accept="image/*">
                                       @error('photo')
                                         <p class="text-danger">{{ $message }}</p>
                                       @enderror
                                   </div>
                                   <div class="form-group">
                                     <label for="">Payment Date</label>
                                     <input type="date" class="form-control" name="payment_date">
                                     @error('payment_date')
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
            <h5 class="modal-title " id="">Delete Employee Payment</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">Are you want to permanently delete the Employee Payment...? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.employee.payment.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
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
        payment_year = parseInt(payment_year);

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

  </script>

@endsection   

    