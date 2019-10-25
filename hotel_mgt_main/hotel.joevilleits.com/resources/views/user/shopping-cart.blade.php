
<link href="css/style2.css" rel="stylesheet">
@include('header.header')

 

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
                <div class='row background-color-white width-100percent padding-5px'>
                   <div class='padding-30px'>
                      <h1 class='text-center'>
                        Shopping Cart
                      </h1>
                      
                   </div>
                
                    <br>
                <div class="col-xs-12  col-sm-12  col-md-12">
                    <form id='cart-form' > 
                       <div >   
                        <div class='pull-left' style='margin-bottom:30px;'>
                             <select name='hotel_customer' class='form-control'>
                                 <option value=''>Select An Hotel Customer</option>
                                 @foreach($rooms as $val)
                                    <option value='{{$val->customer_id}}'>{{$obj->getCustomerName($val->customer_id)}}</option>
                                 @endforeach
                             </select>
                        </div>
                        <div class='pull-right' style='margin-bottom:30px;'>
                             <button class='text-color-white background-color-red btn margin-top-10px ' onclick='ClearCart()'>
                                Clear Cart
                            </button>
                        </div>
                    </div>
                       <br>
                       
					   <div class="cart-table table-responsive" style='overflow:auto;'>
                
						<table class="table table-bordered">
							<thead>
								<tr class="cart-product">
									<th class="cart-product-item">Product</th>
									<th class="cart-product-price">Price</th>
									<th class="cart-product-quantity">Quantity</th>
									<th class="cart-product-total">Total</th>
								</tr>
							</thead>
							<tbody>
                                
                              
                                <?php
                                
                                   $food_iterator = 0; $drinks_iterator =0; $max_food = 0; $min_food =0; $overall_price =0; 
                                   
                                   $max_drinks =0 ; $min_drinks =0; $iterator=0; $max=0; $min=0;
                                
                                ?>
                                
                                @if( Session::get('type') != null)
                                
                                  @foreach(Session::get('type') as $key=>$val )
                                     
                                     <?php $iterator++; ?>
                                     
                                    @if($iterator == 1)
                                          <?php $min = $key; ?>
                                    @endif
                                     
                                    @if($val == 'food_type' )
                                        
                                        
                                        
                                        <?php $obj =  $menu_obj->getFoodDetails(Session::get('cart')[$key]); $id=Session::get('cart')[$key]  ?>
                                    @if(isset($obj))
                                       <?php $food_iterator++; ?>
                                
                                    @if($food_iterator == 1)
                                          <?php $min_food = $key; ?>
                                    @endif
                                    <?php
                                
                                        $price_food = $obj->price * Session::get('qty')[$key];
                                
                                    ?>
								        <tr class="cart-product" id='cart{{Session::get("cart")[$key]}}'>
									       <td class="cart-product-item">
                                              <div class='pull-right'>
											    <button type='button' class='text-color-white background-color-red btn margin-top-10px add-btn ' onclick='removeFromCart("food_type",{{$id}})'>Remove Item</button>
										      </div>
										  <div class="cart-product-img">
                                              <img src="food_pic/{{$obj->picture}}" class='' alt="product" width='200' height='200'>
										  </div>
										  <div class="cart-product-name">
                                              <h6>{{$obj->name}}</h6>
										  </div></td>
                                            <td class="cart-product-price" >&#8358;<span>{{number_format($obj->price)}}</span></td>
									       <td class="cart-product-quantity"><div class="product-quantity">
											<a href="javascript:void(0);" id='minus-{{$key}}' onclick='reduce_cart_qty({{$key}})'><i class="fa fa-minus" ></i></a>
											<input type="text" value="{{Session::get('qty')[$key]}}" name='qty_{{$key}}' readonly=''  id='qty-field-{{$key}}'>
											<a href="javascript:void(0);" id='plus-{{$key}}' onclick='add_cart_qty({{$key}})' ><i class="fa fa-plus"></i></a>
										</div></td>
                                            <td class="cart-product-total" >&#8358;<span id='total-{{$key}}'>{{number_format($price_food)}}</span></td>
								        </tr>
                                        <input type='text' class='hide' id='price-{{$key}}' value='{{$obj->price}}' />
                                        <input type='text' class='hide'  name='food_{{$key}}' value="{{Session::get('cart')[$key]}}" />
                                        <input type='text' class='hide'  name='price_{{$key}}' value='{{$obj->price}}' />
                                
                                        <?php $max_food = $key; ?>
                                
                                        <?php $overall_price += $price_food; ?> 
                                      
                                        
                                   @endif
                                    @endif
                                
                                    @if($val == 'drinks' )
                                        
                                        
                                        
                                        <?php $obj =  $menu_obj->getDrinkDetails(Session::get('cart')[$key]); $id=Session::get('cart')[$key]  ?>
                                    @if(isset($obj))
                                       <?php $drinks_iterator++; ?>
                                
                                    @if($drinks_iterator == 1)
                                          <?php $min_drinks = $key; ?>
                                    @endif
                                
                                     <?php
                                
                                        $price_drink = $obj->unit_price * Session::get('qty')[$key];
                                
                                    ?>
								        <tr class="cart-product" id='cart{{Session::get("cart")[$key]}}'>
									       <td class="cart-product-item">
									           <div class="cart-product-img">
                                              <img src="drink_type/{{$obj->picture}}" class='' alt="product" width='200' height='200'>
										  </div>
										    <div class="cart-product-name">
                                              <h6>{{$obj->drink_type}}</h6>
										  </div>
                                              <div class='pull-right'>
											    <button class='text-color-white background-color-red btn margin-top-10px add-btn ' onclick='removeFromCart("drinks",{{$id}})'>Remove Item</button>
										      </div>
										  
										</td>
                                            <td class="cart-product-price" >&#8358;<span>{{number_format($obj->unit_price)}}</span></td>
									       <td class="cart-product-quantity"><div class="product-quantity">
											<a href="javascript:void(0);" id='minus-{{$key}}' onclick='reduce_cart_qty({{$key}})'><i class="fa fa-minus" ></i></a>
											<input type="text" value="{{Session::get('qty')[$key]}}"  name='qty_{{$key}}' readonly=''  id='qty-field-{{$key}}'>
											<a href="javascript:void(0);" id='plus-{{$key}}' onclick='add_cart_qty({{$key}})' ><i class="fa fa-plus"></i></a>
										</div></td>
                                            <td class="cart-product-total" >&#8358;<span id='total-{{$key}}'>{{number_format($price_drink)}}</span></td>
								        </tr>
                                        <input type='text' class='hide' id='price-{{$key}}' value='{{$obj->unit_price}}' />
                                        <input type='text' class='hide'  name='drink_{{$key}}' value="{{Session::get('cart')[$key]}}" />
                                        <input type='text' class='hide'  name='price_{{$key}}' value='{{$obj->unit_price}}' />
                                
                                        <?php $max_drinks = $key; ?>
                                
                                        <?php $overall_price += $price_drink; ?> 
                                      
                                        
                                   @endif
                                    @endif
                                
                                     <?php $max = $key; ?>
                                   
                                 @endforeach
                
                                 @endif
                                
                                   <input type='text' class='hide'  name='max_food' id='max_food' value="{{$max_food}}" />
                                   <input type='text' class='hide'  name='min_food' id='min_food' value='{{$min_food}}' />
                                
                                   <input type='text' class='hide'  name='max' id='max' value="{{$max}}" />
                                   <input type='text' class='hide'  name='min' id='min' value='{{$min}}' />
                                
                                   <input type='text' class='hide'  name='max_drinks' id='max_drinks' value="{{$max_drinks}}" />
                                   <input type='text' class='hide'  name='min_drinks' id='min_drinks' value='{{$min_drinks}}' />
                                
                                   <input type='text' class='hide'  id='real-overall-total' value="{{$overall_price}}" />
                                
                                    <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
								
								
								<tr class="">
									<td colspan="4"><div class="row clearfix">
											<div class="col-sm-4 ">
												<form class="form-inline">
													<select class='form-control' name='mode_of_payment' id='mode_of_payment'>
                                                        <option value=''>Mode of Payment</option>
                                                        <option value='1'>POS</option>
                                                        <option value='2'>CASH</option>
                                                        <option value='3'>TRANSFER</option>
                                                    </select>
												</form>
											</div>
                                            
                                        <div class='col-sm-4' style='padding-left:100px;padding-top:15px;'><b>Overall Total:</b> &nbsp; &#8358;<span id='overall-total'>{{number_format($overall_price)}}</span></div>
											<!-- .col-md-6 end -->
											<div class="col-sm-4 text-right">
												<button type='button'  class='text-color-white background-color-red btn margin-top-10px add-btn ' onclick='checkOut()' style='padding:5px;'>
                                                    Proceed To Checkout &nbsp; 
                                                    <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i>
                                                </button>
											</div>
											<!-- .col-md-6 end -->
										</div></td>
								</tr>
							</tbody>
						</table>
               

					</div>
					</form>
					<!-- .cart-table end -->
				</div>

                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
    
  