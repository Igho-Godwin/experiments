// Create A User

$( ".add-user" ).click(function() {
    
   if($('.add-user').text() == 'Submit'){
       
          $('.fa-spin').removeClass('hide');
    
          var formData = new FormData(document.getElementById('create-userForm'));
    
          $.ajax({
            url: "api/addUser",
            method: "post",
            headers: {
               'Accept':'application/json',
               'Authorization':'Bearer '+$('#access_token').val()
            },
            data:formData,
            cache : false,
            contentType: false,
            processData: false
          }).done(function(data) {
              //alert(data);
              if(typeof data.success !== 'undefined'){
                    $('#access_token').val(data.success.token);
                    swal("Good job!",data.success.msg, "success");
                    $('#error').html('');
                    location.reload();
                    $('#create-userForm')[0].reset();
                    $('.fa-spin').addClass('hide');
              }
              else
              {
                    $('.fa-spin').addClass('hide');
                    var obj = data.error;
                    error_data='';
          
                    if(typeof obj.firstName !== 'undefined'){
                         error_data += obj.firstName+'<br>';
                    }
          
                    if(typeof obj.lastName !== 'undefined')
                    {
                         error_data += obj.lastName+'<br>';
                    }
          
                    if(typeof obj.EmailAddress !== 'undefined')
                    {
                         error_data += obj.EmailAddress+'<br>';
                    }
          
                    if(typeof obj.phoneNo !== 'undefined')
                    {
                        error_data += obj.phoneNo+'<br>';
                    }
          
                    if(typeof obj.departments !== 'undefined')
                    {
                       error_data += obj.departments+'<br>';
                    }
        
                    if(typeof obj.password !== 'undefined')
                    {
                       error_data += obj.password+'<br>';
                    }
          
                    if(typeof obj.picture !== 'undefined')
                    {
                        error_data += obj.picture+'<br>';
                    }
          
                    if(typeof obj.password_confirmation !== 'undefined')
                    {
                        error_data += obj.password_confirmation+'<br>';
                    }
                  
                    if(typeof obj.city !== 'undefined')
                    {
                        error_data += obj.city+'<br>';
                    }
                  
                    if(typeof obj.State !== 'undefined')
                    {
                        error_data += obj.State+'<br>';
                    }
                  
                    if(typeof obj.date_Of_birth !== 'undefined')
                    {
                        error_data += obj.date_Of_birth+'<br>';
                    }
                  
                    if(typeof obj.certificate_1 !== 'undefined')
                    {
                        error_data += obj.certificate_1+'<br>';
                    }
                  
                    if(typeof obj.school_1 !== 'undefined')
                    {
                        error_data += obj.school_1+'<br>';
                    }
                  
                    if(typeof obj.year_1 !== 'undefined')
                    {
                        error_data += obj.year_1+'<br>';
                    }
                  
                    if(typeof obj.certificate_2 !== 'undefined')
                    {
                        error_data += obj.year_1+'<br>';
                    }
                  
                    if(typeof obj.school_2 !== 'undefined')
                    {
                        error_data += obj.school_2+'<br>';
                    }
                  
                    if(typeof obj.year_2 !== 'undefined')
                    {
                        error_data += obj.year_2+'<br>';
                    }
                  
                    if(typeof obj.organization_1 !== 'undefined')
                    {
                        error_data += obj.organization_1+'<br>';
                    }
                  
                    if(typeof obj.Field_OF_Work_1 !== 'undefined')
                    {
                        error_data += obj.Field_OF_Work_1+'<br>';
                    }
                  
                    if(typeof obj.Designation_1 !== 'undefined')
                    {
                        error_data += obj.Designation_1+'<br>';
                    }
                  
                    if(typeof obj.Location_1 !== 'undefined')
                    {
                        error_data += obj.Location_1+'<br>';
                    }
                  
                    if(typeof obj.Location_2 !== 'undefined')
                    {
                        error_data += obj.Location_2+'<br>';
                    }
                  
                    if(typeof obj.organization_2 !== 'undefined')
                    {
                        error_data += obj.organization_2+'<br>';
                    }
                  
                    if(typeof obj.Designation_2 !== 'undefined')
                    {
                        error_data += obj.Designation_2+'<br>';
                    }
                  
                    if(typeof obj.Field_OF_Work_2 !== 'undefined')
                    {
                        error_data += obj.Field_OF_Work_2+'<br>';
                    }
                  
            
                  
                    if(typeof obj.Reference_FullName !== 'undefined')
                    {
                        error_data += obj.Reference_FullName+'<br>';
                    }
                  
                    if(typeof obj.Reference_Address !== 'undefined')
                    {
                        error_data += obj.Reference_Address+'<br>';
                    }
                  
                    if(typeof obj.Reference_city !== 'undefined')
                    {
                        error_data += obj.Reference_city+'<br>';
                    }
                  
                    if(typeof obj.Reference_state !== 'undefined')
                    {
                        error_data += obj.Reference_state+'<br>';
                    }
                  
                    if(typeof obj.Reference_Gender !== 'undefined')
                    {
                        error_data += obj.Reference_Gender+'<br>';
                    }
                  
                    if(typeof obj.Reference_Phone_No !== 'undefined')
                    {
                        error_data += obj.Reference_Phone_No+'<br>';
                    }
          
          
                    $('#error').html(error_data);
          
                }
      
               });
   }
});


//User Login in

$( "#login-user" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/LoginUser",
        method: "post",
        data:$('#login-Form').serialize()
   }).done(function(data) {
       
       if(data.error == 'Invalid Login Credential'){
           $('.fa-spin').addClass('hide'); 
           alert(data.error);
       }
       else{
           window.open('Dashboard','_self'); 
       }

     
      
   });
    
});


// Add a Shift

$( "#add-shift" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/AddShift",
        method: "post",
        data:$('#addShift-Form').serialize()
   }).done(function(data) {
       
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          $('#addShift-Form')[0].reset();
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          //console.log(obj);
          
          if(typeof obj.shift_name !== 'undefined'){
              error_data += obj.shift_name+'<br>';
          }
          
          if(typeof obj.from_time !== 'undefined')
          {
              error_data += obj.from_time+'<br>';
          }
          
          if(typeof obj.to_time !== 'undefined')
          {
              error_data += obj.to_time+'<br>';
          }
          

          if(typeof obj.departments !== 'undefined')
          {
              error_data += obj.departments+'<br>';
          }
          
         
          
          $('#error').html(error_data);
          
      }
       
      // alert('hi');
      
   });
    
});

// Add a Shift

$( "#edit-shift" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
  // alert('hi');
    
   $.ajax({
        url: "api/editShift",
        method: "post",
        data:$('#editShift-Form').serialize()
   }).done(function(data) {
       
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          $('#editShift-Form')[0].reset();
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          //console.log(obj);
          
          if(typeof obj.shift_name !== 'undefined'){
              error_data += obj.shift_name+'<br>';
          }
          
          if(typeof obj.from_time !== 'undefined')
          {
              error_data += obj.from_time+'<br>';
          }
          
          if(typeof obj.to_time !== 'undefined')
          {
              error_data += obj.to_time+'<br>';
          }
          

          if(typeof obj.departments !== 'undefined')
          {
              error_data += obj.departments+'<br>';
          }
          
         
          
          $('#error').html(error_data);
          
      }
       
      // alert('hi');
      
   });
    
});



//Delete A User 

function deleteUser(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteUser/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// Suspend A User 

function suspendUser(id)
{
    value = $('#sus-'+id).text().trim()+'?';
    if(confirm('Are you sure you want to '+value)) {
        
        // alert($('#sus-'+id).text().trim());
        
        if($('#sus-'+id).text().trim() !== 'Un-Suspend'){
            
            $.ajax({
            url: "api/suspendUser/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id,action:2}
           }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
             $('#sus-'+id).text('Un-Suspend');
              
           });
        }
        else{
            
             $.ajax({
            url: "api/suspendUser/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id,action:0}
           }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
             $('#sus-'+id).text('Suspend');
              
           });
            
        }
                     
    
         
        
   }
    
}


//Edit A User

$( ".edit-user" ).click(function() {
    
   if($('.edit-user').text() == 'Submit'){

   $('.fa-spin').removeClass('hide');

   var formData = new FormData(document.getElementById('edit-userForm'));  
       
      
   $.ajax({
        url: "api/editUser",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
     //  alert(data.success);
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.firstName !== 'undefined'){
              error_data += obj.firstName+'<br>';
          }
          
          if(typeof obj.lastName !== 'undefined')
          {
              error_data += obj.lastName+'<br>';
          }
          
          if(typeof obj.EmailAddress !== 'undefined')
          {
              error_data += obj.EmailAddress+'<br>';
          }
          
          if(typeof obj.phoneNo !== 'undefined')
          {
              error_data += obj.phoneNo+'<br>';
          }
          
          if(typeof obj.departments !== 'undefined')
          {
              error_data += obj.departments+'<br>';
          }
          
          if(typeof obj.password !== 'undefined')
          {
              error_data += obj.password+'<br>';
          }
          
          if(typeof obj.password_confirmation !== 'undefined')
          {
              error_data += obj.password_confirmation+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
   
   }
});

// Add to Store

$( "#add-ToStore" ).click(function() {

   $('.fa-spin').removeClass('hide');

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/add-ToStore",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#create-storeForm').serialize()
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#create-storeForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          //$('#Authenticate-User-Modal').modal('show');
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.itemName !== 'undefined'){
              error_data += obj.itemName+'<br>';
          }
          
          if(typeof obj.Quantity !== 'undefined')
          {
              error_data += obj.Quantity+'<br>';
          }
          
          if(typeof obj.departments !== 'undefined')
          {
              error_data += obj.departments+'<br>';
          }
          
          if(typeof obj.Quantity !== 'undefined' && $('#Quantity').val() !== '')
          {
              $('#Authenticate-User-Modal').modal('show');
          }
          
          
          
          if(typeof obj.UnitPrice !== 'undefined')
          {
              error_data += obj.UnitPrice+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
    
});


// Add Room Type

$( "#add-roomType" ).click(function() {

   $('.fa-spin').removeClass('hide');
    
    var formData = new FormData(document.getElementById('create-roomType'));
    
    var cropcanvas = $('#image').cropper('getCroppedCanvas');
    
    if(cropcanvas !== null)
    {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('pngimageData', croppng);
    }
  
   $.ajax({
        url: "api/addRoomType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#create-roomType')[0].reset();
          location.reload();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.roomName !== 'undefined'){
              error_data += obj.roomName+'<br>';
          }
          
        
          
          if(typeof obj.UnitPrice !== 'undefined')
          {
              error_data += obj.UnitPrice+'<br>';
          }
          
          if(typeof obj.room_number !== 'undefined')
          {
              error_data += obj.room_number+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
    
});
    
// Edit  Stock

$( "#edit-Stock" ).click(function() {
    
    

   $('.fa-spin').removeClass('hide');  
    
   $.ajax({
        url: "api/editStock",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#edit-storeForm').serialize()
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          //$('#create-storeForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.itemName !== 'undefined'){
              error_data += obj.itemName+'<br>';
          }
          
          if(typeof obj.Quantity !== 'undefined')
          {
              error_data += obj.Quantity+'<br>';
          }
          
          if(typeof obj.UnitPrice !== 'undefined')
          {
              error_data += obj.UnitPrice+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
    
});



// Edit  Room Type

$( "#edit-roomType" ).click(function() {
    
    

   $('.fa-spin').removeClass('hide');  
    
   var formData = new FormData(document.getElementById('edit-roomTypeForm'));
    
    var cropcanvas = $('#image').cropper('getCroppedCanvas');
    
    if(cropcanvas !== null)
    {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('pngimageData', croppng);
    }
  
   $.ajax({
        url: "api/editRoomType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          //$('#create-storeForm')[0].reset();
          $('.fa-spin').addClass('hide');
          location.reload();
          
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.roomName !== 'undefined'){
              error_data += obj.roomName+'<br>';
          }
          
          if(typeof obj.Quantity !== 'undefined')
          {
              error_data += obj.Quantity+'<br>';
          }
          
          if(typeof obj.UnitPrice !== 'undefined')
          {
              error_data += obj.UnitPrice+'<br>';
          }
          
          if(typeof obj.room_number !== 'undefined')
          {
              error_data += obj.room_number+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
    
});


//Delete A  Stock 

function deleteStock(itemName)
{
    if(confirm('Are you sure you want to delete?')) {
        
    
         $.ajax({
            url: "api/deleteStock/"+itemName,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:itemName}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

//Delete A  Shift 

function deleteShift(id)
{
    if(confirm('Are you sure you want to delete?')) {
        
    
         $.ajax({
            url: "api/deleteShift?id="+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

//Delete A Room Type 

function deleteRoomType(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteRoomType/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// Add Food Type

$( "#add-foodType" ).click(function() {
   
    
    var cropcanvas = $('#image').cropper('getCroppedCanvas');
    if(cropcanvas !== null)
    {
        var croppng = cropcanvas.toDataURL("image/png");
    }
    $('.fa-spin').removeClass('hide');
    var formData = new FormData(document.getElementById('create-foodType'));
        
    formData.append('pngimageData', croppng);
  
   $.ajax({
        url: "api/addfoodType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#image').cropper('destroy').attr('src', 'images/default-pic.png');
          $('#create-foodType')[0].reset();
          location.reload();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.food_name !== 'undefined'){
              error_data += obj.food_name+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.food_category !== 'undefined')
          {
              error_data += obj.food_category+'<br>';
          }
          
          
          
          $('#error').html(error_data);
          
      }
      
   });

});


// collect From Store

$( "#collect-FromStore" ).click(function() {

   $('.fa-spin').removeClass('hide');

    var formData = new FormData(document.getElementById('collect-storeForm'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/collectFromStore",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#collect-storeForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.Item_name !== 'undefined'){
              error_data += obj.Item_name+'<br>';
          }
          
          if(typeof obj.quantity !== 'undefined')
          {
              error_data += obj.quantity+'<br>';
          }
          
          if(typeof obj.users !== 'undefined')
          {
              error_data += obj.users+'<br>';
          }
          
          
          $('#error').html(error_data);
          
      }
      
   });
    
});



//Edit Food Type

$( "#edit-foodTypeBtn" ).click(function() {

   $('.fa-spin').removeClass('hide');
    
      
    
   var formData = new FormData(document.getElementById('edit-foodTypeForm'));

    var cropcanvas = $('#image').cropper('getCroppedCanvas');
    
    if(cropcanvas !== null)
    {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('pngimageData', croppng);
    }
    
    
   $.ajax({
        url: "api/editfoodType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          location.reload();
         // $('#create-foodType')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.food_name !== 'undefined'){
              error_data += obj.food_name+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.food_category !== 'undefined')
          {
              error_data += obj.food_category+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   });
    
});

//Delete A Food Type 

function deleteFoodType(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteFoodType/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// Save Restuarant Sales

function makeSales_Restuarant(id)
{
   $('.fa-spin').removeClass('hide');

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/make-sales-restuarant",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#make-sales-restuarant'+id).serialize()
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error'+id).html('');
          //$('#create-roomType')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.unit_price !== 'undefined'){
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.qty !== 'undefined')
          {
              error_data += obj.qty+'<br>';
          }
          
          if(typeof obj.mode_of_payment !== 'undefined')
          {
              error_data += obj.mode_of_payment+'<br>';
          }
          
          $('#error'+id).html(error_data);
          
      }
      
   }); 
    

}

// Calculate Sales Total 
 function cal_sales(id)
 {
     val = Intl.NumberFormat().format($('#unit_price'+id).val() * $('#qty'+id).val());
     $('#total'+id).val(val);
 }

 //Delete Sales

function deleteSalesRestuarant(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteRestuarantSales/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// delete Store Collections

function deleteStoreCollections(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteStoreCollections/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// Edit FoodSales

function EditFoodSales()
{
   $('.fa-spin').removeClass('hide');

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/editFoodSales",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#edit-foodSalesForm').serialize()
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          //$('#create-roomType')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.unit_price !== 'undefined'){
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.qty !== 'undefined')
          {
              error_data += obj.qty+'<br>';
          }
          
          if(typeof obj.mode_of_payment !== 'undefined')
          {
              error_data += obj.mode_of_payment+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   }); 
    

}

//edit store Collection

$( "#edit-storeCollectBtn" ).click(function() {

   $('.fa-spin').removeClass('hide');

    var formData = new FormData(document.getElementById('edit-storeCollectForm'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/editCollectFromStore",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
         // $('#collect-storeForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.Item_name !== 'undefined'){
              error_data += obj.Item_name+'<br>';
          }
          
          if(typeof obj.quantity !== 'undefined')
          {
              error_data += obj.quantity+'<br>';
          }
          
          if(typeof obj.users !== 'undefined')
          {
              error_data += obj.users+'<br>';
          }
          
          
          $('#error').html(error_data);
          
      }
      
   });
    
});
    


//Gets Room Unit Price
function getRoomUnitPrice()
{
     if($('#room_type').val() == '')
     {
         $('#unit_price').val('');
     }
     else{
         
        $.ajax({
           url: "api/room-unit-price",
           method: "post",
           headers: {
             'Accept':'application/json',
             'Authorization':'Bearer '+$('#access_token').val()
           },
           data:{room_type:$('#room_type').val()}
        }).done(function(data) {
      
          var obj = data.success;
         
          if(typeof obj.unit_price !== 'undefined'){
              $('#unit_price').val(obj.unit_price);
              $('#access_token').val(obj.token);
          }
           
       });
     }

}

// Rooms Total payable for Sell Room

function total_payable()
{
    $('#amount_payable').val(Intl.NumberFormat().format($('#unit_price').val() * $('#quantity').val()));
}

//Sell Rooms

$( "#sell-roomBtn" ).click(function() {

   $('.fa-spin').removeClass('hide');

    var formData = new FormData(document.getElementById('sell-roomForm'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/sell-room",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#sell-roomForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.customer_name !== 'undefined'){
              error_data += obj.customer_name+'<br>';
          }
          
          if(typeof obj.room_type !== 'undefined')
          {
              error_data += obj.room_type+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.quantity !== 'undefined')
          {
              error_data += obj.quantity+'<br>';
          }
          
          if(typeof obj.users !== 'undefined')
          {
              error_data += obj.users+'<br>';
          }
          
          
          $('#error').html(error_data);
          
      }
      
   });
    
});

function deleteSoldRooms(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteSoldRooms/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

//Edit Sold Room

$( "#editSold-roomBtn" ).click(function() {

   $('.fa-spin').removeClass('hide');

    var formData = new FormData(document.getElementById('editSold-roomForm'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/editSold-room",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          //$('#editSold-roomForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.customer_name !== 'undefined'){
              error_data += obj.customer_name+'<br>';
          }
          
          if(typeof obj.room_type !== 'undefined')
          {
              error_data += obj.room_type+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.quantity !== 'undefined')
          {
              error_data += obj.quantity+'<br>';
          }
          
          if(typeof obj.users !== 'undefined')
          {
              error_data += obj.users+'<br>';
          }
          
          
          $('#error').html(error_data);
          
      }
      
   });
    
});

// add  Pool Sales

$( "#add-PoolSales" ).click(function() {

   $('.fa-spin').removeClass('hide');

    var formData = new FormData(document.getElementById('create-PoolSales'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/addPoolSales",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#create-PoolSales').serialize(),
        
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#create-PoolSales')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.customer_name !== 'undefined'){
              error_data += obj.customer_name+'<br>';
          }
          
          if(typeof obj.cost !== 'undefined')
          {
              error_data += obj.cost+'<br>';
          }
           
         $('#error').html(error_data);
          
      }
      
   });
    
});


// add  Pool Sales

$( "#edit-PoolSales" ).click(function() {

   $('.fa-spin').removeClass('hide');

    //var formData = new FormData(document.getElementById('create-PoolSales'));

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/editPoolSales",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#edit-PoolSalesForm').serialize(),
        
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          
          //$('#create-PoolSales')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.customer_name !== 'undefined'){
              error_data += obj.customer_name+'<br>';
          }
          
          if(typeof obj.cost !== 'undefined')
          {
              error_data += obj.cost+'<br>';
          }
           
         $('#error').html(error_data);
          
      }
      
   });
    
});

// delete Pool Sales

function deletePoolSales(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deletePoolSales/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// add Drink Types

$( "#add-drinkType" ).click(function() {
   
   var cropcanvas = $('#image').cropper('getCroppedCanvas');
   //var croppng = cropcanvas.toDataURL("image/png");
    
   
   $('.fa-spin').removeClass('hide');

     var formData = new FormData(document.getElementById('create-drinkType'));
     
     if(cropcanvas !== null)
     {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('pngimageData', croppng);

     }
    
   $.ajax({
        url: "api/addDrinkType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
        
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#create-drinkType')[0].reset();
          location.reload();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.drink_type !== 'undefined'){
              error_data += obj.drink_type+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
           
         $('#error').html(error_data);
          
      }
      
   });
    
});

// delete Drink Type

function deleteDrinkType(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteDrinkType/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}

// Edit Drink Types

$( "#edit-drinkTypeBtn" ).click(function() {

   $('.fa-spin').removeClass('hide');

     var formData = new FormData(document.getElementById('edit-drinkTypeForm'));
     var cropcanvas = $('#image').cropper('getCroppedCanvas');
    
     if(cropcanvas !== null)
     {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('pngimageData', croppng);

     }
    
    
 
  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/editDrinkType",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false
        
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#edit-drinkTypeForm')[0].reset();
          location.reload();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.drink_type !== 'undefined'){
              error_data += obj.drink_type+'<br>';
          }
          
          if(typeof obj.unit_price !== 'undefined')
          {
              error_data += obj.unit_price+'<br>';
          }
           
         $('#error').html(error_data);
          
      }
      
   });
    
});


// Make Sales Drinks

function makeSales_Drinks(id)
{
   $('.fa-spin').removeClass('hide');

  // alert($('#access_token').val());
    
   $.ajax({
        url: "api/make-sales-drinks",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#make-sales-restuarant'+id).serialize() //All Drinks Form Data
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          //alert('de');
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error'+id).html('');
          $('#make-sales-restuarant'+id)[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.unit_price !== 'undefined'){
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.Quantity !== 'undefined')
          {
              error_data += obj.Quantity+'<br>';
          }
          
          if(typeof obj.mode_of_payment !== 'undefined')
          {
              error_data += obj.mode_of_payment+'<br>';
          }
          
          $('#error'+id).html(error_data);
          
      }
      
   }); 
    

}

// Edit Drink Sales

function EditDrinkSales()
{
    $('.fa-spin').removeClass('hide');

    
   $.ajax({
        url: "api/edit-sales-drinks",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#edit-drinkSalesForm').serialize() //All Drinks Form Data
   }).done(function(data) {
      
      if(typeof data.success !== 'undefined'){
          $('#access_token').val(data.success.token);
          swal("Good job!",data.success.msg, "success");
          $('#error').html('');
          $('#edit-drinkSalesForm')[0].reset();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.unit_price !== 'undefined'){
              error_data += obj.unit_price+'<br>';
          }
          
          if(typeof obj.qty !== 'undefined')
          {
              error_data += obj.qty+'<br>';
          }
          
          if(typeof obj.mode_of_payment !== 'undefined')
          {
              error_data += obj.mode_of_payment+'<br>';
          }
          
          $('#error').html(error_data);
          
      }
      
   }); 
    
}

// delete Sales Drink

function deleteSalesDrink(id)
{
    if(confirm('Are you sure you want to delete?')) {
                     
    
         $.ajax({
            url: "api/deleteSalesDrink/"+id,
            method: "post",
            headers: {
              'Accept':'application/json',
              'Authorization':'Bearer '+$('#access_token').val()
            },
            data:{id:id}
         }).done(function(data) {
       
             swal("Good job!",data.success.msg, "success");
             location.reload();
              
         });
        
   }
    
}


