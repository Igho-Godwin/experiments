
$( "#PostReviewBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
   var formData = new FormData(document.getElementById('review-form'));
    
   $.ajax({
       
        url: "api/review/create",
        method: "post",
        data:formData,
        cache : false,
        contentType: false,
        processData: false,
        error: function(e) {
            
            obj = JSON.parse(e.responseText).error;
            
            $('.fa-spin').addClass('hide');
                
            error_data='';
                
            if(typeof obj.name !== 'undefined'){
                error_data += obj.name+'<br>';
            }
          
            if(typeof obj.email !== 'undefined')
            {
                error_data += obj.email+'<br>';
            }
                
            if(typeof obj.review !== 'undefined'){
                error_data += obj.review+'<br>';
            }
          
            if(typeof obj.star_rating !== 'undefined')
            {
                error_data += obj.star_rating+'<br>';
            }
            
            if(typeof obj.marketers !== 'undefined')
            {
                error_data += 'Sorry You not allowed to review Yourself'+'<br>';
            }
            
            if(typeof obj.error !== 'undefined')
            {
                error_data += obj.error+'<br>';
            }
            
            $('#error').html(error_data);
    
        },
        success: function(e) {
            swal("Good job!",'Review Added Successfully', "success");
            location.reload();
        }
   });
    
});



