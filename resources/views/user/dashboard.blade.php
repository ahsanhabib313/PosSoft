@extends('user.master')
@section('title', 'Home Page')
@push('styles')
<link rel="stylesheet" href="{{asset('css/calculator/style.css') }}">
<link rel="stylesheet" href="{{asset('css/home.css') }}">
    
@endpush
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
         
         @include('user.header')
           
    </div>
  </div>
</div> 
                 {{-- start Calculator Modal--}}
                
                    <div class="modal fade" id="calculator-modal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ক্যালকুলেটর</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="engFont">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div id="calculator"></div>
                          </div>
                          <div class="modal-footer">
                           {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  {{-- end Calculator Modal--}}
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
                    <div class="col-sm-5 order-sm-1 order-2" id="category-section">
                       {{--  <div class="row">
                            <div class="col-12"> 
                                
                              <div class="category mt-2 p-2 rounded bg-white d-flex justify-content-lg-between" >
                                <div>
                                  <select class="form-control" id="category_id" onchange="getCompany(this.value)">
                                    <option selected disabled>ক্যাটাগরি বাছাই করুন</option>
                                        @isset($categories)
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{ $category->name }}</option>
                                            @endforeach
                                        @endisset
                                  </select>
                                </div>
                                <div>
                                  <select class="form-control" id="company_id" onchange="getProduct()">
                                    <option selected disabled>কোম্পানী বাছাই করুন</option>
                                        @isset($companies)
                                            @foreach ($companies as $company)
                                            <option value="{{$company->id}}">{{ $company->name }}</option>
                                            @endforeach
                                        @endisset
                                  </select>
                                </div>
                              
                              </div>
                            </div>
                        </div> --}}
                        <div class="row">
                          <div class="col-12">
                            <div class="products">
                              <div class=" d-flex flex-wrap justify-content-start"   id="products_box">

                                @isset($categories)
                                    @foreach ($categories as $category)
                                      <div class="card" style="width: 7.3rem; margin-right:1%;height: 175px;max-height: 175px; cursor:pointer" onclick="getCompany({{$category->id}})">
                                            <img class="card-img-top" src="{{asset('img/category/'.$category->image)}}" alt="category image cap" style="height: 115px; max-height:115px ">
                                            <div class="card-body">
                                              <p class="card-text text-center" style="font-size: 12px">{{$category->name}}</p>
                                            </div>
                                      </div>
                                    @endforeach
                                @endisset
                               
                              </div>
                          </div>   
                        </div> 
                      </div> 
                    </div> 
                     <div class="col-sm-7 order-sm-2 order-1 " id="order-section"> 
                        {{--start order part--}} 
                         <div class="order mt-2 border p-1">
                           <div class="card">
                             <div class="card-body">
                              <h3 class=" text-center font-weight-bold d-none">অর্ডার</h3>
                              <div class="form-row">
                                   <div class=" col-4 form-group"> 
                                     <input type="number" onmouseover="this.focus()" oninput="barCodeFunction(this.value)" name="barCodeScanner" class="form-control" placeholder="বারকোড প্রদান করুন " >
                                   </div>
                                   <div class=" col-4 form-group">
                                    <input type="text"  onmouseover="this.focus()" name="customerName" class="form-control" placeholder="ক্রেতার নাম" >
                                  </div>
                                  <div class=" col-4 form-group"> 
                                    <input type="number"  onmouseover="this.focus()" name="mobileNumber" class="form-control" placeholder="মোবাইল নাম্বার" onblur="searchDebitFunction()">
                                  </div>
                              </div>
                              <div class="form-row ">
                                 
                                  
                              </div>
                               <table class="table table-responsive-lg mt-0 mb-2 text-white  order-table d-1">
                                     <thead>
                                         <th>প্রকার</th>
                                         <th>নাম</th>
                                         <th>পরিমান</th>
                                         <th>একক</th>
                                         <th>দাম</th>
                                         <th>একক দাম</th>
                                         <th>লাভ</th>
                                         <th>কার্যকলাপ</th>
                                     </thead>
                                     <tbody>

                                     </tbody>
                                     <tfoot>
                                       <tr>
                                          {{--  <td  colspan="4"></td> --}}
                                           <td class="text-left text-dark font-weight-bold" colspan="6">মোট বিলঃ </td>
                                           <td colspan="2"><span class="totalPrice">0</span> টাকা
                                             <input type="hidden" name="totalPrice" value="0" min="0">
                                           </td>
                                       </tr>
                                      
                                        <tr class="border">
                                             {{-- <td  colspan="3"></td> --}}
                                             <td  class="text-left text-dark font-weight-bold" colspan="6">ছাড়ঃ 
                                             </td>
                                             <td colspan="2">
                                               <input class="form-control discount" onmouseover="this.focus()" type="number" name="discount" value="0" min="0" onkeyup="discountFunction(this.value)">
                                             </td>
                                       </tr>
                                       <tr>
                                          
                                        <td class="text-left text-dark font-weight-bold" colspan="6">মোট লাভঃ </td>
                                        <td colspan="2"><span class="totalProfit">0</span> টাকা
                                          <input type="hidden" name="totalFirstTermProfit" value="0" min="0">
                                          <input type="hidden" name="totalProfit" value="0" min="0">
                                        </td>
                                    </tr>
                                        <tr>
                                             <td colspan="6" class="text-left text-dark font-weight-bold">ছাড় পরবর্তী মোট বিলঃ</td>
                                             <td colspan="2"><span class="toBePaid">0</span> টাকা
                                               <input type="hidden" name="toBePaid" value="0" min="0">
                                             </td>
                                       </tr>
                                       <tr>
                                        <td colspan="6" class="text-left text-dark font-weight-bold"> আগের বকেয়াঃ  </td>
                                        <td colspan="2"><span class="pastDebit text-danger">0</span> টাকা <span class="debitDate"></span>
                                          <input type="hidden" name="pastDebit" value="0" onchange="changeTotalDebit(this.value)" min="0">
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan="6" class="text-left text-dark font-weight-bold">আগের বকেয়াসহ মোট বিলঃ </td>
                                        <td colspan="2"><span class="totalDebit">0</span> টাকা 
                                          <input type="hidden" name="totalDebit" value="0" min="0">
                                        </td>
                                      </tr>
                                        <tr>
                                           <td colspan="6" class="text-left text-dark font-weight-bold">নগদ গ্রহনঃ </td>
                                           <td colspan="2"><input type="number" name="receivedMoney"  onmouseover="this.focus()"  class="form-control receivedMoney"  oninput="receivedMoneyFunction(this.value)" value="0" min="0"></span>
                                           </td>
                                       </tr>
                                       <tr> 
                                         <td  colspan="6" class="text-left text-dark font-weight-bold">  বর্তমান বকেয়াঃ </td>
                                         <td colspan="2"> <span class="presentDebit">0</span></span><span> টাকা </span>
                                           <input type="hidden" name="presentDebit" value="0" min="0">
                                         </td>
                                       </tr>
                                       <tr>
                                         <td colspan="8" class="text-center">   
                                           <button id="order-btn" class="btn btn-info mt-3">অর্ডার করুন</button>
                                         </td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous">
    </script>
<!-- Core -->
<script src="{{ asset('js/calculator/calculation.js')}} "></script>
<!-- Generate The Calculator -->
<script src="{{ asset('js/calculator/calculator.js')}}"></script>

<script>  


/***** Get all Categories ****/
function getCategories(){

    $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
        });

   $.ajax({

          url:'/user/dashboard/',
          type:'get',
          processData:false,
          contentType:false,
          success: function(data){
             
            $('#products_box').html(data.category_html);
             

          },
          error:function(data){

          }

   });


}

/**   get the company   ***/
function getCompany(value){

  $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
        });

   $.ajax({

          url:'/user/get/company/'+value,
          type:'get',
          processData:false,
          contentType:false,
          success: function(data){
             
            $('#products_box').html(data.company_html);
             

          },
          error:function(data){

          }

   });


}
/*       hide the category section   */
  function hideCategory(data){

    let btn = $(data);

    let hide = btn.attr('hide');
    if(hide == 'off'){
      btn.attr('hide','on');
      btn.html('<i class="fa fa-eye" aria-hidden="true"></i>');
      //hide the category section
      $('#category-section').css('transition','all 1s ease')
      $('#category-section').removeClass('col-sm-5');
      $('#category-section').addClass('d-none');

      //show the full page order section
      $('#order-section').css('transiton', 'all 1s ease');
      $('#order-section').removeClass('col-sm-7');
      $('#order-section').addClass('col-sm-12');

    }
    if(hide =='on'){
      btn.attr('hide','off');
      btn.html('<i class="fa fa-eye-slash" aria-hidden="true"></i>')
       //show the category section
      $('#category-section').css('transition','all 1s ease')
       $('#category-section').addClass('col-sm-5');
      $('#category-section').removeClass('d-none');

      //show the half section order section
      $('#order-section').css('transiton', 'all 1s ease');
      $('#order-section').addClass('col-sm-7');
      $('#order-section').removeClass('col-sm-12');
    }
  }


 //get the product from the dataabse according to category 
  function getProduct(obj){

       let category_id = $(obj).data('category_id');
       let company_id = $(obj).data('company_id');

        //formdata
        var formData = new FormData();
        formData.append('category_id', category_id);
        formData.append('company_id', company_id);

        $.ajaxSetup({
          headers:{
              'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
        });


        $.ajax({
          url:'/user/get/product',
          type:'post',
          data:formData,
          dataType:'json',
          processData:false,
          contentType:false,
          success: function(data){
          
            if(data.status == 'true'){

              //initially empty the product box
            $('#products_box').html('');
            var html
            for(let i=0; i<data.products.length; i++){
                html = '';
                html +='<div class="card product-card" onclick="barCodeFunction('+ data.products[i].barCode+')" style="cursor:pointer;">';
                html +=' <input type="hidden" id="productQuantityUnit_'+data.products[i].id+'" value="'+data.products[i].productQuantityUnit+'">';
                html +=' <input type="hidden" id="manufacture_'+data.products[i].id+'" value="'+data.products[i].manufacture+'">';
                html +=' <input type="hidden" id="productName_'+data.products[i].id+'" value="'+data.products[i].productName+'">';
                html +=' <input type="hidden" id="retailPrice_'+data.products[i].id+'" value="'+data.products[i].retailPrice+'">';
                html +=' <input type="hidden" id="productWeightUnit_'+data.products[i].id+'" value="'+data.products[i].productWeightUnit+'">';
                html +=' <input type="hidden" id="wholesalePrice_'+data.products[i].id+'" value="'+data.products[i].wholesalePrice+'">';
                html +='<img class="card-img-top" src="../img/products/'+data.products[i].photo+'">';
                html +='<div style="font-size:12px" class="card-body text-center d-flex flex-column"><div>';
                html +='<h6 class="productName mb-0 mt-1 text-center">';
                html +=data.products[i].productName+'</h6></div>';
              
                html +='<div class="">';
                html += '<span class="productWeight">ওজন:'+ data.products[i].productWeight+' '+data.products[i].productWeightUnit+'</span></div>';
          
                if(data.products[i].quantity < data.products[i].alertQuantity && data.products[i].quantity > 0){

                  html +='<div><span class="text-warning" >স্টকে আছেঃ '+data.products[i].quantity+' '+ data.products[i].productQuantityUnit+'</span></div></div>';

                }else if(data.products[i].quantity < 1){
                  html +='<div><span class=" text-danger" >স্টকে আছেঃ '+data.products[i].quantity+' '+ data.products[i].productQuantityUnit+'</span></div></div>';
                }else{
                  html +='<div><span class=" text-info" >স্টকে আছেঃ '+data.products[i].quantity+' '+ data.products[i].productQuantityUnit+'</span></div></div>';

                }
                //$('.category').hide();
                $('#products_box').html(html);
                                                                
            }
            }else{

              $('#products_box').html(`<h2 class="text-center text-danger">${data.products}</h1>`);
            }
            
          },
          error: function(data){

          }

});
}


/************** Home page **************/
/*total price function executon*/

function totalPrice(){

  var total = 0;
      $('.order-table tbody tr').find('input.productUnitPrice').each(function(){
        total += parseFloat($(this).val());

       // console.log(total);
        
      })

      var totalProfit = 0;
      $('.order-table tbody tr').find('input.unitProfit').each(function(){
        totalProfit += parseFloat($(this).val());
        
      })
      

      //set the total price 
      $('.totalPrice').text(total);
      $('input[name="totalPrice"]').val(total);

      //set the total price 
      $('.totalProfit').text(totalProfit);
      $('input[name="totalProfit"]').val(totalProfit);
      $('input[name="totalFirstTermProfit"]').val(totalProfit);

      // after discount total price 
      var discount = $('input[name="discount"]').val();
      discountFunction(discount);
 
}

//total amount after discount
function discountFunction(discount){
      

      if(discount == ''){
        discount = 0;
      }
     
      var totalPrice = $('input[name="totalPrice"]').val();
     
      if(totalPrice == 'NaN'){
        totalPrice = 0;
      }
      var totalFirstTermProfit = $('input[name="totalFirstTermProfit"]').val();
      
      if(totalFirstTermProfit == 'NaN'){
        totalFirstTermProfit = 0;
      }
      var afterDiscountTotalPrice  =parseFloat(totalPrice)  -parseFloat(discount) ;
      var afterDiscountTotalProfit  =parseFloat(totalFirstTermProfit)  - parseFloat(discount) ;

     
      //set the total price after discount
      $('.toBePaid').text(afterDiscountTotalPrice);
      $('input[name="toBePaid"]').val(afterDiscountTotalPrice);

      //set the total profit after discount
      $('.totalProfit').text(afterDiscountTotalProfit);
      $('input[name="totalProfit"]').val(afterDiscountTotalProfit);

      //get the received money
      var receivedMoney = $('input[name="receivedMoney"]').val();
      receivedMoneyFunction(receivedMoney);

    
}


// calcuation the debit 

function receivedMoneyFunction(receivedMoney){
     
     let money = receivedMoney;
      
     if(money == ''){
          money = 0;
     }
     
      let toBePaid  = $('input[name=toBePaid]').val();
          toBePaid  =(toBePaid);

      let pastDebit = $('input[name=pastDebit]').val();
      let totalDebit =(toBePaid) +(pastDebit) ;
    
      $('.totalDebit').text(totalDebit);
      $('input[name=totalDebit]').val(totalDebit);  

      
      let presentDebit =(totalDebit) -(money);
      presentDebit =(presentDebit); 

      $('.presentDebit').text(presentDebit);
      $('input[name=presentDebit]').val(presentDebit);      
 
    
}


// change total debit 
function changeTotalDebit(pastDebit){

      let presentDebit = parseFloat($('input[name=presentDebit]').val());
      let totalDebit = parseFloat(presentDebit)  + parseFloat(pastDebit) ;

      $('.totalDebit').text(totalDebit);
      $('input[name=totalDebit]').val(totalDebit);

} 
//change the quantity in the order section
function editQuantity(id){

      var quantity= $('.order-table tbody tr').find('.productQuantity_'+id).val();
      var productPrice =$('.order-table tbody tr').find('input.productPrice_'+id).val();
      var profit =$('.order-table tbody tr').find('input.profit_'+id).val();

      productPrice =(productPrice);
      var productUnitPrice = quantity * productPrice;
          productUnitPrice =(productUnitPrice);

      profit =(profit);
      var unitProfit = quantity * profit;
          unitProfit =(unitProfit);

      $('.order-table tbody tr').find('.productUnitPrice_'+id).text(productUnitPrice);
      $('.order-table tbody tr').find('input.productUnitPrice_'+id).val(productUnitPrice);

      $('.order-table tbody tr').find('.profit_'+id).text(unitProfit);
      $('.order-table tbody tr').find('input.unitProfit_'+id).val(unitProfit);
     

      //get the total price
      totalPrice();

}

//delete the product in the order table
function deleteProduct(id){
      $('#delete-product_'+id).parent().parent().remove();
      //get the total price
      totalPrice();

}

// get the debit , search by mobile number
function searchDebitFunction(){

      var mobileNumber = $('input[name=mobileNumber]').val();

      var data = new FormData();
      data.append('mobileNumber', mobileNumber);

      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      // store data using ajax
      $.ajax({
      url: '/user/search/debit',
      type: 'POST',
      data: data,
      processData: false,
      contentType: false,
      success: function(data){
       
            $('input[name="customerName"]').val(data.name);
            $('.pastDebit').text(data.pastDebit);
            $('.debitDate').text('('+data.debitDate+')');
            $('input[name=pastDebit]').val(data.pastDebit);
            //get the total price
            
            changeTotalDebit(data.pastDebit);
            totalPrice();
      },
      error: function(data){
            console.log(data);
      }

  });
}

// retireave data according to barcode

function barCodeFunction(value){

      var barCode =(value) ;

      let checkBarCode = document.querySelector(`.tr_${barCode}`);

      if(checkBarCode){

         let product_id = $('.tr_'+barCode).find('.product_id').val();
    
         let prodQuantity = $('.tr_'+barCode).find('.quantity').val();

         prodQuantity = parseInt(prodQuantity) +  1;

         $('.tr_'+barCode).find('.quantity').val(prodQuantity);

         editQuantity(product_id);

         $('input[name=barCodeScanner]').val(null); 

      }else{

        
          var data = new FormData();
          data.append('barCode', barCode);

          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          });
          // store data using ajax
          $.ajax({
          url: '/user/search/orderItem/barcode',
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          success: function(data){
            if(data ==  false){

          }else{

                let product = '';
                product += '<tr class="tr_'+data[0].barCode+'">';
                product += '<td><select class ="form-control sell_type_id"  onchange="sellTypeFunction(this.value,'+data[0].id+')">';
                product += '<option seleced value="'+data[1][0].id+'">'+data[1][0].name+'</option>';
                product += '<option  value="'+data[1][1].id+'">'+data[1][1].name+'</option>';
                product +=  '</select></td>';
                product += '<td>'+data[0].productName+'</td>';

                product += '<input type="hidden"  class="product_id" value="'+data[0].id+'">';
                product += '<input type="hidden" class="productName" value="'+data[0].productName+'">';
                product += '<input type="hidden" class="manufacture" value="'+data[0].manufacture+'">';

                product += '<td><input type="number" value="1" class="quantity border-1 productQuantity_'+data[0].id+'" min="1" oninput="editQuantity('+data[0].id+')"></td>';
                if(data[0].manufacture == 1){

                  product += '<td class="productUnit_'+data[0].id+'">'+data[0].productQuantityUnit+'</td>';
                  product += '<input type="hidden" class="productUnit" value="'+data[0].productQuantityUnit+'">';

                }else{

                  product += '<td class="productUnit_'+data[0].id+'">'+data[0].productWeightUnit+'</td>';
                  product += '<input type="hidden" class="productUnit" value="'+data[0].productWeightUnit+'">';

                }
          
                product += '<td class="productPrice_'+data[0].id+'">'+data[0].retailPrice+'</td>';
               
                product += '<input type="hidden"  class="profit profit_'+data[0].id+'" value="'+data[0].retailProfit+'">';
                product += '<input type="hidden"  class="unitProfit unitProfit_'+data[0].id+'" value="'+data[0].retailProfit+'">';
                product += '<td  class="productUnitPrice_'+data[0].id+'">'+data[0].retailPrice+'</td>';
                product += '<input type="hidden" class="productUnitPrice productUnitPrice_'+data[0].id+'"  value="'+data[0].retailPrice+'">';
                product += '<td  class="profit profit_'+data[0].id+'">'+data[0].retailProfit+'</td>';
                product += '<input type="hidden"  class="productPrice productPrice_'+data[0].id+'" value="'+data[0].retailPrice+'">';
                product += '<td><a id="delete-product_'+data[0].id+'"  class="btn btn-danger " onclick="deleteProduct('+data[0].id+')" ><i class="fa fa-trash-alt text-white"></i></a></td>';
                product += '</tr>';
                  
                $('.order-table tbody').append(product);

                totalPrice()
              
                $('input[name=barCodeScanner]').val(null); 
            
          }
          },
          error: function(data){
                console.log(data);
          }

          })

      }

      

}

// decide the product price according to selltype
function sellTypeFunction(sell_type_id, product_id){

      var sell_type_id = sell_type_id;
      var product_id = product_id;

      var data = new FormData();

      data.append('sell_type_id', sell_type_id);
      data.append('product_id', product_id);

      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      // store data using ajax
      $.ajax({
          url: '/user/sellType/product/wholesaleprice',
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          success: function(data){
          
            var id = data.id;
            var price = data.price;
            var unit = data.unit;
            var profit = data.profit;

            $('.order-table tbody').find('.productPrice_'+id).text(price);
            $('.order-table tbody').find('.productPrice').val(price);
            $('.order-table tbody').find('.productUnit_'+id).text(unit);
            $('.order-table tbody').find('.productUnit').val(unit);
            $('.order-table tbody').find('.profit_'+id).text(profit);
            $('.order-table tbody').find('.profit').val(profit);
            
            //call the edit quantity function
            editQuantity(id)
            //call the total price function
            totalPrice()
      },
      error: function(data){
            console.log(data)
      }
      });
}

 function convertEngToBangla(value){
  
    value = String(value).split('');

    let length = value.length;

    for(let i = 0; i < length; i++){
        
        if(Number(value[i]) == 0){
          value[i] = '০';
        }else if(Number(value[i]) == 1){
          value[i] = '১';
        }else if(Number(value[i]) == 2){
          value[i] ='২';
        }
        else if(Number(value[i]) == 3){
          value[i] ='৩';
        }
        else if(Number(value[i]) == 4){
          value[i] ='৪';
        }else if(Number(value[i]) == 5){
          value[i] ='৫';
        }else if(Number(value[i]) == 6){
          value[i] ='৬';
        }else if(Number(value[i]) == 7){
          value[i] ='৭';
        }else if(Number(value[i]) == 8){
          value[i] ='৮';
        }else if(Number(value[i]) == 9){
          value[i] ='৯';
        }
      }

     value = value.toString();
     return value.replaceAll(',','');
    }
    
//get all informations about order
$(document).on('click','#order-btn',function(e){

      e.preventDefault();

      var customerName = $('input[name=customerName]').val();
      var mobileNumber = $('input[name=mobileNumber]').val();

      var product_id = [];
      $('.order  .order-table .product_id').each(function(index){

            product_id[index]=$(this).val();
      })

      var productName = [];
      $('.order  .order-table .productName').each(function(index){

            productName[index]=$(this).val();
      })

      var quantity = [];
      $('.order  .order-table .quantity').each(function(index){

            quantity[index]=$(this).val();
      })

      var sell_type_id = [];
      $('.order  .order-table .sell_type_id').each(function(index){

          sell_type_id[index]=$(this).val();
      })
  
      var manufacture = [];
      $('.order  .order-table .manufacture').each(function(index){

          manufacture[index]=$(this).val();
      })

      var productPrice = [];
      $('.order  .order-table .productPrice').each(function(index){

          productPrice[index]=$(this).val();
      }); 

      var productUnitPrice = [];
      $('.order  .order-table .productUnitPrice').each(function(index){

          productUnitPrice[index]=$(this).val();
      }); 
      var productUnit = [];
      $('.order  .order-table .productUnit').each(function(index){

          productUnit[index]=$(this).val();
      }); 

  
      var totalPrice =  $('input[name="totalPrice"]').val();
      var presentDebit =  $('input[name="presentDebit"]').val();

      if(presentDebit !=0 && mobileNumber == ''){
        $('#order-btn').text('বকেয়া আছে, মোবাইল নাম্বার দিন!!!');
        $('#order-btn').removeClass('btn-info');
        $('#order-btn').addClass('btn-danger');


        setTimeout(() => {
          $('#order-btn').text('অর্ডার করুন');
          $('#order-btn').removeClass('btn-danger');
          $('#order-btn').addClass('btn-info');
        }, 1000);

        return;
        
      }
      if(totalPrice == 0){
        $('#order-btn').text('লেনদেন করুন!!!');
        $('#order-btn').removeClass('btn-info');
        $('#order-btn').addClass('btn-danger');

        setTimeout(() => {
          $('#order-btn').text('অর্ডার করুন');
          $('#order-btn').removeClass('btn-danger');
          $('#order-btn').addClass('btn-info');
        }, 1000);

        return;
        
      }



    // create a formData instance for sending data as form data
      var data = new FormData();

      data.append('customerName', customerName);
      data.append('mobileNumber', mobileNumber);
      data.append('product_id', product_id);
      data.append('sell_type_id', sell_type_id);
      data.append('manufacture', manufacture);
      data.append('productName', productName);
      data.append('quantity', quantity);
      data.append('productPrice', productPrice);
      data.append('productUnitPrice', productUnitPrice);
      data.append('productUnit', productUnit);
      data.append('totalPrice', totalPrice);
      data.append('debit', presentDebit);

  //csrf token 
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        // store data using ajax
        $.ajax({
          url: '/user/order/confirm',
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          success: function(data){
                if(data == true){
                    var customerName = $('input[name=customerName]').val();
                    var mobileNumber = convertEngToBangla( $('input[name=mobileNumber]').val());
                    var totalPrice = convertEngToBangla($('input[name="totalPrice"]').val());
                    var discount = convertEngToBangla($('input[name=discount]').val());
                    var toBePaid = convertEngToBangla($('input[name=toBePaid]').val());
                    var receivedMoney = convertEngToBangla($('input[name=receivedMoney]').val());
                    var presentDebit = convertEngToBangla($('input[name="presentDebit"]').val());
                    var pastDebit = convertEngToBangla($('input[name="pastDebit"]').val());
                    var totalDebit = convertEngToBangla($('input[name="totalDebit"]').val());
                  
                    //csrf token 
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                      });
                    
               //call the ajax for get the invoice pdf
               $.ajax({
                    url:'/user/get/invoice/pdf',
                    type:'GET',
                    success: function(response){

                             let date = new Date(response.order.created_at);
                              date= JSON.stringify(date);
                              date= date.replace(/[a-zA-z]/g, ' ');
                              date= date.substr(1,10);
                              var html = ''
                              html += '<table style="border:none;width:100%; text-align:center">';
                              html +='<tr><td><h5>মেসার্স তারক ভান্ডার</h5></td></tr>'
                              html +='<tr><td><h5> কাপড়িয়া পট্রি, হাজিগঞ্জ বাজার, হাজিগঞ্জ, চাঁদপুর</h5></td></tr>'
                              html +='<tr><td><h5>প্রতিষ্ঠাতাঃ মাধব লাল বণিক</h5> </td></tr>'
                              html +='<tr><td><h5>পরিচালকঃ উৎপল বণিক (পলাশ)</h5> </td></tr>'
                              html +='<tr><td>মোবাইলঃ ০১৭১২-১৭৫০১৬</td></tr>'
                              html +='<tr><td>ক্রেতার কপি</td></tr>'
                              html +='<tr><td>ক্যাশ মেমো</td></tr>'
                              html +='<tr><td><hr style="border-top: 1px dashed black"></td></tr>'
                             
                              html +='<tr style="text-align:left"><td><h5>অর্ডার নং: '+convertEngToBangla(response.order.id)+'</h5></td></tr>'
                              html +='<tr style="text-align:left"><td><h5>তারিখ: '+convertEngToBangla(date)+'</h5></td></tr>'
                              html +='<tr style="text-align:left"><td><h5>ক্রেতার নাম: '+customerName+'</h5></td></tr>'
                              html +='<tr style="text-align:left"><td><h5>মোবাইল নাম্বার: '+convertEngToBangla(mobileNumber)+'</h5></td></tr>'
                              html +='<tr><td></td></tr>'
                              html +='</table>'
                              html +='<hr>'
                              html += '<table style="width:100%; border:1px solid #333; border-collapse: collapse; text-align:left">'
                              html +='<tr style="border:1px solid #333;"><td>পণ্যের নাম</td><td>পরিমান</td><td>একক</td><td>দাম</td><td>একক দাম</td>'
                              html += '</tr>'

                              for(var i=0; i<response.order_items.length; i++){ 
                                        
                                        html +='<tr style="border:1px solid #333;"><td>'+response.order_items[i].product.productName+'</td><td>'+convertEngToBangla(response.order_items[i].quantity)+'</td><td>'+convertEngToBangla(response.order_items[i].productUnit)+'</td><td>'+convertEngToBangla(response.order_items[i].productPrice)+'</td> <td>'+convertEngToBangla(response.order_items[i].productUnitPrice)+'</td></tr>'

                              }
                              
                              html += '<tr style="border:1px solid #333;"><td colspan="5">&nbsp;</td></tr>'
                              html += '<tr style="border:1px solid #333;"><td colspan="5">&nbsp;</td></tr>'
                              html += '<tr style="border:1px solid #333;"><td colspan="5">&nbsp;</td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>মোট বিলঃ<span>'+ totalPrice +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>ছাড়ঃ <span>'+ discount +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>ছাড় পরবর্তী মোট বিলঃ <span>'+ toBePaid +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>আগের বকেয়াঃ <span>'+ pastDebit +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>মোট বকেয়াঃ <span>'+ totalDebit +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>পরিশোধ করেছেঃ <span>'+ receivedMoney +'</span></p></td></tr>'
                              html += '<tr  style="border:1px solid #333;" ><td colspan="2"></td><td colspan="3"><p>বর্তমান বকেয়াঃ <span>'+ presentDebit +'</span></p></td></tr>'

                              html +='</table>'

                              var originalContent = document.body.innerHTML;
                              document.body.innerHTML = html;
                              window.print();
                              document.body.innerHTML = originalContent;
                              
                              $('input[name=customerName]').val(null);
                              $('input[name=mobileNumber]').val(null);
                              $('.order .order-table tbody').html('');
                              $('input[name="totalPrice"]').val(null);
                              $('.totalPrice').text(0);
                              $('input[name=discount]').val(0);
                              $('.toBePaid').text(0);
                              $('input[name=toBePaid]').val(0);
                              $('input[name=receivedMoney]').val(0);
                              $('input[name="pastDebit"]').val(0);
                              $('.pastDebit').text(0);
                              $('.debitDate').text('');
                              $('input[name="presentDebit"]').val(0);
                              $('.presentDebit').text(0);
                              $('input[name="totalDebit"]').val(0);
                              $('.totalDebit').text(0); 
                              $('.totalProfit').text(0); 
                              $('input[name="totalProfit"]').val(0);
                              $('#products_box').html('');
                        

                         
                    },
                    error: function(){
                         console.log(data);
                    }
               });

          }
     },
     error: function(data){
          console.log(data);
     }

   })
})


</script>
@endsection

