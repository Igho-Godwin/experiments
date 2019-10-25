
function editAdminData(id)
{
    
   $('.fa-spin').removeClass('hide');
   
   save_cropped_pic_edit(id);
    
   var formData = new FormData(document.getElementById('editAdminForm'+id));
    
   $.ajax({
        url: "api/admin/edit",
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
                
                if(typeof obj.first_name !== 'undefined'){
                    error_data += obj.first_name+'<br>';
                }
                
                if(typeof obj.last_name !== 'undefined'){
                    error_data += obj.last_name+'<br>';
                }
          
                if(typeof obj.password !== 'undefined')
                {
                    error_data += obj.password+'<br>';
                }
                
                if((typeof obj.password == 'undefined') && (typeof obj.email == 'undefined') && (typeof obj.photo == 'undefined')  && (typeof obj.first_name == 'undefined') && (typeof obj.last_name == 'undefined'))
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

function save_cropped_pic_edit(id)
{
    var cropcanvas = $('.picture').cropper('getCroppedCanvas',{width: 250, height: 250});
                                     
    if(cropcanvas !== null  )
    {
        var croppng = cropcanvas.toDataURL("image/png");
        $('#photo'+id).val(croppng);
    }
    
    
}





function readURL(input) {
    
    if (input.files && input.files[0]) {
            
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#picture').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
