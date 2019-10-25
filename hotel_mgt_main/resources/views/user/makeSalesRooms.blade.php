

@include('header.header')

<link rel='stylesheet' href='css/pearl-hotel.css' />

<link rel='stylesheet' href='css/form-dropdown.css' />

<link rel='stylesheet' href='css/default-color.css' />



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
                             Make Sales Rooms
                          </h1>
                    </div>
               <div class="content">
		
		<div class="row">
                	
					<div class="serv-main-sec">
                        
                        @foreach($room_type as $val)
					
				          <div class="col-md-4">
							<div class="service-sec">
								<img src="room_type_pic/{{$val->picture}}" alt="">
								
								<div class="detail text-center">
								<h3>{{$val->name}}</h3>
								
								<a href="room-detail?id={{$val->id}}&a=edit">view detail</a>
								</div>
								
							</div>
						  </div>
						
                        @endforeach
					
					</div>
					
					
				</div>	
                         
        <div class='pull-right text-center'>
             @if($room_type !=null && count($room_type) > 0)
                    {{$room_type->links()}}
             @endif
        </div>
		
	</div>	
			<!-- .row end -->
                    
                    
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
    

     
    </div>
    
    @include('footer.footer')

    <!-- Form Drop Down -->
<script type="text/javascript" src="js/form-dropdown.js"></script>
