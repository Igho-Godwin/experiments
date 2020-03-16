    
                
$(window).on('load', function() {
    // code here
    loadRelatedMarketers();
});                
                
    
function loadRelatedMarketers(){
    
    //alert(window.location.search);
    
    const urlParams = new URLSearchParams(window.location.search);

    $.ajax({
                                
        url: "api/relatedMarketers?id="+urlParams.get('marketer_id'),
        method: "get",
        error : function(e) {
                                    
               },
                                
        success: function(e) {
                                    
                    console.log(e);
                                    
                    marketers = e.related_marketers;
       
                    var value='';id=''; href='#';
                            
                    star_rating = ''; 
                                   
                    for(i=0;i<marketers.length;i++)
                    {
                                       
                        price = marketers[i].price_per_qty;
                                
                        id += marketers[i].id + ',';
                                       
                        imageUrl = marketers[i].picture;
                                        
                        companyName = marketers[i].fullName;
                                        
                        unit_of_measurement = 'Kg';
                                
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
                            href = 'login';
                        }
                                                
                        value +=  '<div class="items-in">';
                                        
                        value += '<!-- Image --> <img src="'+imageUrl+'" alt=""> <!-- Hover Details --><div class="over-item"><ul class="animated fadeIn">'
                                        
                        value += '<li> <a href="'+imageUrl+'" data-lighter><i class="ion-search"></i></a></li>';
                                        
                        value += '<li> <a href="marketer_profile?marketer_id='+marketers[i].id+'"><i class="ion-shuffle"></i></a></li><li class="hide"> <a href="#."><i class="fa fa-heart-o"></i></a></li>';
                                        
                        value += '<li class="full-w"> <a data-toggle="modal" data-target="#exampleModal" href="'+href+'" onClick=\'setValues('+price+',"'+unit_of_measurement+'",'+marketers[i].cost_of_delivery+','+marketers[i].id+',"'+marketers[i].address+'")\' class="btn">Buy</a></li><!-- Rating Stars --><li class="stars star-margin">'+star_rating+'</li>';
                                        
                        value += '</ul></div><!-- Item Name --><div class="details-sec"> <a href="#.">'+companyName+'</a> <span class="font-montserrat">'+price+' NGN Per '+unit_of_measurement+'</span> </div></div>';
                                        
                                        
                    }
                    
 
                           
                    $('#related-products').html(value);
                    
                    // reloads carousel
                     $(".client-slide").owlCarousel({ 
	                    autoplay:true,
	                    autoplayHoverPause:true,
	                    singleItem	: true,
	                    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	                    lazyLoad:true,
	                    nav: false,
	                    loop:true,
	                    margin:30,
	                    animateOut: 'fadeOut',	
	                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        800:{
                            items:3
                        },
                        1200:{
                            items:4
                        }}	
                    });
                    
                    
               
                    
                      
                
                                  
                }
            });
            


            
}
                    
   