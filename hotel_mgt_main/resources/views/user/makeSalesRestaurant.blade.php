@include('header.header')

<link rel='stylesheet' href='css/pearl-restaurant.css' />

<link href="fonts/pearl-icons.css" rel="stylesheet" type="text/css">


<body>
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('header.nav-header')
        
        @include('sidebar.sidebar')

        

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container">
                <div class='row background-color-white padding-30px ' style='width:100%;'>
                 
                          <h1 style='margin-left:auto;margin-right:auto;'>
                             Make Sales Restaurant
                          </h1>
                    </div>
                    
                    
                    <div class='row' > 
                        
                        <div class='col-sm-12'> 
                       
				             <div class="content">

		<div class="our-menu our-menu3">
			<div class="container">
				
				<div class="col-md-6">
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							<span>Main Course</span>
							<h1>HOT DISHES</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							@foreach($main_course as $val)
                            
                               <div class='col-sm-12'>
							     <div class="col-lg-3 col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-lg-9 col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                      </button>
                                    </div>
                                    
							     </div>
							 </div>
                                 
                                 
                            
				            @endforeach
                            
                            
                        </div>
                        
                        
                            
                        <div class='pull-right'>
                            @if($main_course !=null && count($main_course) > 0)
                                {{$main_course->links()}}
                            @endif    	
						</div>
                        
						
					</div>
					
				</div>
				
				
				
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							<span>Soups & Salads</span>
							<h1>SIDE DISHES</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							
							@foreach($soups as $val)
                                
                                <div class='col-sm-12'>
							     <div class="col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn  ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                        </button>
                                 </div>
                                    
							     </div>
							    </div>
                                 
                                 
                            
				            @endforeach
														
						</div>	
                        
                        <div class='pull-right'>
                            @if($soups !=null && count($soups) > 0)
                                {{$soups->links()}}
                            @endif    	
						</div>
						
					</div>
					
				</div>
				
				
				
				
				
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							<span>Chefâ€™s Pick</span>
							<h1>OF THE DAY</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							
							@foreach($chef_pick as $val)
							
                                <div class='col-sm-12'>
							     <div class="col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn  ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                      </button>
                                 </div>
                                    
							     </div>
							    </div>
                                 
                                 
                            
				            @endforeach
							
														
						</div>	
                        
                        <div class='pull-right'>
                            @if($chef_pick !=null && count($chef_pick) > 0)
                                {{$chef_pick->links()}}
                            @endif    	
						</div>
						
					</div>
					
				</div>
				
				
				
				
				
				</div>
				
				
				
				<div class="col-md-6">
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							<span>Starter</span>
							<h1>beginning</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							
							@foreach($starter as $val)
							
                                <div class='col-sm-12'>
							     <div class="col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn  ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                        </button>
                                 </div>
                                    
							     </div>
							    </div>
                                 
                                 
                                 
				            @endforeach
							
						</div>	
                        
                        <div class='pull-right'>
                            @if($starter !=null && count($starter) > 0)
                                {{$starter->links()}}
                            @endif    	
						</div>
						
					</div>
					
				</div>
				
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							
							<h1>SPECIALS food</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							
							@foreach($special_food as $val)
							
							    <div class='col-sm-12'>
                            
							     <div class="col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn  ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                        </button>
                                 </div>
                                    
							     </div>
							     
							    </div>
                                 
                                 
                                 
                            
				            @endforeach
							
						</div>	
                        
                        <div class='pull-right'>
                            @if($special_food !=null && count($special_food) > 0)
                                {{$starter->links()}}
                            @endif    	
						</div>
						
						
					</div>
					
				</div>
				
				
				
				<div class="menu-sec">
					
					<div class="row">
						<div class="col-md-12">
							<div class="main-title">
							<span>Desserts</span>
							<h1>MOST DELICIOUS</h1>
							</div>
						</div>
					</div>
					
					<div class="menu-detail">
						
						<div class="row">
							
							@foreach($deserts as $val)
							
							    <div class='col-sm-12'>
                            
							     <div class="col-md-3">
								     @if($val->picture != '')
                                        <img src='food_pic/{{$val->picture}}'  />
                                     @else
                                        <img src='food_pic/default-pic.jpg'  />
                                     @endif
                                 </div>
							
							     <div class="col-md-9">
								    <div class="food-detail">
									   <span class="title">{{$val->name}} &nbsp;<span class="price">&#8358;{{$val->price}}</span></span>
								    </div>
                                     
                                    <div class='text-right padding-bottom-20'>
                                      <button class='text-color-white background-color-red btn margin-top-10px add-btn  ' id='cart{{$val->id}}' onclick='add_to_cart("food_type",{{$val->id}})'>
                                          
                                          @if($menu_obj->checkCart('food_type',$val->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$val->id) == 1)
                                                Remove item From Cart
                                          @endif
                                          
                                        </button>
                                 </div>
                                    
							     </div>
							    </div>
                                 
                                 
                            
				            @endforeach
                          
											
						</div>	
                        
                          
                        <div class='pull-right'>
                            @if($special_food !=null && count($special_food) > 0)
                                {{$starter->links()}}
                            @endif    	
				       </div>
				       
				       <?php Session::put('url','makeSalesRestaurant'); ?>
						
						
					</div>
					
				</div>
				
				</div>
				
				
				
				<div class="col-md-6">
				
				
				
				
				
				
				</div>
				
				
			
				
				
				
				
				
			</div>
		</div>
		
	</div>	
                              <!--End Content-->
                            
                        </div>

                       <div class='col-sm-12'>
                       <div class='row padding-30px'>
                       <br>
                  
                           <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
