$( ".admin-login-btn" ).click(function() {
    
       
    $('.fa-spin').removeClass('hide');
    
    $.ajax({
            url: "api/admin/login",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:$('#loginUserForm').serialize(),
    }).done(function(data) {
         
        if(typeof data.success !== 'undefined')
        {
            window.open('/add_admin','_self')
            $('.fa-spin').addClass('hide');
        }
        else
        {
            $('.fa-spin').addClass('hide');
            
            $('#error').html(data.error);
          
        }
      
    });
  
});

function correlateLoginUserErrorMsg(obj)
{
    var error_data='';
    
    if(typeof obj.email !== 'undefined')
    {
        error_data += obj.email+'<br>';
    }
            
    if(typeof obj.password !== 'undefined')
    {
        error_data += obj.password+'<br>'; 
    }
            
    return error_data;
    
}

function correlateRegisterUserErrorMsg(obj)
{
    var error_data='';
    
    if(typeof obj.fullName !== 'undefined')
    {
        error_data += obj.fullName+'<br>';
    }
            
    if(typeof obj.email !== 'undefined')
    {
        error_data += obj.email+'<br>'; 
    }
            
    if(typeof obj.phoneNumber !== 'undefined')
    {
        error_data += obj.phoneNumber+'<br>'; 
    }
            
    if(typeof obj.address !== 'undefined')
    {
        error_data += obj.address+'<br>'; 
    }
            
    if(typeof obj.password !== 'undefined')
    {
        error_data += obj.password+'<br>'; 
    }
    
    if(typeof obj.terms !== 'undefined')
    {
        error_data += obj.terms+'<br>'; 
    }
    
    if(typeof obj.user_category !== 'undefined')
    {
        error_data += obj.user_category+'<br>'; 
    }
    
    if(typeof obj.cac_document !== 'undefined')
    {
        error_data += obj.cac_document+'<br>'; 
    }
    
    if(typeof obj.dpr_license_document !== 'undefined')
    {
        error_data += obj.dpr_license_document+'<br>'; 
    }
    
    return error_data;
}