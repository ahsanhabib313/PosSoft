@extends('admin.master')
@section('title', 'লেনদেনের প্রকার')

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
       
    </style>

@endpush
  @section('content')
  <div class="container">
{{--========================== stop search box  =========================--}}
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
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
                                      <div class="card-header ">
                                          <div class="card-title">
                                            <h5 class="text-dark font-weight-bold">লেনদেনের প্রকার তৈরি করুন</h5>
                                          </div>
                                      </div>
                                      <div class="card-body ">
                                        <form action="{{ route('admin.transactionType.store') }}" method="POST">
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
                                             </div>
                                          </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1 ">
                                                    <button type="submit" class="text-center text-white btn btn-primary btn-sm">সংরক্ষণ করুন
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
        {{--    <div class="row d-flex justify-content-center my-3">
             <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <form action="{{url('admin/search/transactionType')}}" method="post" id="searchTransactionType">
                    
                      <div class="form-group">
                        <label style="font-size:18px; color:#4B0082; ">ক্যাটাগরি খুঁজুন</label>
                          <input type="text" name="" id="" class="form-control text-black" placeholder="" aria-describedby="helpId" oninput="searchTransactionType(this.value)" style="border-color:#006400">
                        </div>
                </form>
                </div>
               </div>
             </div>
           </div> --}}

           <div class="row d-flex justify-content-between">
                  <div class="card-title pl-3 pt-2 ">
                    <h4  style="color: #000!important">লেনদেনের প্রকারের তালিকা </h4>
                  </div>
                  <div>
                    <button  class="btn btn-md btn-primary btn-sm mr-3" data-toggle="modal" data-target="#addModal">লেনদেনের প্রকার যোগ করুন</button>
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
          <table class="table  table-hover text-center text-dark" id="transactionType_table">
            <thead class=" text-dark font-weight-bold">
              <tr>
                <td>সিরিয়াল নং.</td>
                <td>নাম</td>
                <td>কার্যকলাপ</td>
              </tr>
            </thead>
            <tbody>
              @isset($transactionTypes)
                       @foreach ($transactionTypes as $transactionType)
                       <tr>
                           <td>{{ $loop->index + 1 }}</td>
                           <td class="transactionType_{{ $transactionType->id }}">{{ $transactionType->name }}</td>
                           <td>
                             <button class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editModal"  onclick="editFunction({{$transactionType->id}})">সংশোধন</button>
                             <button class="btn btn-sm btn-danger d-inline-block" data-toggle="modal" data-target="#deleteModal"  onclick="deleteFunction({{$transactionType->id}})" style="    margin-top: -4px;">বাতিল</button>
                           </td>
                       </tr>
                   @endforeach
              @endisset
            </tbody>
       </table>
       {{ $transactionTypes->links() }}
         </div>
       </div>

      
      </div>
    </div>
 
     <!--Edit Modal -->
     <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
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
                                  <div class="card-header  text-white">
                                    <h4 class="card-title" style="color: #000!important">ক্যাটাগরি সংশোধন</h4>
                                  </div>
                                  <div class="card-body">
                                    <form action="{{ route('admin.transactionType.update') }}" method="POST">
                                      @csrf
                                     
                                        <input type="hidden" name="transactionType_id">
                                             <div class="form-group">
                                               <label for=""> নাম</label>
                                               <input type="text" class="form-control" name="name">
                                               @error('name')
                                                 <p class="text-danger">{{ $message }}</p>
                                               @enderror
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
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="color: #000!important" id="">লেনদেনের প্রকার বাতিলকরণ </h5> 
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
            <form action="{{ route('admin.transactionType.delete') }}" method="POST">
              @csrf
              <input type="hidden" name="transactionType_id">
              <button type="submit" class="btn btn-danger">হ্যা</button>
            </form>
           
          </div>
        </div>
      </div>
    </div>

    
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script  src="{{ asset('js/transactionType.js') }}"></script>
  
@endsection   

    