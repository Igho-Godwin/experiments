

@include('header.header')

<link href='css/style-make-sales-drink.css' rel='stylesheet' />

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
                <div class='row background-color-white padding-30px padding-left-30percent' style='width:100%;'>
                 
                          <h1>
                             Make Sales Drinks
                          </h1>
                    </div>
               <div class="row">
				<!-- Product #1 -->
                   @foreach($all_items as $obj)
				     <div class="col-xs-12 col-sm-6 col-md-3 product">
					<div class="product-img" onclick="">
						<img  src="drink_type/{{$obj->picture}}" alt="Product"/>
						<div class="product-hover">
							<div class="text-center" style='padding-top:80%;'>
								<button class='text-color-white background-color-red btn margin-top-10px add-btn ' id='cart{{$obj->id}}' onclick='add_to_cart("drinks",{{$obj->id}})'>
                                          @if($menu_obj->checkCart('food_type',$obj->id) == 0)
                                                Add To Cart
                                          @elseif($menu_obj->checkCart('food_type',$obj->id) == 1)
                                                Remove item From Cart
                                          @endif
                                </button>
							</div>
						</div>
						<!-- .product-overlay end -->
					</div>
					<!-- .product-img end -->
					<div class="product-bio">
					
						<!-- .product-cat end -->
						<div class="prodcut-title">
							<h3 align='center'>
								<a href="#">{{$obj->drink_type}}</a>
							</h3>
						</div>
						<!-- .product-title end -->
						<div class="product-price">
							<span class="symbole">&#8358;</span><span>{{number_format($obj->unit_price)}}</span>
						</div>
						<!-- .product-price end -->
						
					</div>
					<!-- .product-bio end -->
				</div>
                   @endforeach
				<!-- .product end -->
				      <input type='text' id='access_token' value='{{Session::get("token")}}' class='hide' />
			
				<!-- .product end -->
			</div>
			<!-- .row end -->
                    
                    
                </div>
            </div>
        </div>
        
        <?php Session::put('url','makeSalesDrink'); ?>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')
