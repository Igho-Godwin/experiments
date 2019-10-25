
$( ".suspend" ).click(function() {
    
    $.ajax({
            url: "api/admin/suspend",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:{admin_id:$(this).attr("data-value")},
            error: function(e){
                 var error = JSON.parse(e.responseText).error;
                 console.log(error);  
            },
            success: function(e){
                 $(this).addClass('hide');
                 swal("Good job!",'Suspension Successful', "success");
                 location.reload();
            }
    
    });
    
});

$( ".unsuspend" ).click(function() {
    
    $.ajax({
            url: "api/admin/unsuspend",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:{admin_id:$(this).attr("data-value")},
            error: function(e){
                 var error = JSON.parse(e.responseText).error;
                 console.log(error);  
            },
            success: function(e){
                 $(this).addClass('hide');
                 swal("Good job!",'Un-Suspend Successful', "success");
                 location.reload();
            }
    
    });
    
});


