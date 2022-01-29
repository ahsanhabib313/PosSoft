//csrf token 
$.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   });
//get all informations about order
$('#order-btn').click(function(){
   
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
   var totalDebit =  $('input[name="totalDebit"]').val();

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
  data.append('debit', totalDebit);

   // store data using ajax
   $.ajax({
     url: '/order/confirm',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
     success: function(data){
          if(data == true){

               var customerName = $('input[name=customerName]').val();
               var mobileNumber = $('input[name=mobileNumber]').val();
               var totalPrice = $('input[name="totalPrice"]').val();
               var discount = $('input[name=discount]').val();
               var toBePaid = $('input[name=toBePaid]').val();
               var receivedMoney = $('input[name=receivedMoney]').val();
               var presentDebit = $('input[name="presentDebit"]').val();
               var pastDebit = $('input[name="pastDebit"]').val();
               var totalDebit = $('input[name="totalDebit"]').val();
              
               
               //call the ajax for get the invoice pdf
               $.ajax({
                    url:'get/invoice/pdf',
                    type:'GET',
                    success: function(response){
                         
                              var html = ''
                              html += '<h4 class="text-center">মেসার্স তারক ভান্ডার</h4>'
                              html += '<h5 class="text-center">কাপড়িয়া পট্রি, হাজিগঞ্জ বাজার, হাজিগঞ্জ, চাঁদপুর</h5>'
                              html += '<h5 class="text-center">প্রতিষ্ঠাতাঃ মাধব লাল বণিক</h5>'
                              html += '<h5 class="text-center">পরিচালকঃ উৎপল বণিক (পলাশ)</h5>'
                              html += '<h5 class="text-center">মোবাইলঃ ০১৭১২-১৭৫০১৬</h5>'
                              html += '<h5 class="text-center">ক্রেতার কপি</h5>'
                              html += '<h5 class="text-center font-weight-bold">ক্যাশ মেমো</h5>'
                              html += '<hr style="border-top: 1px dashed black">'
                              html += '<div><h5>অর্ডার নং: '
                              html += response.order.id
                              html += '</h5><h5>তারিখ: '
                              html += response.order.created_at;
                              html += '</h5> <h5>ক্রেতার নাম: '
                              html += customerName;
                              html += ' </h5><h5>মোবাইল নাম্বার: '
                              html += mobileNumber;
                              html += '</h5></div><hr><div>'
                              html += '<table class="table table-bordered"  style="border-collapse: collapse; text-align:center; ">'
                              html +='<thead><tr><td>পণ্যের নাম</td><td>পরিমান</td><td>দাম</td><td>একক দাম</td>'
                              html += '<td>একক</td></tr></thead><tbody>'

                              for(var i=0; i<response.order_items.length; i++){ 
                                        
                                        html +='<tr><td>'
                                        html += response.order_items[i].product.productName
                                        html +='</td><td>'
                                        html += response.order_items[i].quantity
                                        html += '</td><td>'
                                        html += response.order_items[i].productPrice
                                        html += '</td> <td>'
                                        html += response.order_items[i].productUnitPrice
                                        html += '</td><td>'
                                        html +=response.order_items[i].productUnit
                                        html += '</td></tr>'

                              }
                              html +='</tbody></table></div></div></div>'
                              html += '<p class="text-right">সর্বমোট মূল্যঃ <span>'+ totalPrice +'</span></p>'
                              html += '<p class="text-right">ডিসকাউন্টঃ <span>'+ discount +'</span></p>'
                              html += '<p class="text-right">পরিশোধ করতে হবেঃ <span>'+ toBePaid +'</span></p>'
                              html += '<p class="text-right">পরিশোধ করেছেঃ <span>'+ receivedMoney +'</span></p>'
                              html += '<p class="text-right">বর্তমান বকেয়াঃ <span>'+ presentDebit +'</span></p>'
                              html += '<p class="text-right">আগের বকেয়াঃ <span>'+ pastDebit +'</span></p>'
                              html += '<p class="text-right">মোট বকেয়াঃ <span>'+ totalDebit +'</span></p>'


                              let originalContent = document.body.innerHTML;
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
                              $('input[name="presentDebit"]').val(0);
                              $('.presentDebit').text(0);
                              $('input[name="totalDebit"]').val(0);
                              $('.totalDebit').text(0); 
                        

                         
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

