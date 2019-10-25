 
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $('#password');
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  
  
});

$(".toggle-password1").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $('#password_confirmation');
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
    
});

$(".toggle-password1").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $('#password_confirmation');
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
    
});


$( "#validate-admin-login" ).click(function() {
    

    
   $('.fa-spin1').removeClass('hide');
    
   $.ajax({
        url: "api/LoginAdmin",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#auth-Form').serialize()
   }).done(function(data) {
       
       obj = data.success;
       
       if(data.error == 'Invalid Login Credential'){
           $('.fa-spin1').addClass('hide'); 
           swal({
                title: "Invalid Login Credential",
                // text: "Authentication Successful",
                icon: "error",
                button: 'Ok',
                //dangerMode: true,
           });
       }
       else{
            $('.fa-spin1').addClass('hide');
            $('#auth').val(obj.auth); 
            $('#auth-Form')[0].reset();
            swal("Good job!",'Successful', "success");
       }

     
      
   });
    
});

$( "#edit-customer" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/edit_customer",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#edit-customerForm').serialize()
   }).done(function(data) {
       
       obj = data.success;
       
       if(typeof data.success !== 'undefined'){
           
            $('#access_token').val(data.success.token);
            swal("Good job!",data.success.msg, "success");
            $('#error').html('');
            location.reload();
            $('#edit-customerForm')[0].reset();
            $('.fa-spin').addClass('hide');
            
        }
        else
        {
            
            $('.fa-spin').addClass('hide');
            var obj = data.error;
            error_data='';
          
            if(typeof obj.first_name !== 'undefined'){
                error_data += obj.first_name+'<br>';
            }
          
            if(typeof obj.last_name !== 'undefined')
            {
                error_data += obj.last_name+'<br>';
            }
          
            if(typeof obj.phone_number !== 'undefined')
            {
                error_data += obj.phone_number+'<br>';
            }
          
            if(typeof obj.email_address !== 'undefined')
            {
                error_data += obj.email_address+'<br>';
            }
          
            if(typeof obj.address !== 'undefined')
            {
                error_data += obj.address+'<br>';
            }
        
            if(typeof obj.country !== 'undefined')
            {
                error_data += obj.country+'<br>';
            }
          
            if(typeof obj.state !== 'undefined')
            {
                error_data += obj.state+'<br>';
            }
          
            if(typeof obj.city !== 'undefined')
            {
                error_data += obj.city+'<br>';
            }
                  
            if(typeof obj.customer_type !== 'undefined')
            {
                error_data += obj.customer_type+'<br>';
            }
                  
            if(typeof obj.discount !== 'undefined')
            {
                error_data += obj.discount+'<br>';
            }
                  
            $('#error').html(error_data);
          
         }

     
      
   });
    
});

$( "#update-loyaltyBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/update_loyalty_page",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#update-loyaltyForm').serialize()
   }).done(function(data) {
       
       obj = data.success;
       
       if(typeof data.success !== 'undefined'){
           
            $('#access_token').val(data.success.token);
            swal("Good job!",data.success.msg, "success");
            $('#error').html('');
            location.reload();
            $('#update-loyaltyForm')[0].reset();
            $('.fa-spin').addClass('hide');
            
        }
        else
        {
            
            $('.fa-spin').addClass('hide');
            var obj = data.error;
            error_data='';
          
            if(typeof obj.loyalty_value !== 'undefined'){
                error_data += obj.loyalty_value+'<br>';
            }
          
            if(typeof obj.number_of_visits !== 'undefined')
            {
                error_data += obj.number_of_visits+'<br>';
            }
          
            
                  
            $('#error').html(error_data);
          
         }

     
      
   });
    
});

function add_to_cart(type,id)
{
    
   // alert($('#cart'+id).text().trim());
    
    if($('#cart'+id).text().trim() !== 'Remove item From Cart')
    {
       $.ajax({
        url: "api/add-to-cart",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{type:type,id:id}
   }).done(function(data) {
       
      // obj = data.success;
       
       if(data == 'Item Added' )
       {
           $('#cart'+id).text('Remove item From Cart');
           
           if($('#item_count').text() == '')
           {
               $('#item_count').text(1);  
           }
           else{
               $('#item_count').text(parseInt($('#item_count').text())+1);
           }
           
           swal("Good job!",'Item Successfully Added To Cart', "success");
           
         
           
       }
       
   });
        
    }
    else{
        
        $.ajax({
        url: "api/remove-from-cart",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{type:type,id:id}
   }).done(function(data) {
       
      // obj = data.success;
       
       if(data == 'Remove From Cart' )
       {
           $('#cart'+id).text('Add To Cart');
           
          
           $('#item_count').text(parseInt($('#item_count').text())-1);
           
           
           swal("Good job!",'Item Successfully Removed from Cart', "success");
           
         
           
       }
     
      
   });
       
        
    }
    
}

function removeFromCart(type,id)
{
    
  
        $.ajax({
        url: "api/remove-from-cart",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{type:type,id:id}
   }).done(function(data) {
       
      
       if(data == 'Remove From Cart' )
       {
           $('#cart'+id).addClass('hide');
           
           $('#item_count').text(parseInt($('#item_count').text())-1);
           
           swal("Good job!",'Item Successfully Removed from Cart', "success");
             
       }
     
      
   });
    

       
        
    
    
}

function reduce_cart_qty(key){
    
    if($('#qty-field-'+key).val() > 1)
    {
      
       val = $('#qty-field-'+key).val()-1;
       $('#qty-field-'+key).val(val);
       total = val * parseFloat($('#price-'+key).val());
       //alert($('#price-'+key).val());
       $('#total-'+key).text(total);
       addOverallTotal();
       addQty(key,val);
       
      // alert('hi');
     
    }
    
}

function addQty(key,qty)
{
     $.ajax({
        url: "api/addQty",
        method: "get",
        data:{key:key,qty:qty}
   }).done(function(data) {
       
        
   });
    
    
}

function add_cart_qty(key){
    
    
       val = $('#qty-field-'+key).val();
       val= parseInt(val)+1;
       $('#qty-field-'+key).val(val);
       total = val * parseFloat($('#price-'+key).val());
       $('#total-'+key).text(total.toLocaleString());
       addOverallTotal();
       addQty(key,val);
     
    
}

function addOverallTotal()
{
    
    //max=0;min=0;
    
    min = $('#min').val();
    
    max = $('#max').val();
    
    overall = 0;
    
    for(i=min;i<=max;++i)
    {
        if($('#price-'+i).val() != 'undefined' )
        {
            overall+= (parseInt($('#price-'+i).val()) * parseInt($('#qty-field-'+i).val()));
        }
    }
    
   // alert(min+','+max);
    
    //$('#real-overall-total').val(overall_total);
    $('#overall-total').text(overall.toLocaleString());
    
  
}


function checkOut()
{
    if($('#mode_of_payment').val() == '')
    {   
        swal({
                title: "Mode of Payment Not Selected",
                // text: "Authentication Successful",
                icon: "error",
                button: 'Ok',
                //dangerMode: true,
           });
        
    }
    else{
       $('.fa-spin').removeClass('hide');
       $.ajax({
        url: "api/checkOut",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('#cart-form').serialize()
       }).done(function(data) {
           
           
           swal("Good job!",data.success.msg, "success");
           window.open(data.success.url,'_self');
            
       });
        
    }
    
}

function ClearCart()
{
    $.ajax({
        url: "api/clearCart",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
       }).done(function(data) {
           
           
           swal("Good job!",'Cart Successfully Cleared', "success");
           location.reload();
            
       });
    
}


  

$( "#discount-toggle" ).click(function() {
  $('.amt').toggleClass( "hide" );
  $('.amount2').toggleClass( "hide" );
});



function getAvailableRooms()
{
     $.ajax({
        url: "api/getAvailabeRooms",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'checkin':$('.check_in').val(),'checkout':$('.check_out').val(),'room_id':$('#room_id').val()}
   }).done(function(data) {
       
        obj = data.success;
       
        available_rooms = obj.available_rooms;
        
        available_rooms_color = obj.available_room_condition_color;
        
        unavailable_rooms_color = obj.unavailable_room_condition_color;
         
        available_rms = '<option value="">Available Rooms</option>';
         
        unavailable_rms = '<option value="">Un-Available Rooms</option>';
         
        unavailable_rooms = obj.unavailable_rooms;text_color ='';
         
        for(i=0;i<available_rooms.length;i++)
        {
            
            if(available_rooms_color[i] == 'yellow')
            {
                text_color = 'black';
            }
            else if(available_rooms_color[i] !== 'yellow'){
                     
                text_color = 'white';    
            }
            
            if(available_rooms_color[i] == null)
            {
                available_rooms_color[i] = 'green';
            }
            
            
            
            available_rms += '<option style="background-color:'+available_rooms_color[i]+';color:'+text_color+';">'+available_rooms[i]+'</option>';
        }
         
        selected='';text_color='';
         
        for(i=0;i<unavailable_rooms.length;i++)
        {
       
            if(unavailable_rooms_color[i] == 'yellow')
            {
                text_color = 'black';
            }
            else if(unavailable_rooms_color[i] !== 'yellow'){
                
                text_color = 'white';    
            }
            
            if(unavailable_rooms_color[i] == null)
            {
                unavailable_rooms_color[i] = 'green';
            }
            
            unavailable_rms += '<option style="background-color:'+unavailable_rooms_color[i]+';color:'+text_color+';">'+unavailable_rooms[i]+'</option>';
        }
         
        $('#available_room').html(available_rms);
         
        $('#unavailable_rooms').html(unavailable_rms);
       
     
      
   });
    
}


function DifferenceInDays(firstDate, secondDate) {
    
     date1 = firstDate.split('-');
     date2 = secondDate.split('-');

     
     dt1 = new Date(date1[2]+'-'+date1[1]+'-'+date1[0]);
     dt2 = new Date(date2[2]+'-'+date2[1]+'-'+date2[0]);
   
     var diff = new Date(dt2 - dt1);

     var days = diff/1000/60/60/24;
    
     return days+1;
    
}

function calc_room_amount_payable()
{
    days = DifferenceInDays($('#datepicker').val(), $('#datepicker2').val());
    
    if($('.amt').hasClass('hide')){
       amount = $('#dis-price').text();
    }
    else{
        amount = $('#price').text()
    }
    
    $('#amount').val(amount);
    
    if(days < 0)
    {
        alert('Leave Date must be greater than Arrival Date');
    }
    else
    {
       $('#no_of_days').val(days);
       no_of_rooms = $('#available_room option:selected').length;
       $('#room_cost').val(days*$('#amount').val());
       $('#amount_payable').val(new Intl.NumberFormat().format(days*$('#amount').val()*no_of_rooms));
      
    }
    
}


function sellRoom()
{
    $('.fa-spin').removeClass('hide');  
    
    if($('.amt').hasClass('hide')){
       amount = $('#dis-price').text();
    }
    else{
        amount = $('#price').text()
    }
    
    
    
    $('#amount').val(amount);
    
   // {'checkinDate':$('.check_in').val(),'amount':amount,'checkoutDate':$('.check_out').val(),'room_id':$('#room_id').val(),'available_room':$('#available_room').val(),customer_name:$('#customer_name').val(),mode_of_payment:$('#mode_of_payment').val()}
   // alert('HI');
    $.ajax({
        url: "api/sellRoom",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:$('.reserve-form').serialize(),
   }).done(function(data) {
       
       console.log(data);
       
        obj = data.success;
        
        days = DifferenceInDays($('#datepicker').val(), $('#datepicker2').val());
        
        if(days < 0)
        {
            alert('Leave Date must be greater than Arrival Date.');
        }
        else{
      
            if(typeof data.success !== 'undefined'){
                 $('#access_token').val(data.success.token);
                swal("Good job!",data.success.msg, "success");
                $('#error').html('');
                $('.fa-spin').addClass('hide');
                location.reload();
            }
            else
            {
               $('.fa-spin').addClass('hide');
               var obj = data.error;
               error_data='';
          
               if(typeof obj.customer_type !== 'undefined'){
                    error_data += obj.customer_type+'<br>';
               }
          
               if(typeof obj.first_name !== 'undefined'){
                    error_data += obj.first_name+'<br>';
               }
          
              if(typeof obj.last_name !== 'undefined'){
                    error_data += obj.last_name+'<br>';
              }
          
              if(typeof obj.others !== 'undefined'){
                error_data += obj.others+'<br>';
              }
          
              if(typeof obj.birth_month !== 'undefined'){
                error_data += obj.birth_month+'<br>';
              }
          
              if(typeof obj.birth_day !== 'undefined'){
                error_data += obj.birth_day+'<br>';
              }
          
             if(typeof obj.phone_number !== 'undefined'){
                 error_data += obj.phone_number+'<br>';
             }
          
          if(typeof obj.email_address !== 'undefined'){
              error_data += obj.email_address+'<br>';
          }
          
          if(typeof obj.address !== 'undefined'){
              error_data += obj.address+'<br>';
          }
          
          if(typeof obj.country !== 'undefined'){
              error_data += obj.country+'<br>';
          }
          
          if(typeof obj.State !== 'undefined'){
              error_data += obj.State+'<br>';
          }
          
          if(typeof obj.city !== 'undefined'){
              error_data += obj.city+'<br>';
          }
          
          
          
          
          if(typeof obj.checkinDate !== 'undefined'){
              error_data += obj.checkinDate+'<br>';
          }
          
          if(typeof obj.checkoutDate !== 'undefined')
          {
              error_data += obj.checkoutDate+'<br>';
          }
          
          if(typeof obj.available_room !== 'undefined')
          {
              error_data += obj.available_room+'<br>';
          }
            
          if(typeof obj.customer_name !== 'undefined')
          {
              error_data += obj.customer_name+'<br>';
          }
            
          if(typeof obj.mode_of_payment !== 'undefined')
          {
              error_data += obj.mode_of_payment+'<br>';
          }
            
          
          
          $('#error').html(error_data);
          
        }
       
   }
      
   });
    
}

function editSoldRoom()
{
    $('.fa-spin').removeClass('hide');  
    
    if($('.amt').hasClass('hide')){
       amount = $('#dis-price').text();
    }
    else{
        amount = $('#price').text()
    }
    
    $.ajax({
        url: "api/editSoldRoom",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'checkinDate':$('.check_in').val(),'amount':amount,'checkoutDate':$('.check_out').val(),'room_id':$('#room_id').val(),'available_room':$('#available_room').val()}
   }).done(function(data) {
       
        obj = data.success;
        
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
          
          if(typeof obj.checkinDate !== 'undefined'){
              error_data += obj.checkinDate+'<br>';
          }
          
          if(typeof obj.checkoutDate !== 'undefined')
          {
              error_data += obj.checkoutDate+'<br>';
          }
          
          if(typeof obj.available_room !== 'undefined')
          {
              error_data += obj.available_room+'<br>';
          }
            
          
          
          $('#error').html(error_data);
          
        }
       
     
      
   });
}


function GetProfit()
{
    $('.fa-spin').removeClass('hide');  
    
    
    $.ajax({
        url: "api/getProfit",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'SearchDate':$('#date1').val()}
   }).done(function(data) {
       
        obj = data.success;
        
        if(typeof data.success !== 'undefined'){
            
          $('#access_token').val(data.success.token);
          $('#Restaurant-Sales').text(new Intl.NumberFormat().format(obj.res_sales));
          $('#drink-Sales').text(new Intl.NumberFormat().format(obj.drink_sales));
          $('#pool-Sales').text(new Intl.NumberFormat().format(obj.pool_sales));
          $('#room-Sales').text(new Intl.NumberFormat().format(obj.room_sales));
          $('#stock').text(new Intl.NumberFormat().format(obj.stock));
          $('#overall-total').text(new Intl.NumberFormat().format(obj.overall_total));
          $('#profit-total').text(new Intl.NumberFormat().format(obj.Profit));
          
          $('.fa-spin').addClass('hide');
         
        }
        else
        {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.Searchdate !== 'undefined'){
              error_data += obj.Searchdate+'<br>';
          }
               
          
          $('#error').html(error_data);
          
        }
       
     
      
   });
    
}

$( ".sndCustomerReceiptBtn" ).click(function() {
    
 //  $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/SendReceiptToCustomer",
        method: "post",
        data:{'similar_id':$(this).data("role")}
   }).done(function(data) {
       
     
          swal("Good job!","Successful. Receipt Sent", "success");
         
     
      
   });
    
});

//Send Forgot Password Email Link

$( "#forgot-pass" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/forgotPass",
        method: "post",
        data:$('#forgot-pass-Form').serialize()
   }).done(function(data) {
       
       if(data == 'Invalid Email address Given'){
           $('.fa-spin').addClass('hide'); 
           swal({
                title: "Invalid Email address Given",
                // text: "Authentication Successful",
                icon: "error",
                button: 'Ok',
                //dangerMode: true,
           });
         //  alert('Invalid Email address Given');
       }
       else{
          swal("Good job!",data, "success");
          $('#forgot-pass-Form')[0].reset();
          $('.fa-spin').addClass('hide');
       }

     
      
   });
    
});


//change password

$( "#change-pass" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
    
   $.ajax({
        url: "api/changePassword",
        method: "post",
        data:$('#change-pass-Form').serialize()
   }).done(function(data) {
       
         obj = data.success;
        
        if(typeof data.success !== 'undefined'){
            
          alert('Password Change Successful');
          window.open('/','_blank');
         
        }
        else
        {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.password !== 'undefined'){
              error_data += obj.password+'<br>';
          }
            
          else if(typeof obj.password_confirmation !== 'undefined'){
              error_data += obj.password_confirmation+'<br>';
          }
               
          
          $('#error').html(error_data);
          
        }
     
      
   });
    
});




//filter city by state for users 

$( "#states" ).change(function() {
    
  // alert('hi');
    
   $.ajax({
        url: "api/getCity",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'state':$(this).val()}
   }).done(function(data) {
    
         $('#city').html(data);
         $('#city').select2();
        // $('#city').selectpicker('refresh');
        // $('select').selectpicker('refresh');
     
      
   });
    
});


$( "#customer_type" ).change(function() {
    //alert('hi');
    if($(this).val() == '2' || $(this).val() == '3' || $(this).val() == '4' )
    {
        $('#available_room').attr("multiple", "multiple");
        $('#available_room').attr("size", "6");
    }
    else{
        $('#available_room').removeAttr("multiple");
        $('#available_room').removeAttr("size");
    }
    
});






$( ".ac1" ).click(function() {
    
   $('.avail').removeClass('hide');
    
   if($(this).val() == '0')
   {
       $('#save-data').text('Check In');
       $('.reserved').addClass('hide');
   }
   else{
       $('#save-data').text('Reserve');
       $('.reserved').removeClass('hide');
   }
    
});


$( ".checkin" ).click(function() {
    
     
       id= $(this);
       $.ajax({
        url: "api/checkIn",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'sales_id':$(this).data("id")}
   }).done(function(data) {
            console.log(data);
           // console.log($(this).val());
            id.html(data);
            //console.log($(this).val());
            console.log('hi2');
    
            
            if(data == 'Check In')
            {
               $('#dt-'+id.data('id')).addClass('hide');
               
            }
      
   });
    
});

$('#batch_condition').change(function() {
    
       id= $(this);
            
       if($(this).val() == '4')
       {
         
           $('#batch_btn').click();
         
       }
       else{
    
            $.ajax({
                 url: "api/AddRoomCondition_batch",
                 method: "get",
                 headers: {

                    'Authorization':'Bearer '+$('#access_token').val()
                 },
                data:$('#batch_update_form').serialize(),
             }).done(function(data) {
                 
                    
            
                    if(id.val() == '0')
                    {
                        id.css({'background-color':'green','color':'white'});
                    }
                    else if(id.val() == '1')
                    {
                         id.css({'background-color':'red','color':'white'});
                    }
                    else if(id.val() == '2')
                    {
                        id.css({'background-color':'#A52A2A','color':'white'});
                    }
                    else if(id.val() == '3')
                    {
                         id.css({'background-color':'#FFFF00','color':'black'});
                    }
                    else if(id.val() == '4')
                    {
                        id.css({'background-color':'blue','color':'white'});
                    }
                    
                    swal("Good job!",'Successful', "success");
      
           });
           
       }
    
    
});

$( ".room-condition" ).change(function() {
    
       id= $(this);
     
       if($(this).val() == '4')
       {
           room_no = $(this).data("id");
           condition = $(this).val();
           $('#btn-'+room_no).click();
          
           
       }
       else{
           
             $.ajax({
                 url: "api/AddRoomCondition",
                 method: "get",
                 headers: {

                    'Authorization':'Bearer '+$('#access_token').val()
                 },
                data:{
            
                    'room_no':$(this).data("id"),
                    'condition':$(this).val()
            
                }
             }).done(function(data) {
            
                    if(id.val() == '0')
                    {
                        id.css({'background-color':'green','color':'white'});
                    }
                    else if(id.val() == '1')
                    {
                         id.css({'background-color':'red','color':'white'});
                    }
                    else if(id.val() == '2')
                    {
                        id.css({'background-color':'#A52A2A','color':'white'});
                    }
                    else if(id.val() == '3')
                    {
                         id.css({'background-color':'#FFFF00','color':'black'});
                    }
                    else if(id.val() == '4')
                    {
                        id.css({'background-color':'blue','color':'white'});
                    }
                    
                   // location.reload();
      
           });
           
       }
       
});

$( ".temp_checkin" ).click(function() {
       
       id = $(this);
       $.ajax({
        url: "api/temp_checkin",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'sales_id':$(this).data("id")}
   }).done(function(data) {
    
            console.log(data);
           // console.log($(this).val());
            id.html(data);
            //console.log($(this).val());
            console.log('hi2');
    
            
            
      
   });
    
    
    
});

//filter city by state for users 

$( "#country" ).change(function() {
    
  // alert('hi');
    
   $.ajax({
        url: "api/getStates",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'country_name':$(this).val()}
   }).done(function(data) {
    
         $('#states').html(data);
         $('#states').select2();
         //$('#states').selectpicker('refresh');
        // $('select').selectpicker('refresh');
     
      
   });
    
});

//filter city by state for Reference Form 

$( ".state2" ).change(function() {
    
   //alert('hi');
    
   $.ajax({
        url: "api/getCity",
        method: "get",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{'state':$(this).val()}
   }).done(function(data) {
       
      
         $('#city_ref').html(data);
         $('#city_ref').select2();
        
     
      
   });
    
});

function updateMaintenance_batch()
{
            id = $('#batch_condition');
            
            $('#spin-batch').removeClass('hide');
            
            $('#rmn_no').val($('#batch_room').val());
            
            $.ajax({
                 url: "api/AddRoomCondition_batch",
                 method: "get",
                 headers: {

                    'Authorization':'Bearer '+$('#access_token').val()
                 },
                data:$('#maintenance_form_batch').serialize()
             }).done(function(data) {
                 
                 console.log(data);
            
                 if(typeof data.success !== 'undefined'){
                     //obj = JSON.parse(data).success;
                     $('#maintenance_form_batch')[0].reset();
                     $('.clse').click();
                     $('#spin-batch').addClass('hide');
                     id.css({'background-color':'blue','color':'white'});
                     $('#error_batch').html('');
                     swal("Good job!",'Successful', "success");
                    // location.reload();
                     
                     
                 }
                 else
                 {
                        $('.fa-spin').addClass('hide');
                        var obj = data.error;
                        console.log(obj);
                        error_data='';
                        $('#spin-batch').addClass('hide');
          
                        if(typeof obj.from !== 'undefined'){
                             error_data += obj.from+'<br>';
                        }
            
                        if(typeof obj.to !== 'undefined'){
                                error_data += obj.to+'<br>';
                        }
                        
                        if(typeof obj.remarks !== 'undefined'){
                                error_data += obj.remarks+'<br><br>';
                        }
               
          
                        $('#error_batch').html(error_data);
          
                  }
            
                   
                  
                   
      
           });
    
}


function updateMaintenance(room_no)
{
            id = $('#b-'+room_no);
            
            $('#spin-'+room_no).removeClass('hide');
            
            $.ajax({
                 url: "api/AddRoomCondition",
                 method: "get",
                 headers: {

                    'Authorization':'Bearer '+$('#access_token').val()
                 },
                data:$('#maintenance_form'+room_no).serialize()
             }).done(function(data) {
                 
                 console.log(data);
                 
                 //alert(obj.msg);
                 
        
                 if(typeof data.success !== 'undefined'){
                     //obj = JSON.parse(data).success;
                     $('#maintenance_form'+room_no)[0].reset();
                     $('.clse').click();
                     $('#spin-'+room_no).addClass('hide');
                     id.css({'background-color':'blue','color':'white'});
                     $('#error'+room_no).html('');
                     swal("Good job!",'Successful', "success");
                     
                     
                 }
                 else
                 {
                        $('.fa-spin').addClass('hide');
                        var obj = data.error;
                        console.log(obj);
                        error_data='';
                        $('#spin-'+room_no).addClass('hide');
          
                        if(typeof obj.from !== 'undefined'){
                             error_data += obj.from+'<br>';
                        }
            
                        if(typeof obj.to !== 'undefined'){
                                error_data += obj.to+'<br>';
                        }
                        
                        if(typeof obj.remarks !== 'undefined'){
                                error_data += obj.remarks+'<br><br>';
                        }
               
          
                        $('#error'+room_no).html(error_data);
          
                  }
            
                   
                  
                   
      
           });
    
}

// add Hotel Details

$( "#addHotelDetailsBtn" ).click(function() {
   
   var cropcanvas = $('#image').cropper('getCroppedCanvas');
  
   $('.fa-spin').removeClass('hide');

     var formData = new FormData(document.getElementById('addHotelDetailsForm'));
     
     if(cropcanvas !== null)
     {
        var croppng = cropcanvas.toDataURL("image/png");
        formData.append('Image', croppng);

     }
    
   $.ajax({
        url: "api/addHotelDetails",
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
          $('#addHotelDetailsForm')[0].reset();
          location.reload();
          $('.fa-spin').addClass('hide');
      }
      else
      {
          $('.fa-spin').addClass('hide');
          var obj = data.error;
          error_data='';
          
          if(typeof obj.hotel_name !== 'undefined'){
              error_data += obj.hotel_name+'<br>';
          }
          
          if(typeof obj.Image !== 'undefined')
          {
              error_data += obj.Image+'<br>';
          }
           
         $('#error').html(error_data);
          
      }
      
   });
    
});





