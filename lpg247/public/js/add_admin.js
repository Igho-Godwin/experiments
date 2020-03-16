
$( "#addAdminBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
  
    save_cropped_pic();
  
   
   var formData = new FormData(document.getElementById('add_admin_form'));
    
   $.ajax({
       
        url: "api/admin/create",
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
                
                if(typeof obj.first_name !== 'undefined'){
                    error_data += obj.first_name+'<br>';
                }
          
                if(typeof obj.last_name !== 'undefined')
                {
                    error_data += obj.last_name+'<br>';
                }
                
                if(typeof obj.email !== 'undefined'){
                    error_data += obj.email+'<br>';
                }
          
                if(typeof obj.password !== 'undefined')
                {
                    error_data += obj.password+'<br>';
                }
            
                if(typeof obj.photo !== 'undefined')
                {
                    error_data += obj.photo+'<br>';
                }
                
                if((typeof obj.password == 'undefined') && (typeof obj.email == 'undefined') && (typeof obj.photo == 'undefined'))
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



var $inputImage = $('.image');

$inputImage.change(function () {
      
      var files = this.files;
      var file;
      
     

     if(files && files.length) {
         
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         
          var $image = $(this).parent().find('img')

          uploadedImageURL = URL.createObjectURL(file);
          $image.cropper('destroy').attr('src', uploadedImageURL);
          $image.cropper('destroy').attr('src', uploadedImageURL);
         

$image.cropper({
      aspectRatio: 1/ 1,
      data: {
            width: 250,
            height: 250
      },
      
      minCropBoxWidth: 250,
      minCropBoxHeight: 250,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
         
        
     
    }
  });

          
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
    
    
function save_cropped_pic()
{
    var cropcanvas = $('#picture').cropper('getCroppedCanvas',{width: 250, height: 250});
                                     
    if(cropcanvas !== null  )
    {
        var croppng = cropcanvas.toDataURL("image/png");
        $('#photo').val(croppng);
    }
    
    
}