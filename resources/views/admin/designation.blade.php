@extends('admin.master')
@section('title', 'পদবি')

  @section('content')
  <div class="container">
      
{{--========================== stop search box  =========================--}}
    <div class="row  mt-5">
         <div class="col-md-10">
                    <div class="row d-flex justify-content-between">
                      
                        
                          <div style="margin-left: 15px">
                            <h3 class="text-white">পদবির তালিকা</h3> 
                          </div>
                          <div>
                            @if($errors->any())
                            <div class="alert alert-danger ">
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
                            @if (Session::has('delete'))
                            <div class="alert alert-danger">
                                {{ Session::get('delete') }}
                            </div>
                            @endif
                          </div>
                        
                          <div>
                            <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">পদবি যোগ করুন</button>
                    
                          </div>
                  </div>
           </div>
          
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
               <h3 class="text-center py-2" id="exampleModalLabel">পদবি যোগ</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.designation.store') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                           <div class="col-md-8 offset-1">
                                               <div class="form-group">
                                                 <label for="">নাম</label>
                                                 <input type="text" class="form-control" name="name">
                                                 @error('name')
                                                   <p class="text-danger">{{ $message }}</p>
                                                 @enderror
                                               </div>
                                           </div>
                                        </div>
                                            <div class="form-row">
                                              <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">জমা করুন 
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
    <div class="row d-flex justify-content-center my-5">
      <div class="col-md-10">
        <table class="table bg-white text-dark  table-hover text-center" id="designation_table">
             <thead>
               <tr>
                 <td>সিরিয়াল নং.</td>
                 <td>নাম</td>
                 <td>কার্যক্রম</td>
               </tr>
             </thead>
             <tbody>
               @isset($designations)
                        @foreach ($designations as $designation)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="designation_{{ $designation->id }}">{{ $designation->name }}</td>
                            <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$designation->id}})">সংশোধন করুন</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$designation->id}})">মুছে ফেলুন</button>
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
          <div class="modal-header">
            <h5 class="modal-title">Edit Designation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                                <div class="jumbotron">
                                  <form action="{{ route('admin.designation.update') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                      <input type="hidden" name="id">
                                       <div class="col-md-8 offset-1">
                                           <div class="form-group">
                                             <label for="">নাম</label>
                                             <input type="text" class="form-control" name="name">
                                             @error('name')
                                               <p class="text-danger">{{ $message }}</p>
                                             @enderror
                                           </div>
                                       </div>
                                    </div>
                                   <div class="form-row">
                                    <div class="col-md-5 offset-1 ">
                                         <button type="submit" class="text-center btn btn-success">আপডেট করুন</button>
                                     </div>
                                  </div>
                                </form>
                  </div>
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
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="">পদবি মুছে ফেলুন</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h4 class="text-danger">আপনি কি নিশ্চিত ?</h4>    
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
            <form action="{{ route('admin.designation.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="id">
              <button type="submit" class="btn btn-danger">হ্যা</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    function editFunction(id){

  // get the designation_ name
  var name = $('.designation_'+id).text();

  //set the designation_ id on edit form
  $('#editModal').find('input[name=id]').val(id);

  //set the designation name on edit form
  $('#editModal').find('input[name= name]').val(name);
}


function deleteFunction(id){
  
  //set the category id on delete form
  $('#deleteModal').find('input[name=id]').val(id);
}
  </script>

@endsection   

    