
$( "#addRemissionBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
    
   $.ajax({
       
        url: "api/admin/addRemission",
        method: "post",
        data:$( "#addRemissionForm" ).serialize(),
        error: function(e) {
            
            obj = JSON.parse(e.responseText).error;
            
            if(typeof obj != 'undefined')
            {
                $('.fa-spin').addClass('hide');
                
                error_data='';
                
                if(typeof obj.percentage_remission !== 'undefined'){
                    error_data += obj.percentage_remission+'<br>';
                }
          
                if(typeof obj.percentage_remission == 'undefined')
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



