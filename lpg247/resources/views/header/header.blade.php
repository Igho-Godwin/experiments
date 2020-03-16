<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>JOEville ITS Hotel Management System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/f-logo.png">
    <link href="css/style.css" rel="stylesheet">
    
    <link href="assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
       <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">     
 
    
    <?php $i = 0; ?>
      <script>
    jQuery(function ($) {

     $( function() {
         
       //  jQuery.noConflict();
    
@if(Session::get('store_items') != null )

    var availableTags = [
       @foreach( Session::get('store_items') as $val)
            <?php $i++; ?>
            @if(count(Session::get('store_items')) == $i)
                '{{$val->itemName}}'
            @else
                '{{$val->itemName}}',
            @endif
       @endforeach
    ];
    
    if($( ".tags" ).length)
    {
        $( ".tags" ).autocomplete({
            source: availableTags
        });
    }

@endif

@if(Session::get('customer_suggestions') != null )

    <?php $id = []; ?>

       
    var available_firstname = [
       @foreach( Session::get('customer_suggestions') as $val)
            <?php $i++; ?>
            @if(count(Session::get('customer_suggestions')) == $i)
                <?php echo '{"label":"'.$val->first_name.'","value":"'.$val->first_name.'","id":"'.$val->id.'"}'; ?>,
            @else
                <?php echo  '{"label":"'.$val->first_name.'","value":"'.$val->first_name.'","id":"'.$val->id.'"}'; ?>,
            @endif
       @endforeach
    
    
    ]
    
    <?php $i=0; ?>
    
    
    
    $( "#firstname" ).autocomplete({
      source: available_firstname,
      select: function( event, ui ) {
                 retrieveSelectedIdData(ui.item.id);
               }
    });
    
    
    
 
  
  <?php Session::put('customer_suggestions',null) ?>

@endif

 });
 
    });
    
    function retrieveSelectedIdData(id)
    {
        $.ajax({
        url: "api/retrieveCustomerData",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:{id:id}
        }).done(function(data) {
            obj = data.data
            $('#lastname').val(obj.last_name);
            if(obj.last_name != null)
            {
                $('#selected_id').val(obj.id);
                console.log($('#selected_id').val());
            }
            
            $('#customer_type').val(obj.customer_type).change();
            
            if(obj.birthday !== null )
            {
                date = obj.birthday.split('-');
                
                console.log(date[2])
                
                if(typeof date[1] != 'undefined')
                {
                    $('#birth_month').val(date[1]).change();
                
                }
                
                if(typeof date[2] != 'undefined')
                {
                    if(parseInt(date[2]) < 10)
                    {
                         $('#birth_day').val(date[2].charAt(1)).change();
                    }
                    else{
                   
                        $('#birth_day').val(date[2]).change();
                    
                    }
                
                }
            }
            else{
                $('#birth_month').val('00').change();
                $('#birth_day').val('0').change();
            }
            
            $('#lastname').val(obj.last_name);
            $('#phone_number').val(obj.phone_number);
            $('#email_address').val(obj.email_address);
            $('#country').val(obj.country).change();
            $('#address').val(obj.address);
            
            $('#city').val(obj.city).change();
            state_id = obj.state;
            city_id = obj.city;
            setTimeout(function() {
               postState(state_id);
            }, 3000);
            
            setTimeout(function() {
               postCity(city_id);
            }, 6000);
            
       });
       
       
        
    }
    
    function postState(state_id)
    {
        $('#states').val(state_id).change();
    }
    
    function postCity(city_id)
    {
        $('#city').val(city_id).change();
    }
    
    function setIdToNull()
    {
         $('#selected_id').val(null);
         console.log($('#selected_id').val());
    }
    
 //   function return 
  
  </script>
  
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="bootstrap-tagsinput-master/dist/bootstrap-tagsinput.css" />
    <link href="css/main.css" rel="stylesheet">
    <link  href="cropper/cropper-master/dist/cropper.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    
 
  
 

</head>

