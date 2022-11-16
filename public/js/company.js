
//search product
function searchCompany(value){
  
  var searchUrl =$('#searchCompany').attr('action');
  var searchMethod =$('#searchCompany').attr('method');
  
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
     
      $('#company_table').find('tbody').html('');
      $('#company_table').find('tbody').append(data.company);

    },
    error: function(data){

      console.log(data)

    }
  });
}


function editFunction(id){
  // get the company name
  var name = $('.companyName_'+id).text();
  var logo = $('.companyLogo_'+id).attr('src');
  //set the company id on edit form
  $('#editCompany').find('input[name=id]').val(id);
  //set the company name on edit form
  $('#editCompany').find('input[name=name]').val(name);
  //set the company logo on edit form
  $('#editCompany').find('.editLogo').attr('src',logo);
}


function deleteFunction(id){
  
  //set the category id on delete form
  $('#deleteCompany').find('input[name=id]').val(id);

  
}