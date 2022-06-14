
//search product
function searchCategory(value){
  
  var searchUrl =$('#searchCategory').attr('action');
  var searchMethod =$('#searchCategory').attr('method');
  
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
     
      $('#category_table').find('tbody').html('');
      $('#category_table').find('tbody').append(data.category);

    },
    error: function(data){

      console.log(data)

    }
  });
}


function editFunction(id){
  // get the category name
  var name = $('.category_'+id).text();
  //set the category id on edit form
  $('#editCategory').find('input[name= category_id]').val(id);
  //set the category name on edit form
  $('#editCategory').find('input[name= name]').val(name);
}


function deleteFunction(id){
  
  //set the category id on delete form
  $('#deleteCategory').find('input[name=category_id]').val(id);

  
}