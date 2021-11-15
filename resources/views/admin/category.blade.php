@extends('admin.layout.adminPanel')
@section('title', 'Category')
@section('content')
  <div class="container">
    <div class="row d-flex justify-content-between">
      <div>
        <h3 class="text-dark">All Category List</h3> 
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#productaddmodal">Add Category</button>

      </div>
     
        <!-- Modal -->
        <div class="modal fade" id="productaddmodal" tabindex="-1" aria-labelledby="productaddmodal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
               
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <h3 class="text-center py-2" id="exampleModalLabel">Add Category</h3>
                <div class="row">
                  <div class="col-12">
                                    <div class="jumbotron">
                                      <form action="{{ route('category.store') }}" method="POST">
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
                                           </div>
                                        </div>
                                            <div class="form-row">
                                              <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">Save Category
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
        <table class="table table-dark table-hover text-center">
             <thead>
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
                              <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteCategory"  onclick="deleteFunction({{$category->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
               @endisset
             </tbody>
        </table>
      </div>
    </div>
 
     <!--Edit Modal -->
     <div class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                                <div class="jumbotron">
                                  <form action="{{ route('category.update') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                      <input type="hidden" name="category_id">
                                       <div class="col-md-8 offset-1">
                                           <div class="form-group">
                                             <label for=""> Name</label>
                                             
                                             <input type="text" class="form-control" name="name">
                                             @error('name')
                                               <p class="text-danger">{{ $message }}</p>
                                             @enderror
                                           </div>
                                       </div>
                                    </div>
                                   <div class="form-row">
                                    <div class="col-md-5 offset-1 ">
                                         <button type="submit" class="text-center btn btn-success">Update Product</button>
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
            <form action="{{ route('category.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="category_id">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script>
      function editFunction(id){
        // get the category name
        var name = $('.category_'+id).text();
        //set the category id on edit form
        $('#editCategory').find('input[name= category_id]').val(id);
        //set the category name on edit form
        $('#editCategory').find('input[name= name]').val(name);
      }


      function deleteFunction(id){
        
        //set the category id on delete form
        $('#deleteCategory').find('input[name=category_id]').val(id);
      }
  </script>
@endsection       