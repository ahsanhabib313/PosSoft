@extends('master')
@section('title', 'Home Page')

@section('content')
    
    {{--start content--}}   
    <div id="content" class="container-fluid">
      @if (Session::has('success'))
                  
      <div class="alert alert-success">
            {{ Session::get('success') }}
      </div>

      @endif
        {{--start main content--}}   
        <div class="main-content">
            <div class="row d-flex no-gutters">
             
                    <div class="col-sm-7 order-sm-1 order-2">
                        <div class="row">
                            <div class="col-12">
                                {{--start product part--}} 
                                <div class="category mt-2 p-2 rounded bg-white " >
                                  <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    @isset($categories)
                                      @foreach ($categories as $category)
                                          <li class="nav-item">
                                            <a href="#category_{{$category->id }}" class="nav-link  text-dark font-weight-bold {{ $loop->index == 0 ? 'active':'' }} " data-bs-toggle="pill">{{ $category->name }}</a>
                                          </li>
                                      @endforeach
                                    @endisset
                                  </ul>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class=" tab-content products">
                              @isset($categories)

                                    @foreach ($categories as $category)
                                    <div class="tab-pane fade show {{ $loop->index == 0 ? 'active': '' }}  d-flex flex-wrap justify-content-start"  role="tabpanel" id="category_{{$category->id }}">
                                             @foreach (App\Models\Product::where('category_id', $category->id)->get() as $product)
                                              {{--start products--}}
                                                  <div class="card product-card" >
                                                    <input type="hidden" id="manufacture_{{ $product->id }}" value="{{ $product->manufacture }}">
                                                    <input type="hidden" id="productName_{{ $product->id }}" value="{{ $product->productName }}">
                                                    <input type="hidden" id="retailPrice_{{ $product->id }}" value="{{ $product->retailPrice }}">
                                                    <input type="hidden" id="productWeightUnit_{{ $product->id }}" value="{{ $product->productWeightUnit }}">
                                                    <input type="hidden" id="wholesalePrice_{{ $product->id }}" value="{{ $product->wholesalePrice }}">
                                                    <input type="hidden" id="productQuantityUnit_{{ $product->id }}" value="{{ $product->productQuantityUnit }}">
                                                    <img class="card-img-top" src="{{asset('img/products/'.$product->photo)}}">
                                                    <div class="card-body d-flex flex-column">
                                                        <div>
                                                          <h6 class="productName text-center  pt-1 font-weight-bold">{{ $product->productName }}</h6>
                                                        </div>
                                                        @if ($product->manufacture == 0)
                                                        <div class=" text-left pl-2 ">
                                                          <span class="productWeight">ওজন: {{ $product->productWeight.' '.$product->productWeightUnit }} </span>
                                                        </div>
                                                        @endif
                                                        
                                                       {{--  <div class=" text-left pl-2 ">
                                                          <span class="retailPrice">খুচরা: {{ $product->retailPrice.' টাকা' }} </span>
                                                        </div>
                                                        <div class=" text-left pl-2 ">
                                                          <span class="wholesalePrice">পাইকারি: {{ $product->wholesalePrice.' টাকা' }} </span>
                                                        </div> --}}
                                                        <div class=" text-left pl-2 ">
                                                            <select name="" class="form-control productSellType" id="productSellType_{{ $product->id }}" class="form-control">
                                                             {{--  <option value="" disabled selected>বিক্রয়ের ধরণ</option> --}}
                                                              @isset($selling_types)
                                                                  @foreach ($selling_types as $selling_type)
                                                                    <option value="{{ $selling_type->id }}" {{ $loop->index == 0 ? 'selected':'' }}>{{ $selling_type->name }}</option>
                                                                  @endforeach
                                                              @endisset
                                                            </select>
                                                        </div>
                                                        <div>
                                                          <button type="submit" class="btn btn-block btn-sm btn-info" onclick="productInfo({{ $product->id }})" >যোগ করুন</button>
                                                        </div>
                                                    </div>
                                                  </div>
                                              {{--end products--}}
                                             @endforeach
                                            </div>
                                    @endforeach
                                  
                              @endisset
                          </div>
                        </div>
                      </div> 
                    </div>
                     <div class="col-sm-5 order-sm-2 order-1 ">
                        {{--start order part--}} 
                         <div class="order mt-2">
                           <h3 class=" text-center font-weight-bold">অর্ডার</h3>
                           <div class="form-row">
                                <div class=" col-6 form-group">
                                  <input type="text" name="customerName" class="form-control" placeholder="ক্রেতার নাম" >
                                </div>
                                <div class=" col-6 form-group"> 
                                  <input type="number" name="mobileNumber" class="form-control" placeholder="মোবাইল নাম্বার" oninput="searchDebitFunction()">
                                </div>
                           </div>
                          
                            <table class="table table-responsive-lg mt-0 mb-2 text-white table-striped order-table d-1">
                                  <thead>
                                      <th>পণ্যের নাম</th>
                                      <th>পরিমান</th>
                                      <th>দাম</th>
                                      <th>একক দাম</th>
                                      <th>একক</th>
                                      <th>কার্যকলাপ</th>
                                  </thead>
                                  <tbody>
                                    
                                    
                                  </tbody>
                            </table>
                            <div class=" py-2 text-center text-dark font-weight-bold">
                              মোটঃ <span class="totalPrice">0</span><span> টাকা </span>
                              <input type="hidden" name="totalPrice">
                             </div>
                            <div class=" py-2 text-center text-dark font-weight-bold">
                             আগের বকেয়াঃ <span class="pastDebit text-danger">0</span><span> টাকা </span>
                              <input type="hidden" name="pastDebit" value=0 >
                             </div>

                              <div class=" py-2 text-center text-dark font-weight-bold">
                              মোটঃ <span class="totalWithDebit">0</span><span> টাকা (বকেয়াসহ)</span>
                              <input type="hidden" name="totalWithDebit" >
                             </div>

                            <div class="py-2 text-center text-dark font-weight-bold">
                              বর্তমান বকেয়াঃ <span><input type="number" name="presentDebit" class="presentDebit text-danger"></span><span> টাকা </span>
                              <input type="hidden" name="presentDebit">
                             </div> 
                            
                            <div class="text-center">
                              <button type="button"  class="btn btn-md btn-info mt-3 print-btn" onclick="window.print()">প্রিন্ট করুন</button>
                              <button id="order-btn" class="btn btn-md btn-success mt-3 " >অর্ডার করুন</button>
                            </div>
                         
                        </div> 
                    </div>
                    {{--end order part--}} 
            </div>
         
        </div>
        {{--end main content--}} 
        

    </div> 
    {{--end content--}}  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script  src="{{ asset('js/home.js') }}"></script>
    <script  src="{{ asset('js/print.js') }}"></script>
    <script  src="{{ asset('js/orderConfirm.js') }}"></script>
   
  
    
@endsection

