@extends('admin.master')
@section('title', 'Category')

  @section('content')
  <div class="container">
     
      
{{--========================== stop search box  =========================--}}
   
        <!-- Modal -->
        <div class="modal fade" id="productaddmodal" tabindex="-1" aria-labelledby="productaddmodal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body py-5">
                <div class="row d-flex justify-content-center">
                  <div class="col-10">
                                    <div class="card ">
                                      <div class="card-header bg-primary">
                                          <div class="card-title">
                                            <h5 class="text-white font-weight-bold">Add Category</h5>
                                          </div>
                                      </div>
                                      <div class="card-body ">
                                        <form action="{{ route('admin.category.store') }}" method="POST">
                                          @csrf
                                          <div class="form-row">
                                             <div class="col-md-8 offset-1">
                                                 <div class="form-group">
                                                   <label for="" style="font-size: 16px; color:#000">Name</label>
                                                   <input type="text" class="form-control" name="name">
                                                   @error('name')
                                                     <p class="text-danger">{{ $message }}</p>
                                                   @enderror
                                                 </div>
                                             </div>
                                          </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1 ">
                                                    <button type="submit" class="text-center text-white btn btn-primary btn-sm">Save
                                                    </button>
                                                  </div>
                                                </div>
                                        </form>
                                      </div>
                                    
                                    </div>
                                 </div>
                            </div>
                      </div>
                
              <div class="modal-footer ">
               
                
              </div>
            </div>
          </div>
        </div>
     
    </div>
    <div class="row my-5 d-flex justify-content-center">
      <div class="col-md-10">
       <div class="card">
         <div class="card-header bg-success text-white" style="box-sizing:border-box">
            {{--========================== start search box  =========================--}}
           <div class="row d-flex justify-content-center my-3">
             <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <form action="{{url('admin/search/category')}}" method="post" id="searchCategory">
                    
                      <div class="form-group">
                        <label style="font-size:18px; color:#4B0082; ">Search Category</label>
                          <input type="text" name="" id="" class="form-control text-black" placeholder="" aria-describedby="helpId" onchange="searchCategory(this.value)" style="border-color:#006400">
                        </div>
                   
                </form>
                </div>
               </div>
             </div>
           </div>

           <div class="row d-flex justify-content-between">
                  <div class="card-title pl-3 pt-2">
                    <h4>Category List </h4>
                  </div>
                  <div>
                    <button  class="btn btn-md btn-primary btn-sm mr-3" data-toggle="modal" data-target="#productaddmodal">Add Category</button>
                  </div>
           </div>
          
         </div>
         <div class="card-body">
           <div class="msg-show bg-white">
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
          <table class="table  table-hover text-center text-dark" id="category_table">
            <thead class="bg-dark text-white font-weight-bold">
              <tr>
                <td>Seril No.</td>
                <td>Name</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              @isset($categories)
                       @foreach ($categories as $category)
                       <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td class="category_{{ $category->id }}">{{ $category->name }}</td>
                           <td>
                             <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editCategory"  onclick="editFunction({{$category->id}})">Edit</button>
                             <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteCategory"  onclick="deleteFunction({{$category->id}})" style="    margin-top: -4px;">Delete</button>
                           </td>
                       </tr>
                   @endforeach
              @endisset
            </tbody>
       </table>
       {{ $categories->links() }}
         </div>
       </div>

      
      </div>
    </div>
 
     <!--Edit Modal -->
     <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
           
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body py-3">
            <div class="row d-flex justify-content-center">
              <div class="col-md-10">
                                <div class="card">
                                  <div class="card-header bg-primary text-white">
                                    <h4 class="card-title">Edit Category</h4>
                                  </div>
                                  <div class="card-body">
                                    <form action="{{ route('admin.category.update') }}" method="POST">
                                      @csrf
                                     
                                        <input type="hidden" name="category_id">
                                             <div class="form-group">
                                               <label for=""> Name</label>
                                               
                                               <input type="text" class="form-control" name="name">
                                               @error('name')
                                                 <p class="text-danger">{{ $message }}</p>
                                               @enderror
                                             </div>
                                     <div class="form-group">
                                           <button type="submit" class="text-center btn btn-primary">Update</button>
                                    </div>
                                  </form>
                                  </div>
                                  
                  </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
           
            
          </div>
        </div>
      </div>
    </div>




     <!--Delete Modal -->
     <div class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="deleteCategory" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title " id="">Delete Category</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h4 class="text-danger">Are You Confirm ?</h4>    
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{ route('admin.category.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="category_id">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script  src="{{ asset('js/category.js') }}"></script>
  
@endsection   

    