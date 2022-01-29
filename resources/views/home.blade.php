@extends('master')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
         
         @include('partials.header')
           
    </div>
  </div>
</div> 
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
            <div class="row d-flex">
                    <div class="col-sm-5 order-sm-1 order-2">
                        <div class="row">
                            <div class="col-12"> 
                                {{--start product part--}} 
                              <div class="category mt-2 p-2 rounded bg-white " >
                              
                                   <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    @isset($categories)
                                      @foreach ($categories as $category)
                                          <li class="nav-item">
                                            <a href="#" class="nav-link  text-dark font-weight-bold active" onclick="getProduct('{{$category->id}}')">{{ $category->name }}</a>
                                          </li>
                                      @endforeach
                                    @endisset
                                  </ul> 
                              </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class=" products">
                              <div class=" d-flex flex-wrap justify-content-start"   id="products_box">
                              </div>
                          </div>   
                        </div> 
                      </div> 
                    </div> 
                     <div class="col-sm-7 order-sm-2 order-1 "> 
                        {{--start order part--}} 
                         <div class="order mt-2 border p-1">
                           <div class="card">
                             <div class="card-body">
                              <h3 class=" text-center font-weight-bold ">অর্ডার</h3>
                              <div class="form-row">
                                   <div class=" col-4 form-group"> 
                                     <input type="text" onmouseover="this.focus()" oninput="barCodeFunction(this.value)" name="barCodeScanner" class="form-control" placeholder="বারকোড প্রদান করুন " >
                                   </div>
                                   
                                  
                              </div>
                              <div class="form-row ">
                                   <div class=" col-6 form-group">
                                     <input type="text"  onmouseover="this.focus()" name="customerName" class="form-control" placeholder="ক্রেতার নাম" >
                                   </div>
                                   <div class=" col-6 form-group"> 
                                     <input type="text"  onmouseover="this.focus()" name="mobileNumber" class="form-control" placeholder="মোবাইল নাম্বার" oninput="searchDebitFunction()">
                                   </div>
                              </div>
                             
                               <table class="table table-responsive-lg mt-0 mb-2 text-white  order-table d-1">
                                     <thead>
                                         <th>বিক্রির ধরণ</th>
                                         <th>পণ্যের নাম</th>
                                         <th>পরিমান</th>
                                         <th>একক</th>
                                         <th>দাম</th>
                                         <th>একক দাম</th>
                                         <th>কার্যকলাপ</th>
                                     </thead>
                                     <tbody>
                                          
                                     </tbody>
                                     <tfoot>
                                       <tr>
                                           <td  colspan="4"></td>
                                           <td class="text-center text-dark font-weight-bold">মোট বিলঃ </td>
                                           <td colspan="2"><span class="totalPrice">0</span> টাকা
                                             <input type="hidden" name="totalPrice">
                                           </td>
                                       </tr>
                                        <tr>
                                             <td  colspan="3"></td>
                                             <td colspan="2" class="text-center text-dark font-weight-bold">ডিসকাউন্টঃ 
                                             </td>
                                             <td colspan="2">
                                               <input class="form-control discount" onmouseover="this.focus()" type="number" name="discount" value="0" min="0" onchange="discountFunction(this.value)">%
                                             </td>
                                       </tr>
                                        <tr>
                                             
                                             <td colspan="5" class="text-right text-dark font-weight-bold">পরিশোধ করতে হবেঃ</td>
                                             <td colspan="2"><span class="toBePaid">0</span> টাকা
                                               <input type="hidden" name="toBePaid">
                                             </td>
                                       </tr>
                                        <tr>
                                          
                                           <td colspan="5" class="text-right text-dark font-weight-bold">গ্রহণকৃত টাকাঃ </td>
                                           <td colspan="2"><input type="text" name="receivedMoney"  onmouseover="this.focus()"  class="form-control receivedMoney"  oninput="receivedMoneyFunction(this.value)" value="0"></span>
                                             
                                           </td>
                                       </tr>
                                       <tr>
                                         
                                         <td  colspan="5" class="text-right text-dark font-weight-bold">  বর্তমান বকেয়াঃ </td>
                                         <td colspan="2"> <span class="presentDebit">0</span></span><span> টাকা </span>
                                           <input type="hidden" name="presentDebit">
                                         </td>
                                       </tr>
                                       <tr>
                                         
                                         <td colspan="5" class="text-right text-dark font-weight-bold"> আগের বকেয়াঃ  </td>
                                         <td colspan="2"><span class="pastDebit text-danger">0</span> টাকা 
                                           <input type="hidden" name="pastDebit" value="0" onchange="changeTotalDebit(this.value)">
                                         </td>
                                       </tr>
                                       <tr>
                                        
                                         <td colspan="5" class="text-right text-dark font-weight-bold">মোট বকেয়াঃ </td>
                                         <td colspan="2"><span class="totalDebit">0</span> টাকা 
                                           <input type="hidden" name="totalDebit">
                                         </td>
                                       </tr>
   
                                       <tr>
                                         <td colspan="5" class="text-right">   
                                           <button id="order-btn" class="btn btn-success mt-3">অর্ডার করুন</button>
                                           <input id="print_btn" class="btn btn-danger" type="hidden" data-toggle="modal" data-target="#printInvoiceModal">
                                         </td>
                                          <td colspan="2"> <button id="draft-btn" class="btn btn-info mt-3">ড্রাফট করুন</button></td>
                                       </tr>
                                     </tfoot>
                                    
                               </table>
                             </div>
                           </div>
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
    <script  src="{{ asset('js/orderConfirm.js') }}"></script>
    <script  src="{{ asset('js/draftConfirm.js') }}"></script>

  
@endsection

