$( ".add-user" ).click(function() {
    
    $('.fa-spin').removeClass('hide');
    
    var formData = new FormData(document.getElementById('createUserForm'));
    
    $.ajax({
            url: "api/addUser",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:formData,
            cache : false,
            contentType: false,
            processData: false,
            error: function(e){
                 var obj = JSON.parse(e.responseText).error;
                 $('.fa-spin').addClass('hide');
                 $('#error').html(correlateRegisterUserErrorMsg(obj));
            },
            success: function(e){
                
                swal("Good job!",'Successful', "success");
                $('#error').html('');
                $('#createUserForm')[0].reset();
                $('.fa-spin').addClass('hide');
                location.reload();
            }
            
    });
  
});

$(window).on('load', function() {
    // code here
    if( $('.sales-rep-table').length)
    {
        loadAllUsers("api/getAllUsers?marketer_id="+$('#marketer_id').val()+"&orders=1",1);
    }
    
    setTimeout(function(){ 
        
         $('#table-1').DataTable({
        dom: 'Bfrtip',
        paging:false,
        searching:true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
       
    });
        
    }, 3000);
    
   
    
}); 



$( "#searchOrderBtn" ).click(function() {
    loadSalesRep('api/getAllSalesRep?marketer_id='+$('#marketer_id').val()+'&orders=1&date_range='+$('#dates').val(),1)
});


function loadAllUsers(url,page_number){
        
    
        $.ajax({
                                
            url: url,
            method: "get",
            error : function(e) {
                                    
                    },
            headers: {
                        //'Accept':'application/json',
                        'Authorization':'Bearer '+$('#access_token').val()
                    },
                                
            success: function(e) {
                                    
                        console.log(e);
                                    
                        sales_reps = e.all_sales_rep.data;
       
                        var value='';id=''; href='#';
                            
                        for(i=0;i<sales_reps.length;i++)
                        {
                                       
                                obj = sales_reps[i];
                                
                                value += '<tr>';
    
                                value +=  '<td>'+obj.email+'</td> <td>'+obj.fullName+'</td>';
                                        
                                value +=  '<td>'+obj.phoneNumber+'</td>';
                                
                                value +=  '<td>'+obj.marketer_name+'</td> <td>'+obj.locationOfDepot+'</td>';
                                
                                product_name = getProductName(obj.product_to_sell);
                                
                               
                                
                                date = new Date(obj.created_at);
                                
                                month = parseInt(date.getMonth())+1;
                                
                                value += '<td>'+date.getDate()+'-'+month+'-'+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes()+'</td>';
                                
                                if(obj.verified == 1)
                                {
                                    verified_value = '<i class="fa fa-check font-24 success-color" aria-hidden="true"></i>';
                                }
                                else{
                                    
                                    verified_value = '<button class="VerifySalesRep border-radius-5 background-color-blue text-color-white border-none" id="'+obj.id+'">Verify</button>';
                                }
                                
                                if(obj.active == 1)
                                {
                                    suspend_value = 'Suspend';
                                }
                                else{
                                    
                                    suspend_value = 'Un-Suspend';
                                }
                                
                                value +=  '<td>'+product_name+'</td> <td class="td" >'+verified_value+'</td>';
                                
                               
                                
                                value +=  '<td><button class="SuspendSalesRep border-radius-5 background-color-blue text-color-white border-none" id="'+obj.id+'"   data="'+obj.active+'">'+suspend_value+'</button></td></tr>';
                                
                            }
                            
                        
                        prev_page_no = parseInt(e.no_sales_rep) - 1;
                        
                        if(e.no_sales_rep == 1)
                        {
                            prev_page_no = 1;
                        }
                            
                        pages = '<li onclick=\'loadSalesRep("'+e.all_sales_rep.prev_page_url+'",'+prev_page_no+')\'><a href="#">Previous</a></li>';
                        
                        page_no = (Math.ceil(parseFloat(e.no_sales_rep)/30))
                        
                        for(j=1;j<=page_no;j++)
                        {
                            active = '';
                    
                            if(j == page_number)
                            {
                                active = 'active';
                            }
                            
                           
                            
                            page_url = "api/getAllSalesRep?sales_reps="+j+"";
                            
                            if(e.search == 1)
                            {
                                page_url = "api/getAllSalesRep?marketer_id="+$('#marketer_id').val()+"&date_range="+$('#dates').val();
                                
                                page_url+= "&orders_search="+j+"" ;
                            }
                            
                            pages+= '<li class="'+active+'" onclick=\'loadSalesRep("'+encodeURI(page_url)+'",'+j+')\'><a href="#">'+j+'</a></li>';
                        }
                        
                        console.log(e.no_sales_rep);
                        
                        next_page_no = parseInt(e.no_sales_rep) ;
                        
                    
                        if(e.all_sales_rep.next_page_url != null){
                            
                            next_page_no =  parseInt(e.all_sales_rep.next_page_url.split('=')[1]);
                            
                            pages += '<li onclick=\'loadSalesRep("'+e.all_sales_rep.next_page_url+'",'+next_page_no+')\'><a href="#">Next</a></li>';
                        
                        }
                            
                        if(sales_reps.length > 0){
                            
                            $('#sales_rep_rows').html(value);
                            $('#last_id').val(id);
                            $('.sales-rep-table').removeClass('hide');
                            $('.load-circle').addClass('hide');
                            $('.sales-rep-pagination').html(pages);
                         
                            
                        }
                        else{
                            
                            $('.load-circle').html('<div>You have No available Sales Representatives</div>');
                            
                            if(e.search == 1)
                            {
                                $('.load-circle').html('<div>You have No Sales Representative for this Query</div>');
                            }
                            
                            $('.sales-rep-table').addClass('hide');
                            $('.load-circle').removeClass('hide');
                        }
                        
                            
                                  
                    }
            });
        
             

}


function editUser()
{
    
    var formData = new FormData(document.getElementById('editUserForm'));
   
    $.ajax({
            url: "api/editUser",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:formData,
            cache : false,
            contentType: false,
            processData: false,
            error: function(e){
                
                $('.fa-spin').addClass('hide');
                var obj = JSON.parse(e.responseText).error;
         
                $('#error').html(correlateRegisterUserErrorMsg(obj));
                
            },
            success: function(e){
                
                swal("Good job!",'Successful', "success");
                $('#error').html('');
                $('.fa-spin').addClass('hide');
                location.reload();
                
            }
    });
    
}

var $inputImage = $('.image-user');

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
    

$( "#editUserBtn" ).click(function() {
    
    $('.fa-spin').removeClass('hide');
    
    save_cropped_pic2();
     
    setTimeout(function(){ editUser(); }, 3000);
    
    
  
});

function save_cropped_pic2()
{
    var cropcanvas = $('#picture').cropper('getCroppedCanvas',{width: 270, height: 340});
                                     
    if(cropcanvas !== null  )
    {
        var croppng = cropcanvas.toDataURL("image/png");
        $('#photo').val(croppng);
    }
    
    
}


$('#user_category').change(function() {
    
    if($(this).val() == '1'){
        
        $('#fullName').attr("placeholder", "Enter Company Name");
        $('#documents').removeClass('hide');
    } 
    else{
        $('#documents').addClass('hide');
        $('#fullName').attr("placeholder", "Enter Full Name");
    }
    
});

$( ".login-btn" ).click(function() {
    
       
    $('.fa-spin').removeClass('hide');
    
    $.ajax({
            url: "api/loginUser",
            method: "post",
            headers: {
               'Accept':'application/json',
            },
            data:$('#loginUserForm').serialize(),
            error: function (e) {
                
                error_data = JSON.parse(e.responseText).error;
                
                $('.fa-spin').addClass('hide');
            
                $('#error').html(error_data);
                
            },
            success: function (e) {
  
                data = e.success;
                
                if(data.sub_users){
                    window.open('/sub_home','_self');
                }
                else{
                     window.open('/user_profile','_self');
                }
                
               
                $('.fa-spin').addClass('hide');
        
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
    
    if(typeof obj.about_company !== 'undefined')
    {
        error_data += obj.about_company+'<br>'; 
    }
    
    if(typeof obj.marketer_type !== 'undefined')
    {
        error_data += obj.marketer_type+'<br>'; 
    }
    
    if(typeof obj.user_category !== 'undefined')
    {
        error_data += obj.user_category+'<br>'; 
    }
    
    if(typeof obj.major_marketer !== 'undefined')
    {
        error_data += obj.major_marketer+'<br>'; 
    }
    
    if(typeof obj.cacNumber !== 'undefined')
    {
        error_data += obj.cacNumber+'<br>'; 
    }
    
    if(typeof obj.photo !== 'undefined')
    {
        error_data += obj.photo+'<br>'; 
    }
    
    if(typeof obj.dprLicenseNumber !== 'undefined')
    {
        error_data += obj.dprLicenseNumber+'<br>'; 
    }
    
    if(typeof obj.city_of_location !== 'undefined')
    {
        error_data += obj.city_of_location+'<br>'; 
    }
    
    return error_data;
}

function chooseMajorMarketers()
{
    if($('#marketer_type').val() == 1)
    {
        $('#major_marketers').removeClass('hide');
    }
    else{
        $('#major_marketers').addClass('hide');
    }
    
}

