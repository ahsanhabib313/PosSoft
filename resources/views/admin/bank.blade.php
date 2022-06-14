@extends('admin.master')
@section('title', 'Bank')

  @section('content')
  <div class="container">
      
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between mt-5">
      <div style="margin-left: 15px">
        <h3 class="text-white">All Bank List</h3> 
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">Add Bank</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">Add</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.bank.store') }}" method="POST">
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
                                                    <label for="">Branch</label>
                                                    <input type="text" class="form-control" name="branch">
                                                    @error('branch')
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
        <table class="table table-light table-hover text-center text-dark font-weight-bold" id="designation_table">
             <thead>
               <tr>
                 <td>Seril No.</td>
                 <td>Name</td>
                 <td>Branch</td>
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($banks)
                        @foreach ($banks as $bank)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="bank_name_{{ $bank->id }}">{{ $bank->name }}</td>
                            <td class="bank_branch_{{ $bank->id }}">{{ $bank->branch }}</td>
                            <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$bank->id}})">Edit</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$bank->id}})">Delete</button>
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
            <h5 class="modal-title">Edit Bank</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                                <div class="jumbotron">
                                  <form action="{{ route('admin.bank.update') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                      <input type="hidden" name="id">
                                       <div class="col-md-8 offset-1">
                                           <div class="form-group">
                                             <label for=""> Name</label>
                                             <input type="text" class="form-control" name="name">
                                             @error('name')
                                               <p class="text-danger">{{ $message }}</p>
                                             @enderror
                                           </div>
                                           <div class="form-group">
                                             <label for=""> Branch</label>
                                             <input type="text" class="form-control" name="branch">
                                             @error('branch')
                                               <p class="text-danger">{{ $message }}</p>
                                             @enderror
                                           </div>
                                       </div>
                                    </div>
                                   <div class="form-row">
                                    <div class="col-md-5 offset-1 ">
                                         <button type="submit" class="text-center btn btn-success">Update </button>
                                     </div>
                                  </div>
                                </form>
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
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="">Delete Bank</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h4 class="text-danger">Are you want to delete the bank permanently..?</h4>    
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{ route('admin.bank.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="id">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    function editFunction(id){

        // get the bank_ name
        var name = $('.bank_name_'+id).text();

        // get the bank_ branch
        var branch = $('.bank_branch_'+id).text();

        //set the designation_ id on edit form
        $('#editModal').find('input[name=id]').val(id);

        //set the designation name on edit form
        $('#editModal').find('input[name= name]').val(name);

        //set the designation name on edit form
        $('#editModal').find('input[name= brnach]').val(name);
}


function deleteFunction(id){
  
  //set the category id on delete form
  $('#deleteModal').find('input[name=id]').val(id);
}
  </script>

@endsection   

    