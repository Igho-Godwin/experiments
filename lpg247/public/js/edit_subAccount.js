
function editSubAccountData(id)
{
    
   $('.fa-spin').removeClass('hide');

   var formData = new FormData(document.getElementById('editSubAccountForm'+id));
    
   $.ajax({
        url: "api/subAccount/edit",
        method: "post",
        data:formData,
        cache : false,
        contentType: false,
        processData: false,
        error: function(e) {
            
            obj = JSON.parse(e.responseText).error;
            
            if(typeof obj != 'undefined')
            {
                $('.fa-spin').addClass('hide');
                
                error_data='';
                
                if(typeof obj.email !== 'undefined'){
                    error_data += obj.email+'<br>';
                }
                
                if(typeof obj.address !== 'undefined'){
                    error_data += obj.address+'<br>';
                }

                if(typeof obj.password !== 'undefined')
                {
                    error_data += obj.password+'<br>';
                }
                
                if(typeof obj.price_per_qty !== 'undefined')
                {
                    error_data += obj.price_per_qty+'<br>'; 
                }
                
                if(typeof obj.city_of_location !== 'undefined')
                {
                    error_data += obj.city_of_location+'<br>'; 
                }
                
                if((typeof obj.error !== 'undefined')  )
                {
                    error_data += obj.error+'<br>';
                }
            
                $('#error'+id).html(error_data);
            }
    
        },
        success: function(e) {
            swal("Good job!",'Edit Successful', "success");
            location.reload();
        }
   });
    
}

