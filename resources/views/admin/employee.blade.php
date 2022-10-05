@extends('admin.master')
@section('title', 'কর্মচারী')

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-white">কর্মচারী তালিকা</h3> 
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
        @if (Session::has('delete'))
        <div class="alert alert-danger">
            {{ Session::get('delete') }}
        </div>
        @endif
       
      </div>
      <div>
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">কর্মচারী যোগ করুন</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">কর্মচারী যোগ করুন</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                      <label for="">নাম</label>
                                                      <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                                      @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                      @enderror
                                               </div>
                                               <div class="form-group">

                                                      <label for="">পদবি</label>
                                                        <select name="designation_id" class="form-control">
                                                              <option selected>পদবি বাছাই করুন</option>
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
                                                    <label for="">ছবি</label>
                                                    <input type="file" class="form-control engFont" name="photo" accept="image/*" value="{{old('photo')}}">
                                                    @error('photo')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                               <div class="form-group">
                                                    <label for="">মোবাইল</label>
                                                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                                                    @error('phone')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">এনআইডি নাম্বার</label>
                                                    <input type="text" class="form-control" name="nid" value="{{old('nid')}}">
                                                    @error('nid')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">বেতন</label>
                                                    <input type="text" class="form-control" name="salary" value="{{old('salary')}}">
                                                    @error('salary')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">লিঙ্গ</label>
                                                    <select name="gender" class="form-control">
                                                            <option value="" selected>লিঙ্গ বাছাই করুন</option>
                                                            <option value="পুরুষ">পুরুষ</option>
                                                            <option value="মহিলা">মহিলা</option>
                                                    </select>
                                                    @error('gender')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">ঠিকানা</label>
                                                    <textarea name="address" id=""  class="form-control" value="{{old('address')}}"></textarea>
                                                    @error('address')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">যোগদানের তারিখ</label>
                                                    <input type="date" class="form-control engFont" name="joining_date" id="joining_date" value="{{old('joining_date')}}">
                                                    @error('joining_date')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group">
                                                    <label for="">অবসর...?</label>
                                                    <select name="is_leave" id="is_leave" class="form-control" onchange="leavingEmployee(this.value)">
                                                       
                                                        <option value="হ্যা" >হ্যা</option>
                                                        <option value="না" selected>না</option>
                                                    </select>
                                                    @error('is_leave')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                               <div class="form-group leaving_date_group">
                                                    <label for="">অবসরের তারিখ</label>
                                                    <input type="date" class="form-control engFont" name="leaving_date" id="leaving-date" value="{{old('leaving-date')}}">
                                                    @error('leaving_date')
                                                      <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                               </div>
                                           </div>
                                        </div>
                                            <div class="form-row">
                                              <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">সংরক্ষন করুন
                                                  </button>
                                                </div>
                                              </div>
                                      </form>
                                    </div>
                                 </div>
                            </div>
                      </div>
                
              <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
                
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
                 <td>সিরিয়াল নং.</td>
                 <td>নাম</td>
                 <td>পদবি</td>
                 <td>ছবি</td>
                 <td>কার্যক্রম</td>
               </tr>
             </thead>
             <tbody>
               @isset($employees)
                        @foreach ($employees as $employee)
                        <tr>
                            <input type="hidden" class="employee_id_{{ $employee->id }}" value="{{ $employee->id }}">
                            <input type="hidden" class="employeeName_{{ $employee->id }}" value="{{ $employee->name }}">
                            <input type="hidden" class="designation_{{ $employee->id }}" value="{{ $employee->designation_id }}">
                            <input type="hidden" class="designationName_{{ $employee->id }}" value="{{ $employee->designation->name }}">
                            <input type="hidden" class="phone_{{ $employee->id }}" value="{{ $employee->phone }}">
                            <input type="hidden" class="photo_{{ $employee->id }}" value="{{ $employee->photo }}">
                            <input type="hidden" class="nid_{{ $employee->id }}" value="{{ $employee->nid }}">
                            <input type="hidden" class="salary_{{ $employee->id }}" value="{{ $employee->salary }}">
                            <input type="hidden" class="gender_{{ $employee->id }}" value="{{ $employee->gender }}">
                            <input type="hidden" class="address_{{ $employee->id }}" value="{{ $employee->address }}">
                            <input type="hidden" class="joining_date_{{ $employee->id }}" value="{{ $employee->joining_date }}">
                            <input type="hidden" class="is_leave_{{ $employee->id }}" value="{{ $employee->is_leave }}">
                            <input type="hidden" class="leaving_date_{{ $employee->id }}" value="{{ $employee->leaving_date }}">
                          
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ ($employee->name) }}</td>
                            <td>{{ $employee->designation->name }}</td>
                            <td class="photo_{{ $employee->id }}"><img height="50" width="50" src="{{ asset('/img/employees/'.$employee->photo)}}" alt=""></td>
                            <td>
                              <button class="btn btn-sm btn-success d-inline-block mb-1" data-toggle="modal" data-target="#viewModal"  onclick="viewFunction({{$employee->id}})">বিস্তারিত দেখুন</button>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$employee->id}})">সংস্করণ করুন</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$employee->id}})">বাতিল করুন</button>
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
             কর্মচারী সংস্করণ
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
                          <form action="{{ route('admin.employee.update') }}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <input name="employee_id" type="hidden">
                            <div class="form-row">
                              <div class="col-md-12 ">
                                  <div class="form-group">
                                          <label for="">নাম</label>
                                          <input type="text" class="form-control" name="name">
                                      @error('name')
                                             <p class="text-danger">{{$message}}</p>
                                      @enderror
                                        
                                  </div>
                                  <div class="form-group">
                                          <label for="">পদবি</label>
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
                                        <label for="">ছবি</label>
                                        <input type="file" class="form-control engFont" name="photo" accept="image/*">
                                        @error('photo')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                    </div>
                                  <div class="form-group">
                                        <label for="">মোবাইল নাম্বার</label>
                                        <input type="text" class="form-control" name="phone">
                                        @error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">জাতীয় পরিচয়প্ত্র</label>
                                        <input type="text" class="form-control" name="nid">
                                        @error('nid')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">বেতন</label>
                                        <input type="text" class="form-control" name="salary">
                                        @error('salary')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group">
                                        <label for="">লিঙ্গ</label>
                                        <select name="gender" class="form-control">
                                               
                                                <option value="পুরুষ">পুরুষ</option>
                                                <option value="মহিলা">মহিলা</option>
                                        </select>
                                        @error('gender')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                      
                                  </div>
                                  <div class="form-group">
                                        <label for="">ঠিকানা</label>
                                        <textarea class="form-control" name="address" id=""  class="form-control"></textarea>
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                      
                                  </div>
                                  <div class="form-group">
                                        <label for="">যোগদানের তারিখ</label>
                                        <input type="date" class="form-control engFont" name="joining_date" >
                                        @error('joining_date')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                        
                                  </div>
                                  <div class="form-group">
                                        <label for="">অবসর...?</label>
                                        <select name="is_leave" id="" class="form-control is_leave" onchange="leavingEmployee(this.value)">
                                            <option value="হ্যা" >হ্যা</option>
                                            <option value="না">না</option>
                                        </select>
                                        @error('is_leave')
                                        <p class="text-danger">{{$message}}</p>
                                   @enderror
                                       
                                  </div>
                                  <div class="form-group leaving_date_group">
                                        <label for="">অবসরের তারিখ</label>
                                        <input type="date" class="form-control engFont" name="leaving_date">
                                        @error('leaving_date')
                                        <p class="text-danger">{{$message}}</p>
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

       <!-- view modal -->
       <div class="modal" id="viewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            {{-- <div class="modal-header">
             
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="engFont">&times;</span>
              </button>
            </div> --}}
            <div class="modal-body">
              <div class="card">
                <div class="card-header">
                  <h5 class="modal-title text-dark">কর্মচারীর বিবরণ</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="engFont">&times;</span>
                  </button>
                </div>
                <div class="card-body">
                  <table class="table table-striped text-center">
                    <tr>
                      <td>নাম</td>
                      <td class="name"></td>
                    </tr>
                    <tr>
                      <td>পদবি</td>
                      <td class="designation"></td>
                    </tr>
                    <tr>
                      <td>ছবি</td>
                      <td ><img class="photo" height="150" width="150" alt="employee image"></td>
                    </tr>
                    <tr>
                      <td>মোবাইল নাম্বার</td>
                      <td class="phone"></td>
                    </tr>
                    <tr>
                      <td>জাতীয় পরিচয়পত্র নং</td>
                      <td class="nid"></td>
                    </tr>
                    <tr>
                      <td>ঠিকানা</td>
                      <td class="address"></td>
                    </tr>
                    <tr>
                      <td>বেতন</td>
                      <td class="salary"></td>
                    </tr>
                    <tr>
                      <td>লিঙ্গ</td>
                      <td class="gender"></td>
                    </tr>
                    <tr>
                      <td>যোগদানের তারিখ</td>
                      <td class="joining_date"></td>
                    </tr>
                    <tr>
                      <td>অবসরপ্রাপ্ত</td>
                      <td class="resigned"></td>
                    </tr>
                    <tr>
                      <td>অবসরের তারিখ</td>
                      <td class="resigned_date"></td>
                    </tr>
                </table>
                </div>
              </div>

               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">বন্ধ করুন</button>
            </div>
          </div>
        </div>
      </div>


     <!--Delete Modal -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="">কর্মচারী বাতিলকরন</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">আপনি কি নিশ্চিত... ? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.employee.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="employee_id">
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
 {{-- date picker script --}}
 <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
  <script>

         //initially hide the leaving date
         let is_leave = $('#addModal').find('select[name="is_leave"]').val();
         if(is_leave == 'না'){
              $('#addModal').find('.leaving_date_group').slideUp();
         }

         //leaving employee fucntion define
         function leavingEmployee(value){
           if(value == 'হ্যা'){
              $('.leaving_date_group').slideDown();
           }else{
            $('.leaving_date_group').slideUp();
           }
         }


      /*** employee profile edit section *****/
      function editFunction(id){

        let employee_id =  $('#employee_table').find('.employee_id_'+id).val();
        let name = $('#employee_table').find('.employeeName_'+id).val();
        let designation_id = $('#employee_table').find('.designation_'+id).val();
        let phone = $('#employee_table').find('.phone_'+id).val();
        let nid = $('#employee_table').find('.nid_'+id).val();
        let salary = $('#employee_table').find('.salary_'+id).val();
        let gender = $('#employee_table').find('.gender_'+id).val();
        let address = $('#employee_table').find('.address_'+id).val();
        let joining_date = $('#employee_table').find('.joining_date_'+id).val();
        let is_leave = $('#employee_table').find('.is_leave_'+id).val();
        let leaving_date = $('#employee_table').find('.leaving_date_'+id).val();

   
         $('#editModal').find('input[name="employee_id"]').val(employee_id);
         $('#editModal').find('input[name="name"]').val(name);
         $('#editModal').find('input[name="phone"]').val((phone));
         $('#editModal').find('input[name="nid"]').val((nid));
         $('#editModal').find('input[name="salary"]').val((salary));
         $('#editModal').find('textarea[name="address"]').val(address);
         $('#editModal').find('input[name="joining_date"]').val(joining_date);
         $('#editModal').find('input[name="leaving_date"]').val(leaving_date);


         //hide leaving date in edit modal form
         if(is_leave == 'না'){
              $('#editModal').find('.leaving_date_group').slideUp();
         }

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

      /*** employee profile view section *****/

      function viewFunction(id){

        let employee_id =  $('#employee_table').find('.employee_id_'+id).val();
        let name = $('#employee_table').find('.employeeName_'+id).val();
        let designationName = $('#employee_table').find('.designationName_'+id).val();
        let photo = $('#employee_table').find('.photo_'+id).val();
        let phone = $('#employee_table').find('.phone_'+id).val();
        let nid = $('#employee_table').find('.nid_'+id).val();
        let salary = $('#employee_table').find('.salary_'+id).val();
        let gender = $('#employee_table').find('.gender_'+id).val();
        let address = $('#employee_table').find('.address_'+id).val();
        let joining_date = $('#employee_table').find('.joining_date_'+id).val();
        let is_leave = $('#employee_table').find('.is_leave_'+id).val();
        let leaving_date = $('#employee_table').find('.leaving_date_'+id).val();

    
         $('#viewModal').find('.name').text(name);
         $('#viewModal').find('.designation').text(designationName);
         $('#viewModal').find('.photo').attr('src', 'http://127.0.0.1:8000/img/employees/'+photo);
         $('#viewModal').find('.phone').text((phone));
         $('#viewModal').find('.nid').text(nid);
         $('#viewModal').find('.address').text(address);
         $('#viewModal').find('.salary').text(salary);
         $('#viewModal').find('.gender').text(gender);
         $('#viewModal').find('.joining_date').text(joining_date);
         $('#viewModal').find('.resigned').text(is_leave);
         $('#viewModal').find('.resigned_date').val(leaving_date);
       
      }
      /*** end employee profile view section *****/

      /***start employee profile delete section *****/
      function deleteFunction(id){
        
        //set the id value in delete form
        $('#deleteForm').find('input[name="employee_id"]').val(id);
      }

  </script>

@endsection   

    