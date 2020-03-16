    
                
$(window).on('load', function() {
    // code here
    onDeviceReady();
    
});                
                
    
function onDeviceReady(){
        
    var options = {
        enableHighAccuracy: true,
        maximumAge: 3600000
    }
   
    navigator.geolocation.getCurrentPosition(function(position){
       
        $('#latitude').val(position.coords.latitude);
                  
        $('#longitude').val(position.coords.longitude);
              
        var geocoder = new google.maps.Geocoder();
        
        geocoder.geocode({"address":position.coords.latitude+','+position.coords.longitude }, function(results, status) {
                        
                if (status == google.maps.GeocoderStatus.OK) {
                        
                    window.localStorage.setItem("address", results[0].formatted_address);
                    
                    $.ajax({
                                
                        url: "api/getMarketers?address="+results[0].formatted_address,
                        method: "get",
                        error : function(e) {
                                    
                                },
                                
                        success: function(e) {
                                    
                            console.log(e);
                                    
                            marketers = e.users;
       
                            var value='';id=''; href='#';
                            
                            $('#load').removeClass('hide');
                            
                            star_rating = ''; 
                                   
                            for(i=0;i<marketers.length;i++)
                            {
                                       
                                price = marketers[i].price_per_qty;
                                
                                id += marketers[i].id + ',';
                                       
                                imageUrl = marketers[i].picture;
                                        
                                companyName = marketers[i].fullName;
                                        
                                unit_of_measurement = 'Kg';
                                
                                buyLink = 'data-toggle="modal" data-target="#exampleModal"';
                                
                                star_rating = ''; 
                                
                                if(marketers[i].star_rating !== null)
                                {
                                    for(j=0;j<parseInt(marketers[i].star_rating);j++)
                                    {
                                        star_rating += '<i class="fa fa-star"></i>';
                                    }
                                    
                                }
                                                                      
                                if(marketers[i].marketer_type == 1)
                                {
                                    unit_of_measurement = 'Tonne';
                                }
                                
                                if($('#auth').val() == '')
                                {
                                    href = 'login?buy=1';
                                    
                                    buyLink = '';
                                }
                                                
                                value +=  '<li class="col-sm-3"><div class="items-in">';
                                        
                                value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                                value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                                value += '<li> <a href="marketer_profile?marketer_id='+marketers[i].id+'"><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                                value += '<li class="full-w"> <a '+buyLink+' href="'+href+'" onClick=\'setValues('+price+',"'+unit_of_measurement+'",'+marketers[i].cost_of_delivery+','+marketers[i].id+',"'+marketers[i].address+'")\' class="btn">Buy</a></li><!-- Rating Stars --><li class="stars">'+star_rating+'</li>';
                                        
                                value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div></li>';
                                        
                                        
                            }
                           
                            $('#products').html(value);
                
                            $('#last_id').val(id);
                                  
                        }
                   });
            
                }
                    
        });
                  

   }, onError, options);
            
               
    function onError(suc)
    {
         
    }    
}

var ScrollDebounce = true;

/*
$(window).scroll(function() {
    
   
   
   if (ScrollDebounce  ) {
       
       ScrollDebounce = false;
       
       $.ajax({
           
            url: "api/getMarketers?last_id="+$('#last_id').val()+"&address="+window.localStorage.getItem("address"),
            method: "get",
            error : function(e) {
                                    
            },
            success: function(e) {
                                    
                console.log(e);
                
                console.log(2);
                                    
                marketers = e.users;
       
                var value='';id=''; href='#';
                                   
                for(i=0;i<marketers.length;i++)
                {
                                       
                    price = marketers[i].price_per_qty;
                    
                    id += marketers[i].id + ',';
                                       
                    imageUrl = marketers[i].picture;
                                        
                    companyName = marketers[i].fullName;
                                        
                    unit_of_measurement = 'Kg';
                                        
                    if(marketers[i].marketer_type == 1)
                    {
                        unit_of_measurement = 'Tonne';
                    }
                    
                    if($('#auth').val() == '')
                    {
                        href = 'login';
                    }
                                                
                    value +=  '<li class="col-sm-3"><div class="items-in">';
                                        
                    value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                    value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                    value += '<li> <a href="#."><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                    value += '<li class="full-w"> <a data-toggle="modal" data-target="#exampleModal" href="'+href+'" class="btn">Buy</a></li><!-- Rating Stars --><li class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></li>';
                                        
                    value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div></li>';
                                        
                                        
                }
                
                
                
                if(marketers.length > 0)
                {
                    $('#products').html($('#products').html()+value);
                    $('#last_id').val($('#last_id').val()+id);
                }
            
            }
        
        });
        
       setTimeout(function () { ScrollDebounce = true; }, 500);
   }
   
});
*/


function load_more()
{
       $('.load-icon').removeClass('hide');
       
       if($('#filter_active').val() == 0)
       {
            $.ajax({
           
            url: "api/getMarketers?last_id="+$('#last_id').val()+"&address="+window.localStorage.getItem("address"),
            method: "get",
            error : function(e) {
                                    
            },
            success: function(e) {
                                    
                console.log(e);
                
                console.log(2);
                                    
                marketers = e.users;
       
                var value='';id=''; href='#';
                
                if(marketers.length == 0)
                {
                    alert('No more Items To Load');
                }
                                   
                for(i=0;i<marketers.length;i++)
                {
                                       
                    price = marketers[i].price_per_qty;
                    
                    id += marketers[i].id + ',';
                                       
                    imageUrl = marketers[i].picture;
                                        
                    companyName = marketers[i].fullName;
                                        
                    unit_of_measurement = 'Kg';
                                        
                    buyLink = 'data-toggle="modal" data-target="#exampleModal"';
                                
                    star_rating = ''; 
                                
                    if(marketers[i].star_rating !== null)
                    {
                        for(j=0;j<parseInt(marketers[i].star_rating);j++)
                        {
                            star_rating += '<i class="fa fa-star"></i>';
                        }
                                    
                    }
                                                                      
                    if(marketers[i].marketer_type == 1)
                    {
                        unit_of_measurement = 'Tonne';
                    }
                                
                    if($('#auth').val() == '')
                    {
                        href = 'login?buy=1';
                                    
                        buyLink = '';
                    }
                                                
                    value +=  '<li class="col-sm-3"><div class="items-in">';
                                        
                    value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                    value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                    value += '<li> <a href="marketer_profile?marketer_id='+marketers[i].id+'"><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                    value += '<li class="full-w"> <a '+buyLink+' href="'+href+'" onClick=\'setValues('+price+',"'+unit_of_measurement+'",'+marketers[i].cost_of_delivery+','+marketers[i].id+',"'+marketers[i].address+'")\' class="btn">Buy</a></li><!-- Rating Stars --><li class="stars">'+star_rating+'</li>';
                                        
                    value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div></li>';
                                        
                                        
                }
                
                
                
                if(marketers.length > 0)
                {
                    $('#products').html($('#products').html()+value);
                    $('#last_id').val($('#last_id').val()+id);
                }
            
            }
        
        });
       }
       else{
           
           $.ajax({
           
            url: "api/getMarketers?last_id="+$('#last_id').val()+"&city="+$('#city_filter').val(),
            method: "get",
            error : function(e) {
                                    
            },
            success: function(e) {
                                    
                //console.log(e);
                
                marketers = e.users;
       
                var value='';id=''; href='#';
                
                if(marketers.length == 0)
                {
                    alert('No more Items To Load');
                }
                                   
                for(i=0;i<marketers.length;i++)
                {
                                       
                    price = marketers[i].price_per_qty;
                    
                    id += marketers[i].id + ',';
                                       
                    imageUrl = marketers[i].picture;
                                        
                    companyName = marketers[i].fullName;
                    
                    unit_of_measurement = 'Kg';
                                        
                    buyLink = 'data-toggle="modal" data-target="#exampleModal"';
                                
                    star_rating = ''; 
                                
                    if(marketers[i].star_rating !== null)
                    {
                        for(j=0;j<parseInt(marketers[i].star_rating);j++)
                        {
                            star_rating += '<i class="fa fa-star"></i>';
                        }
                                    
                    }
                                                                      
                    if(marketers[i].marketer_type == 1)
                    {
                        unit_of_measurement = 'Tonne';
                    }
                                
                    if($('#auth').val() == '')
                    {
                        href = 'login?buy=1';
                                    
                        buyLink = '';
                    }
                                                
                    value +=  '<li class="col-sm-3"><div class="items-in">';
                                        
                    value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                    value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                    value += '<li> <a href="marketer_profile?marketer_id='+marketers[i].id+'"><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                    value += '<li class="full-w"> <a '+buyLink+' href="'+href+'" onClick=\'setValues('+price+',"'+unit_of_measurement+'",'+marketers[i].cost_of_delivery+','+marketers[i].id+',"'+marketers[i].address+'")\' class="btn">Buy</a></li><!-- Rating Stars --><li class="stars">'+star_rating+'</li>';
                                        
                    value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div></li>';
                                        
                                        
                }
                
                if(marketers.length > 0)
                {
                    $('#products').html($('#products').html()+value);
                    $('#last_id').val($('#last_id').val()+id);
                }
            
            }
        
        });
        
       }
        
       $('.load-icon').addClass('hide');
    
}


function setValues(price,unit_of_measurement,cost_of_delivery,marketer_id,address){
    $('#cost_price_per_qty').val(price);
    $('#cost_price_per_qty').attr('placeholder','Price Per '+unit_of_measurement);
    $('#volume').attr('placeholder','Volume In '+unit_of_measurement);
    $('#ct_delivery').val(cost_of_delivery);
    //alert(marketer_id);
    $('#marketer').val(marketer_id);
    window.localStorage.setItem("marketer_address", address);
   // $('#autocomplete').val(delivery_address);
}

function calculate_total_cost_price()
{
    result = parseFloat($('#cost_price_per_qty').val()) * parseFloat( $('#volume').val());
    $('#cost_price').val(result);
    overall_cost();
}

$( "#city_filter" ).change(function() {
    
      $('#filter_active').val(1);
      
      
      
      if($( "#city_filter" ).val() !== '')
      {
          
            $.ajax({
                                
                url: "api/getMarketers?city="+$('#city_filter').val(),
                method: "get",
                error : function(e) {
                                    
                    },
                success: function(e) {
                                    
                        console.log(e);
                
                        marketers = e.users;
       
                        var value='';id=''; href='#';
                            
                        $('#load').removeClass('hide');
                        
                        
                        for(i=0;i<marketers.length;i++)
                        {
                                       
                            price = marketers[i].price_per_qty;
                                
                            id += marketers[i].id + ',';
                                       
                            imageUrl = marketers[i].picture;
                                        
                            companyName = marketers[i].fullName;
                                        
                            unit_of_measurement = 'Kg';
                                        
                            buyLink = 'data-toggle="modal" data-target="#exampleModal"';
                                
                            star_rating = ''; 
                                
                            if(marketers[i].star_rating !== null)
                            {
                                for(j=0;j<parseInt(marketers[i].star_rating);j++)
                                {
                                    star_rating += '<i class="fa fa-star"></i>';
                                }
                                    
                            }
                                                                      
                            if(marketers[i].marketer_type == 1)
                            {
                                unit_of_measurement = 'Tonne';
                            }
                                
                            if($('#auth').val() == '')
                            {
                                href = 'login?buy=1';
                                    
                                buyLink = '';
                            }
                       
                                                
                            value +=  '<li class="col-sm-3"><div class="items-in">';
                                        
                            value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                            value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                            value += '<li> <a href="marketer_profile?marketer_id='+marketers[i].id+'"><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                            value += '<li class="full-w"> <a '+buyLink+' href="'+href+'" onClick=\'setValues('+price+',"'+unit_of_measurement+'",'+marketers[i].cost_of_delivery+','+marketers[i].id+',"'+marketers[i].address+'")\' class="btn">Buy</a></li><!-- Rating Stars --><li class="stars">'+star_rating+'</li>';
                                        
                            value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div></li>';
                                        
                                        
                        }
                            
                        if(marketers.length == 0)
                        {
                            value = 'No Result For This Query';
                        }
                           
                        $('#products').html(value);
                
                        $('#last_id').val(id);
                        
                        
                    }
            });
      }
      else{
          alert('Please select a city to filter by');
      }
      
});



function overall_cost()
{
    $('#overall_cost').val((parseFloat($('#cost_price').val()) + parseFloat($('#cost_of_delivery').val())).toLocaleString());
}

function getDistance()
{
    $.ajax({
                                
        url: "api/getDistance?address="+window.localStorage.getItem("marketer_address")+'&address2='+$('#autocomplete').val(),
                        method: "get",
        error : function(e) {
                                    
                },
                                
        success: function(e) {
                              
                    distance = e.distance;
                 
                    $('#cost_of_delivery').val(parseFloat($('#ct_delivery').val()) * parseFloat(distance));
                    overall_cost();
                        
                       // alert(distance);
            
                }
     });
    
}

function createOrder()
{

    $.ajax({
                                
        url: "api/order/create",
        method: "post",
        data:$('#OrderForm').serialize(),
        error : function(e) {
            
            obj = JSON.parse(e.responseText).error;
            
          
            $('.fa-spin').addClass('hide');
                
            error_data='';
            
            console.log(obj);
                
            if(typeof obj.volume !== 'undefined'){
                error_data += obj.volume+'<br>';
            }
          
            if(typeof obj.delivery_location !== 'undefined')
            {
                error_data += obj.delivery_location+'<br>';
            }
                
            if(typeof obj.wallet !== 'undefined')
            {
                error_data += obj.wallet+'<br>';
            }
            
            if(typeof obj.error !== 'undefined')
            {
                error_data += obj.error+'<br>';
            }
            
            $('#error').html(error_data);
                                    
                },
                                
        success: function(e) {
                              
                alert('Order Placed Successfully');
                location.reload();
       
                }
     });
    
}
