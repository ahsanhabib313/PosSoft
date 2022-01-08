//nav pills activation

/* $('#pills-tab  li.nav-item  a.nav-link').on('click', function(e){
      
  $('#pills-tab .nav-link').each(function(){
        $(this).removeClass('active')
  })
  $(this).addClass('active')
  $(this).addClass('show')
}) */


/************** Home page **************/


/*total price function executon*/
 function totalPrice(){

      var total = 0;
      $('.order-table tbody tr').find('input.productUnitPrice').each(function(){
          
        total +=  parseFloat($(this).val());
        
      })

      //set the total price 
      $('.totalPrice').text(total);
      $('input[name="totalPrice"]').val(total);

      // after discount total price 
      var discount = $('input[name="discount"]').val();
      discountFunction(discount);

   

 }


 //total amount after discount
 function discountFunction(discount){
  
      var totalPrice = $('input[name="totalPrice"]').val();
      var afterDiscountTotalPrice  = parseFloat(totalPrice)  - parseFloat(totalPrice*(discount/100)) ;

      //set the total price after discount
      $('.toBePaid').text(afterDiscountTotalPrice);
      $('input[name="toBePaid"]').val(afterDiscountTotalPrice);

      //get the received money
      var receivedMoney = $('input[name="receivedMoney"]').val();

      receivedMoneyFunction(receivedMoney);

 }


 // calcuation the debit 

function receivedMoneyFunction(value){
  
  let toBePaid  = $('input[name=toBePaid]').val();

  let presentDebit = parseFloat(toBePaid) - value;

  $('.presentDebit').text(presentDebit);
  $('input[name=presentDebit]').val(presentDebit);

  let pastDebit = $('input[name=pastDebit]').val();

  let totalDebit =parseFloat(presentDebit) + parseFloat(pastDebit) ;

  $('.totalDebit').text(totalDebit);
  $('input[name=totalDebit]').val(totalDebit);
}


// change total debit 
function changeTotalDebit(pastDebit){

 let presentDebit = $('input[name=presentDebit]').val();
 let totalDebit = presentDebit + pastDebit;

 $('.totalDebit').text(totalDebit);
 $('input[name=totalDebit]').val(totalDebit);

} 


//change the quantity in the order section

function editQuantity(id){

  var quantity= $('.order-table tbody tr').find('.productQuantity_'+id).val();
  var productPrice =$('.order-table tbody tr').find('input.productPrice_'+id).val();
 
  productPrice = parseInt(productPrice);

  var productUnitPrice = quantity * productPrice;
  
  $('.order-table tbody tr').find('.productUnitPrice_'+id).text(productUnitPrice);
  $('.order-table tbody tr').find('input.productUnitPrice_'+id).val(productUnitPrice);

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
     url: '/search/debit',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
     success: function(data){
          $('.pastDebit').text(data);
          $('input[name=pastDebit]').val(data);
          //get the total price
          totalPrice();

     },
     error: function(data){
          console.log(data);
     }

   })


  
}

// retireave data according to barcode

function barCodeFunction(value){
 
  var barCode = parseInt(value) ;

  var data = new FormData();

  data.append('barCode', barCode);

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
   // store data using ajax
   $.ajax({
     url: '/search/orderItem/barcode',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
     success: function(data){
       if(data ==  false){

      }else{

        let product = '';
        product += '<tr>';
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
        product += '<input type="hidden"  class="productPrice productPrice_'+data[0].id+'" value="'+data[0].retailPrice+'">';
        product += '<td  class="productUnitPrice_'+data[0].id+'">'+data[0].retailPrice+'</td>';
        product += '<input type="hidden" class="productUnitPrice productUnitPrice_'+data[0].id+'"  value="'+data[0].retailPrice+'">';
       
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
     url: '/sellType/product/wholesaleprice',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
     success: function(data){
     
      var id = data.id;
      var price = data.price;
      var unit = data.unit;

      $('.order-table tbody').find('.productPrice_'+id).text(price);
      $('.order-table tbody').find('.productPrice').val(price);
      $('.order-table tbody').find('.productUnit_'+id).text(unit);
      $('.order-table tbody').find('.productUnit').val(unit);
      
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







