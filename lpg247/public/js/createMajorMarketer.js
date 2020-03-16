
$( "#addMajorMarketerBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
  
    save_cropped_pic_major_marketer();
  
   
   var formData = new FormData(document.getElementById('createMajorMarketerForm'));
    
   $.ajax({
       
        url: "api/MajorMarketer/create",
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
                
                if(typeof obj.marketer_name !== 'undefined'){
                    error_data += obj.marketer_name+'<br>';
                }
          
                if(typeof obj.address !== 'undefined')
                {
                    error_data += obj.address+'<br>';
                }
                
                if(typeof obj.city_of_location !== 'undefined'){
                    error_data += obj.city_of_location+'<br>';
                }
          
                if(typeof obj.price_per_tonne !== 'undefined')
                {
                    error_data += obj.price_per_tonne+'<br>';
                }
            
                if(typeof obj.marketer_logo !== 'undefined')
                {
                    error_data += obj.marketer_logo+'<br>';
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



var $inputImage = $('.imageMajorMarketer');

$inputImage.change(function () {
      
      var files = this.files;
      var file;
      
      console.log(3);
      
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
      aspectRatio: 4/5,
      data: {
            width: 270,
            height: 340
      },
      
      minCropBoxWidth: 270,
      minCropBoxHeight: 340,
     
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
    
    
function save_cropped_pic_major_marketer()
{
    var cropcanvas = $('#picture').cropper('getCroppedCanvas',{width: 270, height: 340});
                                     
    if(cropcanvas !== null  )
    {
        var croppng = cropcanvas.toDataURL("image/png");
        $('#photo').val(croppng);
    }
    
    
}