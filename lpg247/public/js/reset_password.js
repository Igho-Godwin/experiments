
$( ".reset-btn" ).click(function() {
    
    $('.fa-spin').removeClass('hide');
    
    $.ajax({
        url: "api/resetPassword",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:$('#resetPassForm').serialize(),
    }).done(function(data) {
         
        if( data == 'Email Sent')
        {
            error_data ='';
            $('#error2').html(error_data);
            swal("Good job!",'Password Reset Instructions Sent to Your Email', "success");
            $('#error').html('');
            $('#resetPassForm')[0].reset();
            $('.fa-spin').addClass('hide');
        }
        else if(data == 'Invalid Email')
        {
            error_data ='';
            error_data = data;
            $('#error2').html(error_data);
        }
        else
        {
            $('.fa-spin').addClass('hide');
            var obj = data.error; error_data ='';
            
            if(typeof obj.email !== 'undefined')
            {
                error_data += obj.email+'<br>';
            }
         
            $('#error2').html(error_data);
          
        }
      
    });
  
});

$( ".change-pass-btn" ).click(function() {
    
    $('.fa-spin').removeClass('hide');
    
    $.ajax({
            url: "api/changePassword",
            method: "put",
            headers: {
               'Accept':'application/json',
            },
            data:$('#changePassForm').serialize(),
            error: function(e) {
                
                $('.fa-spin').addClass('hide');
                
                obj = JSON.parse(e.responseText).error;
      
                if(typeof obj.password !== 'undefined')
                {
                    error_data = obj.password+'<br>';
                }
         
                $('#error2').html(error_data);
       
            },
            success: function(e) {
                
                 $('.fa-spin').addClass('hide');
                
                 swal("Good job!",'Password Changed', "success");
                 
                 if($('#user').val() == 'admin')
                 {
                     window.open('/admin_login','_self');  
                 }
                 else{
                     window.open('/login','_self');
                 }
                 
            }
            
  
    });
  
});



