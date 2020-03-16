<!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    
                @if(Auth::user()->dept == '7')
                    
                    <li class="nav-label">Dashboard</li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="Dashboard" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <div class='t1'>
                    <li class="nav-label " onclick='colapse($(".d12"))' style='cursor:pointer;'>Users</li>
                    <div class='d12 t2' style='display:none;' >
                         <li class="mega-menu mega-menu-lg">
                                <a class="" href="createUserPage" aria-expanded="false">
                                     <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Create Users</span>
                                </a>
                         </li>
                         <li class="mega-menu mega-menu-lg">
                            <a class="" href="allUsers" aria-expanded="false">
                                 <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Users</span>
                            </a>
                        </li>
                    </div>
                    </div>
                    
                @endif
                 
                @if(Auth::user()->dept == '3' or Auth::user()->dept == '7' )
                
                    <div class='t1'>
                        <li class="nav-label " onclick='colapse($(".d13"))' style='cursor:pointer;'>Restuarant</li>
                        <div class='d13 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addFoodType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Add Food type</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allFoodType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Food type</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="makeSalesRestaurant" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Sell Food</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allSalesRestuarant" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Sold Food</span>
                        </a>
                    </li>
                    </div>
                    </div>
                    
                @endif
                    
                @if(Auth::user()->dept == '1' or Auth::user()->dept == '7' )
                    <div class='t1'>
                    <li class="nav-label" onclick='colapse($(".d14"))' style='cursor:pointer;' >Store</li>
                    <div class='d14 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addToStore" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Add To Store</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allStock" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Stock</span>
                        </a>
                    </li>
                    </div>
                    </div>
                    
                @endif
                    
                @if(Auth::user()->dept == '4' or Auth::user()->dept == '7' )
                    <div class='t1'>
                    <li class="nav-label" onclick='colapse($(".d15"))' style='cursor:pointer;'>Bar</li>
                    <div class='d15 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addDrinkType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Add Drink Type</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allDrinkTypes" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Drink Types</span>
                        </a>
                    </li>
                    
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="makeSalesDrink" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Sell Drinks</span>
                        </a>
                    </li>
                    
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allSalesDrink" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Sold Drinks</span>
                        </a>
                    </li>
                    </div>
                    </div>
                    
                @endif
                   
                @if(Auth::user()->dept == '5' or Auth::user()->dept == '7')
                    <div class='t1'>
                    <li class="nav-label " onclick='colapse($(".d16"))' style='cursor:pointer;' >Pool</li>
                    <div class='d16 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addPoolSales" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Add Pool Sales</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allPoolSales" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Pool Sales</span>
                        </a>
                    </li>
                    </div>
                    </div>
                @endif
                    
                @if(Auth::user()->dept == '2' or Auth::user()->dept == '7')
                    
                    <div class='t1'>
                    <li class="nav-label " onclick='colapse($(".d17"))' style='cursor:pointer;'>Hotel Room</li>
                    <div class='d17 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addRoomType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Add Room Type</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allRoomType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Room Types</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="SellRooms" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Book a Room</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allSoldRooms" aria-expanded="false">
                             <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Booked Rooms</span>
                        </a>
                    </li>
                    </div>
                    </div>
                    
                     <div class='t1'>
                    <li class="nav-label " onclick='colapse($(".d18"))' style='cursor:pointer;'>Customer</li>
                    <div class='d18 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="addRoomType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Customers</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allRoomType" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Room Types</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="SellRooms" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Book a Room</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="allSoldRooms" aria-expanded="false">
                             <i class="mdi mdi-view-dashboard"></i><span class="nav-text">All Booked Rooms</span>
                        </a>
                    </li>
                    </div>
                    </div>
                
                @endif
                    
                 @if(Auth::user()->dept == '7')
                     <div class='t1'>
                    <li class="nav-label " onclick='colapse($(".d18"))' style='cursor:pointer;' >Profit Table</li>
                    <div class='d18 t2' style='display:none;'  >
                    <li class="mega-menu mega-menu-lg">
                        <a class="" href="profit_view" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">View Profit</span>
                        </a>
                    </li>
                    </div>
                    </div>
                 @endif
                    
                 <li class="mega-menu mega-menu-lg">
                        <a class="" href="logout" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Log Out</span>
                        </a>
                 </li>
                </ul>
            </div>
        </div>
          <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script>
            
            function colapse(id)
            {
               
                
                //$(this).click();
            }
            
               $( ".t1" ).click(function() {
                   
                    $('.t2').hide();
                    $(this).find( '.t2' ).toggle();
                
                
                
            });
            
            
        </script>
        
        <!--**********************************
            Sidebar end
        ***********************************-->