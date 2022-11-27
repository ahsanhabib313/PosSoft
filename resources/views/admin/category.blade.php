@extends('admin.master')
@section('title', 'ক্যাটাগরি')

@push('styles')

    <style>
      svg.w-5{
        width:15px !important;
      }

      nav div:nth-child(1) span {
        display:none;
      }
      nav div:nth-child(1) a {
        display:none;
      }

      nav div:nth-child(2) div p{
      
        display:none;
      }

      .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
    cursor: default;
    padding-left: 15px;
    padding-right: 5px;
}
       
    </style>
   {{--  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endpush
  @section('content')
  <div class="container">
{{--========================== stop search box  =========================--}}
        <!-- Modal -->
        <div class="modal fade" id="productaddmodal" tabindex="-1" aria-labelledby="productaddmodal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"  class="engFont">&times;</span>
                </button>
              </div>
              <div class="modal-body py-5">
                <div class="row d-flex justify-content-center">
                  <div class="col-10">
                                    <div class="card ">
                                      <div class="card-header bg-success ">
                                          <div class="card-title">
                                            <h5 class="text-dark  font-weight-bold">ক্যাটাগরি তৈরি করুন</h5>
                                          </div>
                                      </div>
                                      <div class="card-body ">
                                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          <div class="form-row">
                                             <div class="col-md-8 offset-1">
                                                 <div class="form-group">
                                                   <label for="" style="font-size: 16px; color:#000">নাম</label>
                                                   <input type="text" class="form-control" name="name">
                                                   @error('name')
                                                     <p class="text-danger">{{ $message }}</p>
                                                   @enderror
                                                 </div>
                                                 <div class="form-group">
                                                   <label for="" style="font-size: 16px; color:#000">ছবি</label>
                                                   <input type="file" class="form-control engFont" name="image">
                                                   @error('image')
                                                     <p class="text-danger">{{ $message }}</p>
                                                   @enderror
                                                 </div>
                                                 <div class="form-group">
                                                  <label for="" style="font-size: 16px; color:#000">কোম্পানী</label>
                                                  <select class="company" name="company_id[]" multiple="multiple">
                                                     @isset($companies)
                                                          @foreach($companies as $company)
                                                              <option value="{{$company->id}}">{{$company->name}}</option>
                                                          @endforeach
                                                     @endisset
                                                  </select>
                                                 </div>
                                             </div>
                                          </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1 ">
                                                    <button type="submit" class="text-center text-white btn btn-primary btn-sm">জমা করুন
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
         <div class="card-header  text-white" style="box-sizing:border-box">
            {{--========================== start search box  =========================--}}
           <div class="row d-flex justify-content-center my-3">
             <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <form action="{{url('admin/search/category')}}" method="post" id="searchCategory">
                    
                      <div class="form-group">
                        <label style="font-size:18px; color:#4B0082; ">ক্যাটাগরি খুঁজুন</label>
                          <input type="text" name="" id="" class="form-control text-black" placeholder="" aria-describedby="helpId" onkeyup="searchCategory(this.value)" style="border-color:#006400">
                        </div>
                   
                </form>
                </div>
               </div>
             </div>
           </div>

           <div class="row d-flex justify-content-between">
                  <div class="card-title pl-3 pt-2">
                    <h4>ক্যাটাগরির তালিকা </h4>
                  </div>
                  <div>
                    <button  class="btn btn-md btn-primary btn-sm mr-3" data-toggle="modal" data-target="#productaddmodal">ক্যাটাগরি যোগ করুন</button>
                  </div>
           </div>
          
         </div>
         <div class="card-body">
           <div class="msg-show bg-white">
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
          <table class="table  table-hover text-center text-dark" id="category_table">
            <thead class=" text-dark font-weight-bold">
              <tr>
                <td>সিরিয়াল নং.</td>
                <td>নাম</td>
                <td>ছবি</td>
                <td>কোম্পানী</td>
                <td>কার্যকলাপ</td>
              </tr>
            </thead>
            <tbody>
              @isset($categories)
                       @foreach ($categories as $category)
                       <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td class="category_{{ $category->id }}">{{ $category->name }}</td>
                           <td class="category_{{ $category->id }}"><img src="{{ asset('img/category/'.$category->image) }}" width="100" height="100"> </td>
                           @php
                              $company_ids = json_decode($category->company_id);
                           @endphp
                           <td>
                              @isset($company_ids)
                               
                                 @foreach ($company_ids as $item)
                                      <button class="btn btn-sm btn-secondary">{{App\Models\Company::find($item)->name}}</button>
                                 @endforeach

                              @endisset
                          </td>
                           <td>
                             <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editCategory"  onclick="editFunction({{$category->id}})">সংশোধন</button>
                             <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteCategory"  onclick="deleteFunction({{$category->id}})" style="    margin-top: -4px;">বাতিল</button>
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
              <span aria-hidden="true"  class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body py-3">
            <div class="row d-flex justify-content-center">
              <div class="col-md-10">
                                <div class="card">
                                  <div class="card-header  text-white bg-success">
                                    <h4 class="card-title">ক্যাটাগরি সংশোধন</h4>
                                  </div>
                                  <div class="card-body">
                                    <form action="{{ route('admin.category.update') }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                     
                                        <input type="hidden" name="category_id">
                                             <div class="form-group">
                                               <label for="" style="font-size: 16px; color:#000"> নাম</label>
                                               <input type="text" class="form-control" name="name">
                                               @error('name')
                                                 <p class="text-danger">{{ $message }}</p>
                                               @enderror
                                             </div>
                                             <div class="form-group">
                                                <label for="" style="font-size: 16px; color:#000">ছবি</label>
                                                <input type="file" class="form-control engFont" name="image">
                                                @error('image')
                                                  <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                             <div class="form-group">
                                              <label for="" style="font-size: 16px; color:#000">কোম্পানী</label>
                                              <select class="company" name="company_id[]" multiple="multiple">
                                                <option>কোম্পানী সিলেক্ট করুন...</option>
                                                 @isset($companies)
                                                      @foreach($companies as $company)
                                                          <option value="{{$company->id}}">{{$company->name}}</option>
                                                      @endforeach
                                                 @endisset
                                              </select>
                                             </div>
                                     <div class="form-group">
                                           <button type="submit" class="text-center btn btn-primary">সংশোধন করুন</button>
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
            <h5 class="modal-title " id="">ক্যাটাগরি বাতিল </h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true " class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                  <h4 class="text-danger">আপনি কি নিশ্চিত ...?</h4>    
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
            <form action="{{ route('admin.category.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="category_id">
              <button type="submit" class="btn btn-danger">হ্যা</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{--   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
          $('.company').select2();
      </script> --}}
      <script  src="{{ asset('js/category.js') }}"></script>
  @endpush
@endsection   

    