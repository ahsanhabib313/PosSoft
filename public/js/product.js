//view the product info
function viewProduct(id){
  
  var productName = $('.productName_'+id).val();
  var photo = $('.photo_'+id).val();
  var category = $('.category_'+id).val();
  var companyName = $('.companyName_'+id).val();
  var productWeight = $('.productWeight_'+id).val();
  var productWeightUnit = $('.productWeightUnit_'+id).val();
  var buyingPrice = $('.buyingPrice_'+id).val();
  var retailPrice = $('.retailPrice_'+id).val();
  var wholesalePrice = $('.wholesalePrice_'+id).val();
  var quantity = $('.quantity_'+id).val();
  var productQuantityUnit = $('.productQuantityUnit_'+id).val();
  var alertQuantity = $('.alertQuantity_'+id).val();
  var barCode = $('.barCode_'+id).val();
  var expireDate = $('.expireDate_'+id).val();
  var buyingDate = $('.buyingDate_'+id).val();

  var product = ' ';
      product +='<table class="table table-striped">';
      product +='<tr>';
      product +='<td>পণ্যের নাম</td>';
      product +='<td>'+productName+'</td>';
      product +='</tr><tr>';
      product +='<td>কোম্পানীর নাম</td>';
      product +='<td>'+companyName+'</td>';
      product +='</tr><tr>';
      product +=' <td>ক্যাটাগরি</td>';
      product +=' <td>'+category+'</td>';
      product +='</tr>';
      product +='<tr>';
      product +='<td>পণ্যের ওজন</td>';
      product +='<td>'+productWeight+'</td>';
      product +='</tr><tr>';
      product +='<td>পণ্যের ওজনের একক</td>';
      product +=' <td>'+productWeightUnit+'</td>';
      product +='</tr><tr>';
      product +='<td>ক্রয় মূল্য</td>';
      product +=' <td>'+buyingPrice+' টাকা </td>';
      product +='</tr><tr>';
      product +='<td>খুচরা মূল্য</td>';
      product +=' <td>'+retailPrice+' টাকা</td>';
      product +='</tr><tr>';
      product +='<td>পাইকারি মূল্য</td>';
      product +=' <td>'+wholesalePrice+' টাকা</td>'; 
      product +='</tr><tr>';
      product +='<td>পরিমান/সংখ্যা</td>';
      product +=' <td>'+quantity+'</td>'; 
      product +='</tr><tr>';
      product +='<td>পরিমান/সংখ্যার একক</td>';
      product +=' <td>'+productQuantityUnit+'</td>';
      product +='</tr><tr>';
      product +='<td>নির্দেশনার পরিমান</td>';
      product +=' <td>'+alertQuantity+'</td>';
      product +='</tr><tr>';
      product +='<td>বারকোড</td>';
      product +=' <td>'+barCode+'</td>';
      product +='</tr><tr>';
      product +='<td>পণ্য ক্রয়ের তারিখ</td>';
      product +=' <td>'+buyingDate+'</td>';
      product +='</tr><tr>';
      product +='<td>মেয়াদত্তীর্ণের তারিখ</td>';
      product +=' <td>'+expireDate+'</td>';
      product +='</tr>';
      product +='</table>';



      $('#viewProduct .view-table').html(product);
}


//edit the product info
function editProduct(id){
  
  var productName = $('.productName_'+id).val();
  var category_id = $('.category_'+id).val();
  var companyName = $('.companyName_'+id).val();
  var productWeight = $('.productWeight_'+id).val();
  var productWeightUnit = $('.productWeightUnit_'+id).val();
  var buyingPrice = $('.buyingPrice_'+id).val();
  var retailPrice = $('.retailPrice_'+id).val();
  var wholesalePrice = $('.wholesalePrice_'+id).val();
  var quantity = $('.quantity_'+id).val();
  var alertQuantity = $('.alertQuantity_'+id).val();
  var barCode = $('.barCode_'+id).val();
  var expireDate = $('.expireDate_'+id).val();

  //set the product on edit form 
  $('#editProduct input[name=product_id]').val(id);
  $('#editProduct input[name=productName]').val(productName);
  $('#editProduct input[name=companyName]').val(companyName);
  $('#editProduct input[name=productWeight]').val(productWeight);
  $('#editProduct input[name=buyingPrice]').val(buyingPrice);
  $('#editProduct input[name=retailPrice]').val(retailPrice);
  $('#editProduct input[name=wholesalePrice]').val(wholesalePrice);
  $('#editProduct input[name=quantity]').val(quantity);
  $('#editProduct input[name=alertQuantity]').val(alertQuantity);
  $('#editProduct input[name=barCode]').val(barCode);
  $('#editProduct input[name=expireDate]').val(expireDate);

  //select category
  $('.category_option').each(function(){
    if(category_id == $(this).val()){
      $(this).attr('selected',true);
    }else{
      $(this).attr('selected',false);
    }
    
  })


  //select productWightUnit
  $('.productWeightOption').each(function(){
     if(productWightUnit == $(this).val()){
      $(this).attr('selected', true)
     }else{
      $(this).attr('selected', false);
     }
  })


 

}

//delete the product info
function deleteProduct(id){
  
  var productName = $('.productName_'+id).val();
  var category = $('.category_'+id).val();
  var companyName = $('.companyName_'+id).val();
  var productWeight = $('.productWeight_'+id).val();
  var productWeightUnit = $('.productWeightUnit_'+id).val();
  var buyingPrice = $('.buyingPrice_'+id).val();
  var retailPrice = $('.retailPrice_'+id).val();
  var wholesalePrice = $('.wholesalePrice_'+id).val();
  var quantity = $('.quantity_'+id).val();
  var productQuantityUnit = $('.productQuantityUnit_'+id).val();
  var alertQuantity = $('.alertQuantity_'+id).val();
  var barCode = $('.barCode_'+id).val();
  var expireDate = $('.expireDate_'+id).val();
  var buyingDate = $('.buyingDate_'+id).val();


}

//search product
function searchProduct(value){
  
    var searchUrl =$('#searchProduct').attr('action');
    var searchMethod =$('#searchProduct').attr('method');
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  var formData = new FormData();
   formData.append('value', value);
    

    $.ajax({
      url: searchUrl,
      type:searchMethod,
      data: formData,
      dataType: 'json',
      processData: false,
      contentType:false,
      success: function(data){
       
        $('#product_table').find('tbody').html('');
        $('#product_table').find('tbody').append(data.table_data);

      },
      error: function(){

      }
    });
}

