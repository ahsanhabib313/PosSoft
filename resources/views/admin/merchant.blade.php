@extends('admin.master')
@section('title', 'Merchant')

  @section('content')
  <div class="container-fluid">
      
   
{{--========================== stop search box  =========================--}}
    <div class="row d-flex justify-content-between p-1 mt-3">
      <div>
        <h3 class="text-white">All Merchant List</h3> 
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#addModal">Add Merchant</button>

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
               <h3 class="text-center py-2" id="exampleModalLabel">Create Merchant Profile</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.merchant.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control" name="phone">
                                                    @error('phone')
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
        <table class="table table-light text-dark font-weight-bold table-hover text-center" id="merchant_table">
             <thead>
               <tr>
                 <td>Seril No.</td>
                 <td>Name</td>
                 <td>Phone</td>
                 <td>Address</td>
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($merchants)
                        @foreach ($merchants as $merchant)
                        <tr>
                            <input type="hidden" class="merchant_id_{{ $merchant->id }}" value="{{ $merchant->id }}">
                            <td>{{ $loop->index + 1 }}</td>
                            <td class="name_{{ $merchant->id }}">{{ ucfirst($merchant->name) }}</td>
                            <td class="phone_{{ $merchant->id }}">{{ $merchant->phone }}</td>
                            <td class="address_{{ $merchant->id }}">{{ $merchant->address }}</td>
                           <td>
                              <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$merchant->id}})">Edit</button>
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$merchant->id}})">Delete</button>
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
              Edit Merchant
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row d-flex justify-content-center">
              <div class="col-10">
                    <div class="card">
                       <div class="card-body" style="background-color: #eae2e2; color:#000">
                          <form action="{{ route('admin.merchant.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <input name="merchant_id" type="hidden">
                                  <div class="form-group">
                                          <label for="">Name</label>
                                          <input type="text" class="form-control" name="name">
                                          @error('name')
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
                                        <label for="">Address</label>
                                        <textarea class="form-control" name="address" id=""  class="form-control"></textarea>
                                        @error('address')
                                        <p class="text-danger">{{$message}}</p>
                                         @enderror
                                  </div>
                                  <div class="form-group">
                                      <button type="submit" class="text-center btn btn-success">Update
                                      </button>
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
            <h5 class="modal-title " id="">Delete Merchant</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h5 class="text-danger">Are you want to permanently delete the Merchant profile... ? </h5>    
              </div>
              <form id="deleteForm" action="{{ route('admin.merchant.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="merchant_id">
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
      /*** employee profile edit section *****/
      function editFunction(id){

        let merchant_id =  $('#merchant_table').find('.merchant_id_'+id).val();
        let name = $('#merchant_table').find('.name_'+id).text();
        let phone = $('#merchant_table').find('.phone_'+id).text();
        let address = $('#merchant_table').find('.address_'+id).text();

        $('#editModal').find('input[name="merchant_id"]').val(merchant_id);
        $('#editModal').find('input[name="name"]').val(name);
        $('#editModal').find('input[name="phone"]').val(parseInt(phone));
        $('#editModal').find('textarea[name="address"]').val(address);
      }
       /*** end employee profile edit section *****/

     
      /***start employee profile delete section *****/
      function deleteFunction(id){
        //set the id value in delete form
        $('#deleteForm').find('input[name="merchant_id"]').val(id);
      }

  </script>

@endsection   

    