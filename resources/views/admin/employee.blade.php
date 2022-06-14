@extends('admin.master')
@section('title', 'Employee')

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-white">All Employee List</h3> 
      </div>
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
      <div>
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">Add Employee</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">Craete Employee Profile</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">Name</label>
                                                      <input type="text" class="form-control" name="name">
                                                      @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">

                                                      <label for="">Designation</label>
                                                        <select name="designation_id" class="form-control">
                                                              <option selected>Select Designation</option>
                                                              @isset($designations)
                                                                    @foreach ($designations as $designation)
                                                                          <option value="{{ $designation->id }}">{{ $designation->name}}</option>
                                                                    @endforeach
                                                              @endisset
                                                            
                                                        </select>
                                                      @error('designation_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Photo</label>
                                                    <input type="file" class="form-control" name="photo" accept="image/*">
                                                    @error('photo')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                               <div class="form-group">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" class="form-control" name="phone">
                                                    @error('phone')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">National ID Number</label>
                                                    <input type="text" class="form-control" name="nid">
                                                    @error('nid')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Salary</label>
                                                    <input type="text" class="form-control" name="salary">
                                                    @error('salary')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select name="gender" class="form-control">
                                                            <option value="" selected>Select Gender</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                    </select>
                                                    @error('gender')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="address" id=""  class="form-control"></textarea>
                                                    @error('address')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Joining Date</label>
                                                    <input type="date" class="form-control" name="joining_date" id="joining_date">
                                                    @error('joining_date')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">Is Leave...?</label>
                                                    <select name="is_leave" id="is_leave" class="form-control" onchange="leavingEmployee(this.value)">
                                                       
                                                        <option value="yes" >Yes</option>
                                                        <option value="no" selected>No</option>
                                                    </select>
                                                    @error('is_leave')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group leaving_date_group">
                                                    <label for="">Leaving Date</label>
                                                    <input type="date" class="form-control" name="leaving_date" id="leaving-date">
                                                    @error('leaving_date')
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
                
              <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
     
    </div>
    <div class="row my-5">
      <div class="col-md-12">
        <table class="table table-light text-dark font-weight-bold table-hover text-center" id="employee_table">
             <thead>
               <tr>
                 <td>Seril No.</td>
                 <td>Name</td>
                 <td>Designation</td>
                 <td>Phone</td>
                 <td>National ID</td>
                 <td>Salary</td>
                 <td>Gender</td>
                 <td>Photo</td>
                 <td>Address</td>
                 <td>Joining Date</td>
                 <td>Is Leave</td>
                 <td>Leaving Date</td>
                
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($employees)
                        @foreach ($employees as $employee)
                        <tr>
                          <input type="hidden" class="employee_id_{{ $employee->id }}" value="{{ $employee->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="name_{{ $employee->id }}">{{ ucfirst($employee->name) }}</td>
                            <td>{{ $employee->designation->name }}</td>
                            <input type='hidden' class='designation_{{ $employee->id }}' value="{{ $employee->designation_id }}">
                            <td class="phone_{{ $employee->id }}">{{ $employee->phone }}</td>
                            <td class="nid_{{ $employee->id }}">{{ $employee->nid }}</td>
                            <td class="salary_{{ $employee->id }}">{{ $employee->salary }}</td>
                            <td>{{ ucfirst($employee->gender) }}</td>
                            <input type="hidden" class="gender_{{ $employee->id }}" value="{{($employee->gender)}}">
                            <td class="photo_{{ $employee->id }}"><img height="50" width="50" src="{{ asset('/img/employees/'.$employee->photo)}}" alt=""></td>
                            <td class="address_{{ $employee->id }}">{{ $employee->address }}</td>
                            <td class="joining_date_{{ $employee->id }}">{{ $employee->joining_date }}</td>
                           <td>{{ ucfirst($employee->is_leave) }}</td> 
                            <input type="hidden" class="is_leave_{{ $employee->id }}" value="{{ $employee->is_leave }}">
                            <td class="leaving_date_{{ $employee->id }}">{{ $employee->leaving_date   }}</td>
                            <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$employee->id}})">Edit</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$employee->id}})">Delete</button>
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
              Edit Employee
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
                          <form action="{{ route('admin.employee.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input name="employee_id" type="hidden">
                            <div class="form-row">
                              <div class="col-md-12 ">
                                  <div class="form-group">
                                          <label for="">Name</label>
                                          <input type="text" class="form-control" name="name">
                                      @error('name')
                                             <p class="text-danger">{{$message}}</p>
                                      @enderror
                                        
                                  </div>
                                  <div class="form-group">
                                          <label for="">Designation</label>
                                            <select name="designation_id" class="form-control">
                                                 
                                                  @isset($designations)
                                                        @foreach ($designations as $designation)
                                                              <option value="{{ $designation->id }}">{{ $designation->name}}</option>
                                                        @endforeach
                                                  @endisset
                                                
                                            </select>
                                     @error('designation_id')
                                          <p class="text-danger">{{$message}}</p>
                                     @enderror
                                  </div>
                                  <div class="form-group">
                                        <label for="">Photo</label>
                                        <input type="file" class="form-control" name="photo" accept="image/*">
                                        @error('photo')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                    </div>
                                  <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <input type="text" class="form-control" name="phone">
                                        @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">National ID Number</label>
                                        <input type="text" class="form-control" name="nid">
                                        @error('nid')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">Salary</label>
                                        <input type="text" class="form-control" name="salary">
                                        @error('salary')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">Gender</label>
                                        <select name="gender" class="form-control">
                                               
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                        </select>
                                        @error('gender')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                      
                                  </div>
                                  <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea class="form-control" name="address" id=""  class="form-control"></textarea>
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                      
                                  </div>
                                  <div class="form-group">
                                        <label for="">Joining Date</label>
                                        <input type="date" class="form-control" name="joining_date" >
                                        @error('joining_date')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                        
                                  </div>
                                  <div class="form-group">
                                        <label for="">Is Leave...?</label>
                                        <select name="is_leave" id="is_leave" class="form-control">
                                            <option value="yes" >Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        @error('is_leave')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group leaving_date_group">
                                        <label for="">Leaving Date</label>
                                        <input type="date" class="form-control" name="leaving_date">
                                        @error('leaving_date')
                                        <p class="text-danger">{{$message}}</p>
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
            <h5 class="modal-title " id="">Delete Employee</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">Are you want to permanently delete the employee profile... ? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.employee.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="employee_id">
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
 {{-- date picker script --}}
 <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script>
       //date picker 
     /*   $("#joining_date" ).datepicker();
       $("#leaving_date" ).datepicker(); */

         //initially hide the leaving date
         let is_leave = $('#addModal').find('select[name="is_leave"]').val();
         if(is_leave == 'no'){
              $('#addModal').find('.leaving_date_group').slideUp();
         }

         //leaving employee fucntion define
         function leavingEmployee(value){
           if(value == 'yes'){
              $('.leaving_date_group').slideDown();
           }else{
            $('.leaving_date_group').slideUp();
           }
         }


      /*** employee profile edit section *****/
      function editFunction(id){

        let employee_id =  $('#employee_table').find('.employee_id_'+id).val();
        let name = $('#employee_table').find('.name_'+id).text();
        let designation_id = $('#employee_table').find('.designation_'+id).val();
        
        let phone = $('#employee_table').find('.phone_'+id).text();
        let nid = $('#employee_table').find('.nid_'+id).text();
        let salary = $('#employee_table').find('.salary_'+id).text();
        let gender = $('#employee_table').find('.gender_'+id).val();
        let address = $('#employee_table').find('.address_'+id).text();
        let joining_date = $('#employee_table').find('.joining_date_'+id).text();
        let is_leave = $('#employee_table').find('.is_leave_'+id).val();
       
        let leaving_date = $('#employee_table').find('.leaving_date_'+id).text();


         $('#editModal').find('input[name="employee_id"]').val(employee_id);
         $('#editModal').find('input[name="name"]').val(name);
         $('#editModal').find('input[name="phone"]').val(parseInt(phone));
         $('#editModal').find('input[name="nid"]').val(parseInt(nid));
         $('#editModal').find('input[name="salary"]').val(parseInt(salary));
         $('#editModal').find('textarea[name="address"]').val(address);
         $('#editModal').find('input[name="joining_date"]').val(joining_date);
        
         $('#editModal').find('input[name="leaving_date"]').val(leaving_date);


         // unselected all the options of designation
         $('#editModal select[name="designation_id"]').find('option').each(function(){
            $(this).prop('selected', false);
         });

         //selected the correct designation options
         $('#editModal select[name="designation_id"]').find('option').each(function(){
           if( $(this).val() == designation_id){
            $(this).prop('selected', true);
           }
         });
         // unselected all the options of gender
         $('#editModal select[name="gender"]').find('option').each(function(){
            $(this).prop('selected', false);
           
         });

         //selected the correct designation options
         $('#editModal select[name="gender"]').find('option').each(function(){
           if( $(this).val() == gender){
            $(this).prop('selected', true);
           }
         });
         // unselected all the options of is leave
         $('#editModal select[name="is_leave"]').find('option').each(function(){
            $(this).prop('selected', false);
           
           
         });

         //selected the correct of is leave options
         $('#editModal select[name="is_leave"]').find('option').each(function(){
           if( $(this).val() == is_leave){
            $(this).prop('selected', true);
           }
         });
       
      }


       /*** end employee profile edit section *****/

      /***start employee profile delete section *****/
      function deleteFunction(id){
        
        //set the id value in delete form
        $('#deleteForm').find('input[name="employee_id"]').val(id);
      }

  </script>

@endsection   

    