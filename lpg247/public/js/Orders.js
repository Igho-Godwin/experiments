    
                
$(window).on('load', function() {
    // code here
    if( $('.order-table').length)
    {
        LoadOrders("api/getOrders?marketer_id="+$('#marketer_id').val()+"&orders=1",1);
    }
    
}); 



$( "#searchOrderBtn" ).click(function() {
    LoadOrders('api/getOrders?marketer_id='+$('#marketer_id').val()+'&orders=1&date_range='+$('#dates').val(),1)
});


function LoadOrders(url,page_number){
        
    
        $.ajax({
                                
            url: url,
            method: "get",
            error : function(e) {
                                    
                    },
                                
            success: function(e) {
                                    
                        console.log(e);
                                    
                        orders = e.marketers_orders.data;
       
                        var value='';id=''; href='#';
                            
                        for(i=0;i<orders.length;i++)
                        {
                                       
                                obj = orders[i];
                                
                                value += '<tr>';
    
                                value +=  '<td>'+obj.order_no+'</td> <td>'+obj.fullName+'</td>';
                                        
                                value +=  '<td>'+obj.volume+'</td>';
                                
                                value +=  '<td>'+obj.delivery_location+'</td> <td>'+formatNumber(obj.delivery_cost)+'</td>';
                                
                                value +=  '<td>'+formatNumber(obj.cost_price)+'</td> <td>'+formatNumber(obj.total_cost)+'</td>';
                                
                                date = new Date(obj.created_at);
                                
                                month = parseInt(date.getMonth())+1;
                                
                                value += '<td>'+date.getDate()+'-'+month+'-'+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes()+'</td></tr>';
                                        
                                
                            }
                            
                        
                        prev_page_no = parseInt(e.orders) - 1;
                        
                        if(e.orders == 1)
                        {
                            prev_page_no = 1;
                        }
                            
                        pages = '<li onclick=\'LoadOrders("'+e.marketers_orders.prev_page_url+'",'+prev_page_no+')\'><a href="#">Previous</a></li>';
                        
                        page_no = (Math.ceil(parseFloat(e.no_marketers_orders)/30))
                        
                        for(j=1;j<=page_no;j++)
                        {
                            active = '';
                    
                            if(j == page_number)
                            {
                                active = 'active';
                            }
                            
                           
                            
                            page_url = "api/getOrders?marketer_id="+$('#marketer_id').val()+"&orders="+j+"";
                            
                            if(e.search == 1)
                            {
                                page_url = "api/getOrders?marketer_id="+$('#marketer_id').val()+"&date_range="+$('#dates').val();
                                
                                page_url+= "&orders_search="+j+"" ;
                            }
                            
                            pages+= '<li class="'+active+'" onclick=\'LoadOrders("'+encodeURI(page_url)+'",'+j+')\'><a href="#">'+j+'</a></li>';
                        }
                        
                        console.log(e.orders);
                        
                        next_page_no = parseInt(e.orders) + 1;
                        
                        pages += '<li onclick=\'LoadOrders("'+e.marketers_orders.next_page_url+'",'+next_page_no+')\'><a href="#">Next</a></li>';
                            
                        if(orders.length > 0){
                            
                            $('#orders').html(value);
                            $('#last_id').val(id);
                            $('.order-table').removeClass('hide');
                            $('.load-circle').addClass('hide');
                            $('.order-table-pagination').html(pages);
                         
                            
                        }
                        else{
                            
                            $('.load-circle').html('<div>You have No available Orders for this Sub Account</div>');
                            
                            if(e.search == 1)
                            {
                                $('.load-circle').html('<div>You have No Orders for this Query</div>');
                            }
                            
                            $('.order-table').addClass('hide');
                            $('.load-circle').removeClass('hide');
                        }
                        
                            
                                  
                    }
            });
        
             

}


