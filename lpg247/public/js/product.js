
$( "#addProductBtn" ).click(function() {
    
   $('.fa-spin').removeClass('hide');
   
 
   var formData = new FormData(document.getElementById('addProductForm'));
   
   $.ajax({
       
        url: "api/add_product",
        method: "post",
        headers: {
           'Accept':'application/json',
           'Authorization':'Bearer '+$('#access_token').val()
        },
        data:formData,
        cache : false,
        contentType: false,
        processData: false,
        error: function(e) {
            
            obj = JSON.parse(e.responseText).error;
            
            error_data = '';
          
            if(typeof obj.product_name !== 'undefined'){
                error_data += obj.product_name+'<br>';
            }
          
            if(typeof obj.error !== 'undefined')
            {
                error_data += obj.error+'<br>';
            }
            
            $('.fa-spin').addClass('hide');
            
            $('#error').html(error_data);
    
        },
        success: function(e) {
            swal("Good job!",'Add Successful', "success");
            location.reload();
        }
   });
    
});


 
                
$(window).on('load', function() {
    // code here
    if( $('.all-products-table').length)
    {
        loadProducts("api/getAllProducts?products=1",1);
    }
    
    setTimeout(function(){ 
        
         $('#table-2').DataTable({
        dom: 'Bfrtip',
        paging:false,
        searching:true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
       
    });
        
    }, 3000);
    
   
    
}); 



function loadProducts(url,page_number){
        
    
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
                                    
                        all_products = e.all_products.data;
       
                        var value='';id=''; href='#';
                            
                        for(i=0;i<all_products.length;i++)
                        {
                                       
                                obj = all_products[i];
                                
                                value += '<tr>';
    
                                value +=  '<td>'+obj.product_name+'</td> ';
                                
                                value +=  '<td><button class="border-radius-5 background-color-blue text-color-white border-none" onclick="PopupEdit(\''+obj.product_name+'\','+obj.id+')">&nbsp; &nbsp;Edit &nbsp; &nbsp; </button></td> ';
                                
                                value +=  '<td><button class="border-radius-5 background-color-red text-color-white border-none" onClick="deleteProduct('+obj.id+')" >Delete</button></td> ';
                                
                                value += '</tr>';
                                
                        }
                            
                        
                        prev_page_no = parseInt(e.no_products) - 1;
                        
                        if(e.no_products == 1)
                        {
                            prev_page_no = 1;
                        }
                            
                        pages = '<li onclick=\'loadProducts("'+e.all_products.prev_page_url+'",'+prev_page_no+')\'><a href="#">Previous</a></li>';
                        
                        page_no = (Math.ceil(parseFloat(e.no_products)/30))
                        
                        for(j=1;j<=page_no;j++)
                        {
                            active = '';
                    
                            if(j == page_number)
                            {
                                active = 'active';
                            }
                            
                           
                            
                            page_url = "api/getAllProducts?products="+j+"";
                            
                            
                            
                            pages+= '<li class="'+active+'" onclick=\'loadProducts("'+encodeURI(page_url)+'",'+j+')\'><a href="#">'+j+'</a></li>';
                        }
                        
                        console.log(e.no_products);
                        
                        next_page_no = parseInt(e.no_products) ;
                        
                    
                        if(e.all_products.next_page_url != null){
                            
                            next_page_no =  parseInt(e.all_products.next_page_url.split('=')[1]);
                            
                            pages += '<li onclick=\'loadProducts("'+e.all_products.next_page_url+'",'+next_page_no+')\'><a href="#">Next</a></li>';
                        
                        }
                            
                        if(all_products.length > 0){
                            
                            $('#products_rows').html(value);
                            $('.all-products-table').removeClass('hide');
                            $('.load-circle').addClass('hide');
                            $('.products-pagination').html(pages);
                         
                            
                        }
                        else{
                            
                            $('.load-circle').html('<div>You have No available Products</div>');
                            $('.all-products-table').addClass('hide');
                            $('.load-circle').removeClass('hide');
                        }
                        
                            
                                  
                    }
            });
        
             

}


function PopupEdit(product_name,id)
{
    $('#product_name').val(product_name);
    
    $('#product_id').val(id);
    
    $('#productModal').modal('show');

}

function editProduct()
{
    obj = $(this);
    
    $.ajax({
                                
            url: 'api/editProduct',
            method: "put",
            headers: {
                        'Authorization':'Bearer '+$('#access_token').val()
                    },
                    
            data: $('#editProductsForm').serialize(),
                    
            error : function(e) {
                
                obj = JSON.parse(e.responseText).error;
            
                error_data = '';
          
                if(typeof obj.product_name !== 'undefined'){
                    error_data += obj.product_name+'<br>';
                }
          
                if(typeof obj.error !== 'undefined')
                {
                    error_data += obj.error+'<br>';
                }
            
                $('.fa-spin').addClass('hide');
            
                $('#error').html(error_data);
                                    
            },
                                
            success: function(e) {
                
                console.log(e);
                $('#error').html('');
                swal("Good job!",'Edit Successful', "success");
                location.reload();
                
            }
    });
    
}

function deleteProduct(id)
{
    obj = $(this);
    
    $.ajax({
                                
            url: 'api/deleteProduct/'+id,
            method: "delete",
            headers: {
                        'Authorization':'Bearer '+$('#access_token').val()
                    },
                    
                    
            error : function(e) {
                
                obj = JSON.parse(e.responseText).error;
            
                console.log(obj);
                                    
            },
                                
            success: function(e) {
                
                console.log(e);
                swal("Good job!",'Delete Successful', "success");
                location.reload();
                
            }
    });
    
}



