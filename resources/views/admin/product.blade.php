@extends('admin.layout.adminPanel')
@section('title', 'Products')
@section('content')
  <div class="container">
    <div class="row d-flex justify-content-between">
      <div>
        <h3 class="text-dark">All Product List</h3> 
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
         <button class="btn btn-md btn-success " data-toggle="modal" data-target="#productaddmodal">Add Product</button>

      </div>
     
        <!-- Modal -->
        <div class="modal fade" id="productaddmodal" tabindex="-1" aria-labelledby="productaddmodal" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
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
                                      <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                                               <input type="file" class="form-control" name="photo"  accept="image/*">
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
                                                <select name="category_id" id="" class="form-control">
                                                  <option selected disabled>শ্রেণী নির্ধারন করুন</option>
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
                                              <label for="">কোম্পানির নাম</label>
                                               <input type="text" class="form-control" name="companyName" value="{{ old('companyName')}}"">
                                              @error('companyName')
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
                                            <input type="number" class="form-control" name="buyingPrice" value="{{  old('buyingPrice')}}"">
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
                                                     <label for="">মেয়াদ উত্তীর্ণ তারিখ</label>
                                                      <input type="date" class="form-control" name="expireDate" value="{{ old('expireDate')}}"">
                                                      @error('expireDate')
                                                      <p class="text-danger">{{ $message }}</p> 
                                                      @enderror
                                                      </div>
                                                      </div>
                                                  </div>
                                              <div class="form-row">
                                                <div class="col-md-5 offset-1 ">
                                                  <button type="submit" class="text-center btn btn-success">Save Product</button>
                                                </div>
                                              </div>
                                      </form>
                                    </div>
                            </div>
                            <div class="tab-pane container fade p-4" id="unmanufactured">
                              <div class="jumbotron">
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <input type="file" class="form-control" name="photo"  accept="image/*">
                                        @error('photo')
                                        <p class="text-danger">{{ $message }}</p> 
                                      @enderror
                                      </div>
                                    </div>
                                 </div>
                                 <div class="form-row">
                                   <div class="col-md-5 offset-1">
                                       <div class="form-group">
                                         <label for=""> পণ্যের শ্রেণী</label>
                                         <select name="category_id" id="" class="form-control">
                                           <option selected disabled>শ্রেণী নির্ধারন করুন</option>
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
                                       <label for="">কোম্পানীর নাম</label>
                                        <input type="text" class="form-control" name="companyName" value="{{ old('companyName') }}">
                                       @error('companyName')
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
                                               <option value="">একক নির্ধারন করুন</option>
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
                                            <button type="submit" class="text-center btn btn-success">Save Product</button>
                                          </div>
                                        </div>
                                </form>
                              </div>
                      </div>
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
     
    </div>
    <div class="row my-5">
      <div class="col-md-12">
        <table class="table text-center table-dark table-hover">
             <thead class="">
               <tr>
                 <td>সিরিয়াল নাম্বার</td>
                 <td>পণ্যের নাম</td>
                 <td>কোম্পানীর নাম</td>
                 <td>শ্রেণী</td>
                 <td>ছবি</td>
                 <td>Action</td>
               </tr>
             </thead>
             <tbody>
               @isset($products)
                  @foreach ($products as $product)
                     
                     {{-- hidden product info --}}
                     <input type="hidden" class="productName_{{ $product->id }}" value="{{ $product->productName }}">
                     <input type="hidden" class="photo_{{ $product->id }}" value="{{ $product->photo }}">
                     <input type="hidden" class="category_{{ $product->id }}" value="{{ $product->category->name }}">
                     <input type="hidden" class="companyName_{{ $product->id }}" value="{{ $product->companyName }}">
                     <input type="hidden" class="productWeight_{{ $product->id }}" value="{{ $product->productWeight }}">
                     <input type="hidden" class="productWeightUnit_{{ $product->id }}" value="{{ $product->productWeightUnit }}">
                     <input type="hidden" class="buyingPrice_{{ $product->id }}" value="{{ $product->buyingPrice }}">
                     <input type="hidden" class="retailPrice_{{ $product->id }}" value="{{ $product->retailPrice }}">
                     <input type="hidden" class="wholesalePrice_{{ $product->id }}" value="{{ $product->wholesalePrice }}">
                     <input type="hidden" class="quantity_{{ $product->id }}" value="{{ $product->quantity }}">
                     <input type="hidden" class="productQuantityUnit_{{ $product->id }}" value="{{ $product->productQuantityUnit }}">
                     <input type="hidden" class="alertQuantity_{{ $product->id }}" value="{{ $product->alertQuantity }}">
                     <input type="hidden" class="barCode_{{ $product->id }}" value="{{ $product->barCode }}">
                     <input type="hidden" class="expireDate_{{ $product->id }}" value="{{ $product->expireDate }}">
                     <input type="hidden" class="buyingDate_{{ $product->id }}" value="{{ $product->updated_at }}">
                    
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->productName }}</td>
                        <td>{{ $product->companyName }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td><img src="{{ asset('img/products/'.$product->photo) }}" alt="" height="40" width="40">  </td>
                       
                        <td>
                          <a href="" onclick="viewProduct({{ $product->id }})" class="btn btn-sm btn-warning text-light  d-inline-block mb-1" data-toggle="modal" data-target="#viewProduct"><i class="fas fa-eye"></i></a>

                          <a href="" onclick="editProduct({{ $product->id }})" class="btn btn-sm btn-info d-inline-block mb-1" data-toggle="modal" data-target="#editProduct"><i class="far fa-edit"></i></a>

                          <a href="" onclick="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger d-inline-block mb-1" data-toggle="modal" data-target="#deleteProduct"><i class="far  fa-trash-alt"></i></a>
                        </td>
                      </tr>

                  @endforeach
               @endisset
             </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>

     <!--product view Modal -->
      <div class="modal fade" id="viewProduct" tabindex="-1" aria-labelledby="viewProduct" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="">পণ্য দেখুন</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
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
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                                <div class="jumbotron">
                                  <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
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
                                          <input type="file" class="form-control" name="photo"  accept="image/*">
                                          @error('photo')
                                          <p class="text-danger">{{ $message }}</p> 
                                        @enderror
                                        </div>
                                      </div>
                                   </div>
                                   <div class="form-row">
                                     <div class="col-md-5 offset-1">
                                         <div class="form-group">
                                           <label for="">ক্যাটাগরি</label>
                                           <select name="category_id" id="" class="form-control">
                                             <option selected disabled>ক্যাটাগরি নির্ধারন করুন</option>
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
                                         <label for="">কোম্পানীর নাম</label>
                                          <input type="text" class="form-control" name="companyName" value="{{ old('companyName') }}">
                                         @error('companyName')
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
                                                 <option value="">একক নির্ধারন করুন</option>
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
                                              <button type="submit" class="text-center btn btn-success">Save Product</button>
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
     <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProduct" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
           {{--  <h5 class="modal-title " id="editProduct">Delete Product</h5> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                         
                                <h4 class="text-danger">Are You Sure ?</h4> 
                        
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" >Delete</button>
            
          </div>
        </div>
      </div>
    </div>

    
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
  <script  src="{{ asset('js/product.js') }}"></script>
@endsection       