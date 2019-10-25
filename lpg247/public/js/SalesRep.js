    
                
$(window).on('load', function() {
    // code here
    if( $('.sales-rep-table').length)
    {
        loadSalesRep("api/getAllSalesRep?sales_reps=1",1);
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


/*
$( "#searchOrderBtn" ).click(function() {
    loadSalesRep('api/getAllSalesRep?marketer_id='+$('#marketer_id').val()+'&orders=1&date_range='+$('#dates').val(),1)
});
*/


function loadSalesRep(url,page_number){
        
    
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
                        
                        page_no = (Math.ceil(parseFloat(e.no_sales_rep)/1))
                        
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


$('body').on('click', '.VerifySalesRep', function() {
    
    obj = $(this);
    
    $.ajax({
                                
            url: 'api/SalesRep/Verify/'+$(this).attr('id'),
            method: "put",
            headers: {
                        'Authorization':'Bearer '+$('#access_token').val()
                    },
            error : function(e) {
                                    
                    },
            success: function(e) {
                
                obj.parent('.td').html('<i class="fa fa-check font-24 success-color" aria-hidden="true"></i>');
                console.log($(this).parent().find('div'));
                swal("Good job!",'Verification Successful', "success");
                
            }
    });
    
    
});


$('body').on('click', '.SuspendSalesRep', function() {
    
    obj = $(this);
    
    $.ajax({
                                
            url: 'api/SalesRep/Suspend?sales_rep_id='+$(this).attr('id')+'&data='+$(this).attr('data'),
            method: "put",
            error : function(e) {
                                    
                    },
            headers: {
                        'Authorization':'Bearer '+$('#access_token').val()
                    },
                                
            success: function(e) {
                console.log(e);
                if(e.data == 1)
                {
                    obj.html('Suspend');
                    obj.attr('data',1);
                }
                else{
                    obj.html('Un-Suspend');
                    obj.attr('data',0);
                }
                
                swal("Good job!",'Suspension Successful', "success");
                
            }
    });
    
    
});



function getProductName(product_id)
{
    
    switch (product_id) {
        
        case 1:
            return 'AGO';
            
        case 2:
            return 'LPG';
            
        case 3:
            return 'BITUMEN';
            
        case 4:
            return 'PMS';
 
    }
    
}


