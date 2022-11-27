@extends('admin.master')
@section('title', 'পণ্য')
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
  
    <div class="row d-flex justify-content-between">
        <!-- Modal -->
        <div class="modal fade" id="productaddmodal" tabindex="-1" aria-labelledby="productaddmodal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
             
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="engFont">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row d-flex justify-content-center">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header bg-success">
                              <div class="card-title">
                                <h5 class="text-dark font-weight-bold">পণ্য যোগ করুন</h5>
                              </div>
                          </div>
                          <div class="card-body">
                            <ul class="nav nav-tabs">
                              <li class="nav-item">
                                <a class="nav-link active font-weight-bold text-dark" data-toggle="tab" href="#manufactured">প্রস্তুতকৃত পণ্য </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link font-weight-bold text-dark" data-toggle="tab"  href="#unmanufactured">অপ্রস্তুত পণ্য</a>
                              </li>
                            
                            </ul>
                            <div class="tab-content">
                                  <div class="tab-pane container active p-4" id="manufactured">
                                          <div class="jumbotron">
                                            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                              @csrf
                                              <input type="hidden" name="manufacture" value="1">
                                              <div class="form-row">
                                                 <div class="col-md-5 offset-1">
                                                     <div class="form-group">
                                                       <label for=""> পণ্যের নাম</label>
                                                       <input type="text" class="form-control" name="productName" value="{{ old('productName') }}">
                                                       @error('productName')
                                                         <p class="text-danger">{{ $message }}</p> 
                                                       @enderror
                                                     </div>
                                                 </div>
                                                 <div class="col-md-5">
                                                   <div class="form-group">
                                                    <label for=""> ছবি </label>
                                                     <input type="file" class="form-control engFont" name="photo"  accept="image/*">
                                                     @error('photo')
                                                     <p class="text-danger">{{ $message }}</p> 
                                                   @enderror
                                                   </div>
                                                 </div>
                                              </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1">
                                                    <div class="form-group">
                                                      <label for="">পণ্যের শ্রেণী</label>
                                                      <select name="category_id" id="" class="form-control" onchange="getCompany(this.value, 1)">
                                                        <option selected disabled>বাছাই করুন</option>
                                                        @isset($categories)
                                                            @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                      </select>
      
                                                      @error('category_id')
                                                      <p class="text-danger">{{ $message }}</p> 
                                                       @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                      <label for="">কোম্পানী</label>
                                                      <select name="company_id" class="form-control" id="manufactureCompany">
                                                        <option selected disabled>বাছাই করুন</option>
                                                        @isset($companies)
                                                            @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                            @endforeach
                                                        @endisset
                                                      </select>
      
                                                      @error('company_id')
                                                      <p class="text-danger">{{ $message }}</p> 
                                                       @enderror
                                                    </div>
                                                </div>
                                              </div>
      
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1">
                                                  <div class="form-group">
                                                    <label for="">ওজন (প্রতি প্যাকেটে/বোতলে)</label>
                                                    <input type="number" class="form-control" name="productWeight" value="{{  old('productWeight')}}"">
                                                    @error('productWeight')
                                                    <p class="text-danger">{{ $message }}</p> 
                                                     @enderror
                                                  </div>
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <label for="">ওজনের একক</label>
                                                     <select name="productWeightUnit" id="" class="form-control">
                                                         <option value="">একক নির্ধারন করুন</option>
                                                         @isset($units)
                                                              @foreach ($units as $unit)
                                                                   <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                                              @endforeach
                                                         @endisset
                                                     </select>
                                                     @error('buying_unit')
                                                     <p class="text-danger">{{ $message }}</p> 
                                                      @enderror
                                                       </div>
                                                </div>
                                                
                                              </div>
                                             <div class="form-row">
                                              <div class="col-md-5 offset-1">
                                                <div class="form-group">
                                                  <label for="">ক্রয় মূল্য় (প্রতি প্যাকেটে/বোতলে)</label>
                                                  <input type="number"  class="form-control"  name="buyingPrice" value="{{  old('buyingPrice')}}"">
                                                  @error('buyingPrice')
                                                  <p class="text-danger">{{ $message }}</p> 
                                                   @enderror
                                                </div>
                                              </div>
                                              <div class="col-md-5">
                                                <div class="form-group">
                                                  <label for="">খুচরা মূল্য</label>
                                                  <input type="number" class="form-control" name="retailPrice" value="{{ old('retailPrice')}}"">
                                                  @error('retailPrice')
                                                  <p class="text-danger">{{ $message }}</p> 
                                                  @enderror
                                                </div>
                                                  </div>
                                              </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1">
                                                
                                                  <div class="form-group">
                                                    <label for="">পাইকারি মূল্য</label>
                                                    <input type="number" class="form-control" name="wholesalePrice"  value="{{old('wholesalePrice')}}"">
                                                    @error('wholesalePrice')
                                                    <p class="text-danger">{{ $message }}</p> 
                                                    @enderror
                                                  </div>
                                                 
                                                    
                                                </div>
                                                <div class="col-md-5">
                                                  <div class="form-group">
                                                    <label for="">পণ্যের সংখ্যা</label>
                                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity')}}"">
                                                    @error('quantity')
                                                    <p class="text-danger">{{ $message }}</p> 
                                                    @enderror
                                                  </div>
                                                    </div>
                                                </div>
                                                  <div class="form-row">
                                                    <div class="col-md-5 offset-1">
                                                      <div class="form-group">
                                                        <label for="">পণ্যের সংখ্যার একক (বোতল/প্যাকেট)</label>
                                                         <select name="productQuantityUnit" id="" class="form-control">
                                                             <option value="">একক নির্ধারন করুন</option>
                                                             @isset($units)
                                                                  @foreach ($units as $unit)
                                                                       <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                                                  @endforeach
                                                             @endisset
                                                         </select>
                                                         @error('productQuantityUnit')
                                                         <p class="text-danger">{{ $message }}</p> 
                                                          @enderror
                                                      </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <label for="">পণ্যের নির্দেশনার সংখ্যা</label>
                                                         <input type="number" class="form-control" name="alertQuantity" value="{{ old('alertQuantity')}}"">
                                                         @error('alertQuantity')
                                                         <p class="text-danger">{{ $message }}</p> 
                                                         @enderror
                                                         </div>
                                                        </div>
                                                  </div>
                                                      <div class="form-row">
                                                          <div class="col-md-5 offset-1">
                                                              <div class="form-group"> 
                                                                <label for="">বার কোড নাম্বার</label>
                                                                <input type="number" class="form-control" name="barCode" value="{{ old('barCode')}}"">
                                                                @error('barCode')
                                                                <p class="text-danger">{{ $message }}</p> 
                                                                @enderror
                                                              </div>
                                                          </div>
                                                          <div class="col-md-5">
                                                            <div class="form-group">
                                                              <label for="">উৎপাদন তারিখ</label>
                                                                <input type="date" class="form-control engFont" name="produceDate" value="{{ old('produceDate')}}">
                                                                @error('produceDate')
                                                                <p class="text-danger">{{ $message }}</p> 
                                                                @enderror
                                                            </div>
                                                             
                                                          </div>
                                                      </div>
                                                      <div class="form-row">
                                                          <div class="col-md-5 offset-1">
                                                            <div class="form-group">
                                                              <label for="">মেয়াদ উত্তীর্ণ তারিখ</label>
                                                                <input type="date" class="form-control engFont" name="expireDate" value="{{ old('expireDate')}}"">
                                                                @error('expireDate')
                                                                <p class="text-danger">{{ $message }}</p> 
                                                                @enderror
                                                            </div>
                                                          </div>
                                                      </div>
                                                    <div class="form-row">
                                                      <div class="col-md-5 offset-1 ">
                                                        <button type="submit" class="text-center btn btn-success">জমা করুন</button>
                                                      </div>
                                                    </div>
                                            </form>
                                          </div>
                                  </div>
                                  <div class="tab-pane container fade p-4" id="unmanufactured">
                                    <div class="jumbotron">
                                      <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="manufacture" value="0">
                                        <div class="form-row">
                                          <div class="col-md-5 offset-1">
                                              <div class="form-group">
                                                <label for=""> পণ্যের নাম</label>
                                                <input type="text" class="form-control" name="productName" value="{{ old('productName') }}">
                                                @error('productName')
                                                  <p class="text-danger">{{ $message }}</p> 
                                                @enderror
                                              </div>
                                          </div>
                                          <div class="col-md-5">
                                            <div class="form-group">
                                             <label for=""> ছবি</label>
                                              <input type="file" class="form-control engFont" name="photo"  accept="image/*">
                                              @error('photo')
                                              <p class="text-danger">{{ $message }}</p> 
                                            @enderror
                                            </div>
                                          </div>
                                       </div>
                                       <div class="form-row">
                                        <div class="col-md-5 offset-1">
                                            <div class="form-group">
                                              <label for="">পণ্যের শ্রেণী</label>
                                              <select name="category_id" id="" class="form-control" onchange="getCompany(this.value,0)">
                                                <option selected disabled>বাছাই করুন</option>
                                                @isset($categories)
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endisset
                                              </select>

                                              @error('category_id')
                                              <p class="text-danger">{{ $message }}</p> 
                                               @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                              <label for="">কোম্পানী</label>
                                              <select name="company_id" class="form-control" id="unmanufactureCompany">
                                                <option selected disabled>বাছাই করুন</option>
                                                @isset($companies)
                                                    @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                @endisset
                                              </select>

                                              @error('company_id')
                                              <p class="text-danger">{{ $message }}</p> 
                                               @enderror
                                            </div>
                                        </div>
                                      </div>
                                         <div class="form-row">
                                            <div class="col-md-5 offset-1" >
                                              <div class="form-group">
                                                <label for="">ওজন (প্রতি বস্তায়/কার্টুনে)</label>
                                                <input type="number" class="form-control" name="productWeight" value="{{ old('productWeight') }}">
                                                @error('productWeight')
                                                <p class="text-danger">{{ $message }}</p> 
                                                 @enderror
                                              </div>
                                            </div>
                                            <div class="col-md-5">
                                              <div class="form-group">
                                                <label for="">ওজনের একক</label>
                                                 <select name="productWeightUnit" id="" class="form-control">
                                                     <option value="">বাছাই করুন</option>
                                                     @isset($units)
                                                          @foreach ($units as $unit)
                                                               <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                                          @endforeach
                                                     @endisset
                                                 </select>
                                                 @error('productWeightUnit')
                                                 <p class="text-danger">{{ $message }}</p> 
                                                  @enderror
                                                   </div>
                                            </div>
                                         </div>
                                      <div class="form-row">
                                       <div class="col-md-5 offset-1">
                                        <div class="form-group">
                                          <label for="">ক্রয় মূল্য (প্রতি বস্তায়/কার্টুনে)</label>
                                          <input type="number" class="form-control" name="buyingPrice" value="{{ old('buyingPrice') }}">
                                          @error('buyingPrice')
                                          <p class="text-danger">{{ $message }}</p> 
                                           @enderror
                                        </div>
                                          
                                       </div>
                                       <div class="col-md-5">
                                        <div class="form-group">
                                          <label for="">খুচরা মুল্য (প্রতি কেজিতে)</label>
                                          <input type="number" class="form-control" name="retailPrice"  value="{{ old('retailPrice') }}">
                                          @error('retailPrice')
                                          <p class="text-danger">{{ $message }}</p> 
                                          @enderror
                                        </div>
                                           </div>
                                       </div>
                                       <div class="form-row">
                                         <div class="col-md-5 offset-1">
                                          <div class="form-group">
                                            <label for="">পাইকারি মূল্য (প্রতি বস্তায়/কার্টুনে)</label>
                                            <input type="number" class="form-control" name="wholesalePrice"  value="{{ old('wholesalePrice') }}">
                                            @error('wholesalePrice')
                                            <p class="text-danger">{{ $message }}</p> 
                                            @enderror
                                          </div>
                                          
                                         </div>
                                         <div class="col-md-5">
                                                <div class="form-group">
                                                  <label for="">পণ্যের পরিমান</label>
                                                  <input type="number" class="form-control" name="quantity"  value="{{old('quantity')  }}">
                                                  @error('quantity')
                                                  <p class="text-danger">{{ $message }}</p> 
                                                  @enderror
                                                </div>
                                             </div>
                                         </div>
                                           <div class="form-row">
                                             <div class="col-md-5 offset-1">
                                              <div class="form-group">
                                                <label for="">পণ্যের পরিমানের একক (বস্তা/কার্টুন)</label>
                                                 <select name="productQuantityUnit" id="" class="form-control">
                                                     <option value="">বাছাই করুন</option>
                                                     @isset($units)
                                                          @foreach ($units as $unit)
                                                               <option value="{{ $unit->name }}">{{ $unit->name }}</option>
                                                          @endforeach
                                                     @endisset
                                                 </select>
                                                 @error('productQuantityUnit')
                                                 <p class="text-danger">{{ $message }}</p> 
                                                  @enderror
                                                   </div>
                                             </div>
                                             <div class="col-md-5">
                                              <div class="form-group">
                                                <label for="">পণ্যের নির্দেশনার সংখ্যা</label>
                                                 <input type="number" class="form-control" name="alertQuantity"  value="{{  old('alertQuantity')}}">
                                                 @error('alertQuantity')
                                                 <p class="text-danger">{{ $message }}</p> 
                                                 @enderror
                                              </div>
                                                 </div>
                                             </div>
                                             
                                               <div class="form-row">
                                                <div class="col-md-5 offset-1">
                                                  <div class="form-group">
                                                    <label for="">বার কোড</label>
                                                    <input type="number" class="form-control" name="barCode"  value="{{ old('barCode') }}">
                                                    @error('barCode')
                                                    <p class="text-danger">{{ $message }}</p> 
                                                    @enderror
                                                  </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                      <label for="">উৎপাদন তারিখ</label>
                                                        <input type="date" class="form-control engFont" name="produceDate" value="{{ old('produceDate')}}">
                                                        @error('produceDate')
                                                        <p class="text-danger">{{ $message }}</p> 
                                                        @enderror
                                                    </div>
                                                
                                                  </div>
                                                </div>
                                                <div class="form-row">
                                                  <div class="col-md-5 offset-1">
                                                    <div class="form-group">
                                                      <label for="">মেয়াদ উত্তীর্ণ তারিখ</label>
                                                      <input type="date" class="form-control engFont" name="expireDate"  value="{{ old('expireDate') }}">
                                                      @error('expireDate')
                                                      <p class="text-danger">{{ $message }}</p> 
                                                      @enderror
                                                    </div>
                                                  </div>
                                              </div>
                                              
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">জমা করুন</button>
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
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>     
    </div>
    <div class="row my-5 d-flex justify-content-center">
      <div class="col-md-10">
          <div class="card">
                <div class="card-header  text-white" style="box-sizing:border-box">
                    <div class="row d-flex justify-content-center my-5">
                          <div class="col-md-8">
                                  <div class="card">
                                     <div class="card-body">
                                        {{--========================== start search box  =========================--}}

                                          <form action="{{url('admin/search/product')}}" method="post" id="searchProduct">
                                            <div class="row">
                                              <div class=" col-12 form-group">
                                                <label class="text-dark" style="font-size:16px" for="">পণ্যের নাম/বারকোড</label>
                                                  <input type="text" name="" id="" class="form-control form-control-md text-black" placeholder=" " aria-describedby="helpId" onkeyup="searchProduct(this.value)" placeholder="পণ্য খুজুন" style="border-color:#006400">
                                                </div>
                                                <div class="col-12 form-group">
                                                 <label class="text-dark" style="font-size:16px">ক্যাটাগরি</label>
                                                  <select name="category_id" id="category_id" class="form-control form-control-md text-black" onchange="searchProduct(this.value)" style="border-color:#006400">
                                                        <option value="" selected>বাছাই করুন</option>
                                                        @isset($categories)
                                                                    @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                    @endforeach
                                                          @endisset
                                                  </select>
                                                  
                                                </div>
                                              
                                          
                                            </div>
                                          </form>

                                         {{--========================== stop search box  =========================--}}
                                     </div>
                                  </div>
                          </div>
                    </div>
                    <div class="row d-flex justify-content-between">
                          <div class="card-title pl-3 pt-2">
                              <h3 class="font-weight-bold"  style="color: black !important">পণ্যের তালিকা </h3>
                          </div>
                          <div>
                             <button class="btn btn-md btn-primary " data-toggle="modal" data-target="#productaddmodal">পণ্য যোগ করুন</button>
                          </div>
                    </div>
              
                </div>
                <div class="card-body">
                    <div>
                          @if($errors->any())
                            <div class="alert alert-danger">
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
                    <table class="table table-hover text-center text-dark" id="product_table">
                      <thead class="">
                        <tr>
                          <td>সিরিয়াল নাম্বার</td>
                          <td>পণ্যের নাম</td>
                          <td>কোম্পানীর নাম</td>
                          <td>শ্রেণী</td>
                          <td>ছবি</td>
                          <td>কার্যকলাপ</td>
                        </tr>
                      </thead>
                      <tbody>
                        @isset($products)
                           @foreach ($products as $product)
                              
                              {{-- hidden product info --}}
                              <input type="hidden" class="productName_{{ $product->id }}" value="{{ $product->productName }}">
                              <input type="hidden" class="photo_{{ $product->id }}" value="{{ $product->photo }}">
                              <input type="hidden" class="category_name_{{ $product->id }}" value="{{ $product->category->name }}">
                              <input type="hidden" class="category_{{ $product->id }}" value="{{ $product->category_id }}">
                              <input type="hidden" class="company_name_{{ $product->id }}" value="{{ $product->company->name }}">
                              <input type="hidden" class="company_id_{{ $product->id }}" value="{{ $product->company_id }}">
                              <input type="hidden" class="productWeight_{{ $product->id }}" value="{{ $product->productWeight }}">
                              <input type="hidden" class="productWeightUnit_{{ $product->id }}" value="{{ $product->productWeightUnit }}">
                              <input type="hidden" class="productQuantityUnit_{{ $product->id }}" value="{{ $product->productQuantityUnit }}">
                              <input type="hidden" class="buyingPrice_{{ $product->id }}" value="{{ $product->buyingPrice }}">
                              <input type="hidden" class="retailPrice_{{ $product->id }}" value="{{ $product->retailPrice }}">
                              <input type="hidden" class="wholesalePrice_{{ $product->id }}" value="{{ $product->wholesalePrice }}">
                              <input type="hidden" class="quantity_{{ $product->id }}" value="{{ $product->quantity }}">
                              <input type="hidden" class="alertQuantity_{{ $product->id }}" value="{{ $product->alertQuantity }}">
                              <input type="hidden" class="barCode_{{ $product->id }}" value="{{ $product->barCode }}">
                              <input type="hidden" class="expireDate_{{ $product->id }}" value="{{ $product->expireDate }}">
                              <input type="hidden" class="produceDate_{{ $product->id }}" value="{{ $product->produceDate }}">
                              <input type="hidden" class="buyingDate_{{ $product->id }}" value="{{ $product->updated_at }}">
                             
                               <tr>
                                 <td>{{ $loop->index + 1 }}</td>
                                 <td>{{ $product->productName }}</td>
                                 <td>{{ $product->companyName }}</td>
                                 <td>{{ $product->category->name }}</td>
                                 <td><img src="{{ asset('img/products/'.$product->photo) }}" alt="" height="40" width="40">  </td>
                                
                                 <td>
                                   <a href="" onclick="viewProduct({{ $product->id }})" class="btn btn-sm btn-warning text-light  d-inline-block mb-1" data-toggle="modal" data-target="#viewProduct">দেখুন</a>
         
                                   <a href="" onclick="editProduct({{ $product->id }})" class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editProduct">সংশোধন</a>
         
                                   <a href="" onclick="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger d-inline-block mb-1" data-toggle="modal" data-target="#deleteProduct">বাতিল</a>
                                 </td>
                               </tr>
         
                           @endforeach
                        @endisset
                      </tbody>
                 </table>
                    {{ $products->links() }} 
              </div>

          </div>
      </div>
    </div>
    


    <!--product view Modal -->
      <div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProduct" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">পণ্য দেখুন</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
              <div class="view-table">

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল করুন</button>
            
          </div>
        </div>
      </div>
    </div> 
  </div>

 
   
  <!--Edit Modal -->
  <div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProduct" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title " id="editProduct">পণ্য সংশোধন করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="engFont">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="jumbotron">
                <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="product_id" >
                  <div class="form-row">
                    <div class="col-md-5 offset-1">
                        <div class="form-group">
                          <label for=""> পণ্যের নাম</label>
                          <input type="text" class="form-control" name="productName" value="{{ old('productName') }}">
                          @error('productName')
                            <p class="text-danger">{{ $message }}</p> 
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for=""> ছবি</label>
                        <input type="file" class="form-control engFont" name="photo"  accept="image/*">
                        @error('photo')
                        <p class="text-danger">{{ $message }}</p> 
                      @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-5 offset-1">
                        <div class="form-group">
                          <label for="">শ্রেণী</label>
                          <select name="category_id" class="form-control category_id">
                            @isset($categories)
                                @foreach ($categories as $category)
                                <option class="category_option" value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endisset
                          </select>

                          @error('category_id')
                          <p class="text-danger">{{ $message }}</p> 
                          @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                          <label for="">কোম্পানী</label>
                          <select name="company_id" id="" class="form-control">
                            <option selected disabled>বাছাই করুন</option>
                            @isset($companies)
                                @foreach ($companies as $company)
                                <option class="company_option" value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            @endisset
                          </select>

                          @error('company_id')
                          <p class="text-danger">{{ $message }}</p> 
                          @enderror
                        </div>
                    </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-5 offset-1" >
                        <div class="form-group">
                          <label for="">ওজন (প্রতি বস্তায়/কার্টুনে)</label>
                          <input type="number" class="form-control" name="productWeight" value="{{ old('productWeight') }}">
                          @error('productWeight')
                          <p class="text-danger">{{ $message }}</p> 
                            @enderror
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="">ওজনের একক</label>
                            <select name="productWeightUnit" id="" class="form-control">
                                @isset($units)
                                    @foreach ($units as $unit)
                                          <option class="productWeightUnitOption" value="{{ $unit->name }}">{{ $unit->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('productWeightUnit')
                            <p class="text-danger">{{ $message }}</p> 
                            @enderror
                              </div>
                      </div>
                    </div>
                <div class="form-row">
                  <div class="col-md-5 offset-1">
                  <div class="form-group">
                    <label for="">ক্রয় মূল্য (প্রতি বস্তায়/কার্টুনে)</label>
                    <input type="number" class="form-control" name="buyingPrice" value="{{ old('buyingPrice') }}">
                    @error('buyingPrice')
                    <p class="text-danger">{{ $message }}</p> 
                      @enderror
                  </div>
                    
                  </div>
                  <div class="col-md-5">
                  <div class="form-group">
                    <label for="">খুচরা মুল্য (প্রতি কেজিতে)</label>
                    <input type="number" class="form-control" name="retailPrice"  value="{{ old('retailPrice') }}">
                    @error('retailPrice')
                    <p class="text-danger">{{ $message }}</p> 
                    @enderror
                  </div>
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-5 offset-1">
                    <div class="form-group">
                      <label for="">পাইকারি মূল্য (প্রতি বস্তায়/কার্টুনে)</label>
                      <input type="number" class="form-control" name="wholesalePrice"  value="{{ old('wholesalePrice') }}">
                      @error('wholesalePrice')
                      <p class="text-danger">{{ $message }}</p> 
                      @enderror
                    </div>
                    
                    </div>
                    <div class="col-md-5">
                          <div class="form-group">
                            <label for="">পণ্যের পরিমান</label>
                            <input type="number" class="form-control" name="quantity"  value="{{old('quantity')  }}">
                            @error('quantity')
                            <p class="text-danger">{{ $message }}</p> 
                            @enderror
                          </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="col-md-5 offset-1">
                        <div class="form-group">
                          <label for="">পণ্যের পরিমানের একক</label>
                            <select name="productQuantityUnit" id="" class="form-control">
                              
                                @isset($units)
                                    @foreach ($units as $unit)
                                          <option class="productQuantityUnitOption" value="{{ $unit->name }}">{{ $unit->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('productQuantityUnit')
                            <p class="text-danger">{{ $message }}</p> 
                            @enderror
                              </div>
                        </div>
                        <div class="col-md-5">
                        <div class="form-group">
                          <label for="">পণ্যের নির্দেশনার সংখ্যা</label>
                            <input type="number" class="form-control" name="alertQuantity"  value="{{  old('alertQuantity')}}">
                            @error('alertQuantity')
                            <p class="text-danger">{{ $message }}</p> 
                            @enderror
                        </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                         
                          <div class="col-md-5 offset-1">
                            <div class="form-group">
                              <label for="">উৎপাদন তারিখ</label>
                              <input type="date" class="form-control" name="produceDate"  value="{{ old('produceDate') }}">
                              @error('produceDate')
                              <p class="text-danger">{{ $message }}</p> 
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="">মেয়াদ উত্তীর্ণ তারিখ</label>
                              <input type="date" class="form-control" name="expireDate"  value="{{ old('expireDate') }}">
                              @error('expireDate')
                              <p class="text-danger">{{ $message }}</p> 
                              @enderror
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="col-md-5 offset-1 ">
                            <button type="submit" class="text-center btn btn-success">হালনাগাদ করুন</button>
                          </div>
                        </div>
                </form>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
          
        </div>
      </div>
    </div>
  </div>




     <!--Delete Modal -->
     <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProduct" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" class="engFont">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                      <h4 class="text-danger">আপনি কি নিশ্চিত...?</h4> 
                      <form id="deleteForm" action="{{route('admin.product.delete')}}" method="POST">
                        @csrf
                            <input class="product_id" type="hidden" name="product_id">
                      </form>
                        
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">না</button>
            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('deleteForm').submit()" >হ্যা</button>
            
          </div>
        </div>
      </div>
    </div>

  

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script  src="{{ asset('js/product.js') }}"></script>
  
@endsection       
</div>