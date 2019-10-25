
$( ".signup-sales-rep-btn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
  
   var formData = new FormData(document.getElementById('salesRepForm'));
    
   $.ajax({
       
        url: "api/salesRep/create",
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
                
                if(typeof obj.fullName !== 'undefined'){
                    error_data += obj.fullName+'<br>';
                }
          
                if(typeof obj.phoneNumber !== 'undefined')
                {
                    error_data += obj.phoneNumber+'<br>';
                }
                
                if(typeof obj.email !== 'undefined'){
                    error_data += obj.email+'<br>';
                }
          
                if(typeof obj.company_name !== 'undefined')
                {
                    error_data += obj.company_name+'<br>';
                }
            
                if(typeof obj.locationOfDepot !== 'undefined')
                {
                    error_data += obj.locationOfDepot+'<br>';
                }
                
                if(typeof obj.product_to_sell !== 'undefined')
                {
                    error_data += obj.product_to_sell+'<br>';
                }
                
                if(typeof obj.error !== 'undefined')
                {
                    error_data += obj.error+'<br>';
                }
            
                $('#error').html(error_data);
            }
    
        },
        success: function(e) {
            swal("Good job!",'Add Successful', "success");
            location.reload();
        }
   });
    
});



