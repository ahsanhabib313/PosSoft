//csrf token


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
   })

   var productUnitPrice = [];
   $('.order  .order-table .productUnitPrice').each(function(index){

      productUnitPrice[index]=$(this).val();
   })

   var productUnit = [];
   $('.order  .order-table .productUnit').each(function(index){

       productUnit[index]=$(this).val();
   })
  
   var totalPrice =  $('input[name="totalPrice"]').val();
   var presentDebit =  $('input[name="presentDebit"]').val();

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


$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
   // store data using ajax
   $.ajax({
     url: '/order/confirm',
     type: 'POST',
     data: data,
     processData: false,
     contentType: false,
     success: function(data){
          if(data == true){
               
               $('input[name=customerName]').val(null);
               $('input[name=mobileNumber]').val(null);
               $('.order .order-table tbody').html('');
               $('input[name="totalPrice"]').val(null);
               $('.totalPrice').text(0)
               $('input[name="pastDebit"]').val(0);
               $('.pastDebit').text(0);
               $('input[name="presentDebit"]').val(0);
               $('.presentDebit').text(0);
               $('input[name="totalWithDebit"]').val(0);
               $('.totalWithDebit').text(0);


          }
     },
     error: function(data){
          console.log(data);
     }

   })

  
})