//nav pills activation

$('#pills-tab a').on('click', function(e){
      
  $('#pills-tab .nav-link').each(function(){
        $(this).removeClass('active');
  })

  $(this).addClass('active')
})


/************** Home page **************/


function productInfo(id){

  // get the product information   

  var manufacture = $('#manufacture_'+id).val();
  var productName = $('#productName_'+id).val();
  var retailPrice = $('#retailPrice_'+id).val();
  var productWeightUnit = $('#productWeightUnit_'+id).val();
  var wholesalePrice= $('#wholesalePrice_'+id).val();
  var productQuantityUnit= $('#productQuantityUnit_'+id).val();
  var productSellType = $('#productSellType_'+id).val();

 

  // making product row for order section
  var product = '';
  product += '<tr style="text-align: center" id="product_'+id+'">';
  product += '<input type="hidden" class="product_id" value="'+id+'">';
  product += '<td>'+productName+'</td>';
  product += '<input type="hidden" class="productName" value="'+productName+'">';
  product += '<td><input type="number" name="quantity[]" value="1" class="quantity border-1 productQuantity_'+id+'" min="1" oninput="editQuantity('+id+')"></td>';

  
  if(productSellType == 1){

    if(manufacture == 1){

      product += '<input type="hidden" name="sell_type_id[]" class="sell_type_id"  value="'+productSellType+'">';
      product += '<input type="hidden" name="manufacture[]" class="manufacture" value="'+manufacture+'">';
      product += '<td class="productPrice_'+id+'">'+retailPrice+'</td>';
      product += '<input type="hidden" name="productPrice[]" class="productPrice" value="'+retailPrice+'">';
      product += '<td  class="productUnitPrice_'+id+'">'+retailPrice+'</td>';
      product += '<input type="hidden" name="productUnitPrice[]" class="productUnitPrice productUnitPrice_'+id+'"  value="'+retailPrice+'">';
      product += '<td>'+productQuantityUnit+'</td>';
      product += '<input type="hidden" name="productUnit[]" class="productUnit" value="'+productQuantityUnit+'">';
     

    }else{

      product += '<input type="hidden" name="sell_type_id[]" class="sell_type_id" value="'+productSellType+'">';
      product += '<input type="hidden" name="manufacture[]"  class="manufacture" value="'+manufacture+'">';
      product += '<td class="productPrice_'+id+'">'+retailPrice+'</td>';
      product += '<input type="hidden" name="productPrice[]" class="productPrice" value="'+retailPrice+'">';
      product += '<td class="productUnitPrice_'+id+'">'+retailPrice+'</td>';
      product += '<input type="hidden" name="productUnitPrice[]" class="productUnitPrice productUnitPrice_'+id+'"  value="'+retailPrice+'">';
      product += '<td>'+productWeightUnit+'</td>';
      product += '<input type="hidden" name="productUnit[]" class="productUnit" value="'+productWeightUnit+'">';
     
      
    }
  }
  if(productSellType == 2){

    product += '<input type="hidden" name="sell_type_id[]" class="sell_type_id" value="'+productSellType+'">';
    product += '<input type="hidden" name="manufacture[]"  class="manufacture" value="'+manufacture+'">';
    product += '<td class="productPrice_'+id+'">'+wholesalePrice+'</td>';
    product += '<input type="hidden" name="productPrice[]"  class="productPrice" value="'+wholesalePrice+'">';
    product += '<td class="productUnitPrice_'+id+'">'+wholesalePrice+'</td>';
    product += '<input type="hidden" name="productUnitPrice[]" class="productUnitPrice productUnitPrice_'+id+'"  value="'+wholesalePrice+'">';
    product += '<td>'+productQuantityUnit+'</td>';
    product += '<input type="hidden" name="productUnit[]" class="productUnit" value="'+productQuantityUnit+'">';
  
   

  }

  if(productSellType == null){
    $('.order-table tbody').append('<tr style="text-align: center" id="product_'+id+'"><td colspan="5"><span class="text-light "> বিক্রয়ের ধরণ নির্ধারন করুন...</span></td><td><a id="delete-product_'+id+'" class="btn btn-danger " onclick="deleteProduct('+id+')" ><i class="fa fa-trash-alt text-white"></i></a></td></tr> ');
  }else{

    product += '<td><a id="delete-product_'+id+'"  class="btn btn-danger " onclick="deleteProduct('+id+')" ><i class="fa fa-trash-alt text-white"></i></a></td>';
    product += '</tr>';
    $('.order-table tbody').append(product);
  }

  //get the total price
  totalPrice();
 
}

//total price function executon
 function totalPrice(){

  var total = 0;
  $('.order-table tbody tr').find('input.productUnitPrice').each(function(){
      
    total +=  parseInt($(this).val());
     
  })

  //set the total price 
  $('.totalPrice').text(total);
  $('input[name="totalPrice"]').val(total);



 //get debit 
  var debit = $('input[name="pastDebit"]').val();

  //set total price with debit
  var totalWithDebit = parseInt(total) + parseInt(debit);

  
  $('.totalWithDebit').text(totalWithDebit);
  $('input[name="totalWithDebit"]').val(totalWithDebit); 

 }

//change the quantity in the order section

function editQuantity(id){

  var quantity= $('.order-table tbody tr').find('.productQuantity_'+id).val();
  var productPrice =$('.order-table tbody tr').find('.productPrice_'+id).text();
 
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





