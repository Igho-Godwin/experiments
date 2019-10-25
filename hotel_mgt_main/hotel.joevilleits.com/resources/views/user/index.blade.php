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
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Dashboard</h4>
                    </div>
                    
                </div>
                <div class="row" id="dragdrop">
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-info">&#8358;{{number_format($income)}}</h2><span class="">Total Income</span>
                                        </div>
                                        <img class="ml-3" src="../../assets/images/icons/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-danger">&#8358;{{number_format($Profit)}}</h2><span class="">Total Profit</span>
                                        </div>
                                        <img class="ml-3" src="../../assets/images/icons/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-warning">{{$orders}}</h2><span class="">Total Orders</span>
                                        </div>
                                        <img class="ml-3" src="../../assets/images/icons/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <script type="text/javascript" src="//www.gstatic.com/charts/loader.js"></script>
                        <script>
                             google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                            var data = google.visualization.arrayToDataTable(
                                [
                                        ['Element', 'Income'],
                                        ['Jan', {{$obj->getIncome(1)}}],            // RGB value
                                        ['Feb', {{$obj->getIncome(2)}}],            // English color name
                                        ['Mar', {{$obj->getIncome(3)}}],
                                        ['Apr', {{$obj->getIncome(4)}}],
                                        ['May', {{$obj->getIncome(5)}}],
                                        ['June', {{$obj->getIncome(6)}}],
                                        ['July', {{$obj->getIncome(7)}}],
                                        ['August', {{$obj->getIncome(8)}}],
                                        ['Sept', {{$obj->getIncome(9)}}],
                                        ['Oct', {{$obj->getIncome(10)}}],
                                        ['Nov', {{$obj->getIncome(11)}}],
                                        ['Dec', {{$obj->getIncome(12)}}]
                                   
                                     ]
                            );
                                
                            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                           chart.draw(data, options);
                            }
                            
                            var options = {
                                   title: "Income Distribution For this Year",
                                 //  width: 600,
                                   height: 400,
                                  // bar: {groupWidth: "95%"},
                                  // legend: { position: "none" },
                            };
                        
                           
                       </script>
                         <div id="chart_div" style='width:100%;'></div>
                    </div>
                   
                </div>
             
                <div class="row justify-content-between">
                    <!-- <div class="col-lg-12 d-flex"> -->
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-sm-3 mb-sm-0">
                                            <div class="stat-widget-three py-2">
                                                <div class="media">
                                                    <img class="mr-4 mt-3" src="../../assets/images/icons/4.png" alt="">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 mb-1 text-info">62,150</h2>
                                                        <span class="text-pale-sky ">Total Orders</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 mb-sm-0">
                                            <div class="stat-widget-three py-2">
                                                <div class="media">
                                                    <img class="mr-4 mt-3" src="../../assets/images/icons/5.png" alt="">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 mb-1 text-success">9,750</h2>
                                                        <span class="text-pale-sky ">Total Delivery</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="stat-widget-three py-2">
                                                <div class="media">
                                                    <img class="mr-4 mt-3" src="../../assets/images/icons/6.png" alt="">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 mb-1 text-danger">4,250</h2>
                                                        <span class="text-pale-sky ">Pending Orders</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="stat-widget-three py-2">
                                                <div class="media">
                                                    <img class="mr-4 mt-3" src="../../assets/images/icons/7.png" alt="">
                                                    <div class="media-body">
                                                        <h2 class="mt-0 mb-1 text-warning">4,250</h2>
                                                        <span class="text-pale-sky ">Orders Hold</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="stat-widget-three py-2">
                                        <div class="media">
                                            <img class="mr-4" src="../../assets/images/icons/8.png" alt="">
                                            <div class="media-body">
                                                <div class="rating d-flex align-items-center">
                                                    <span class="m-0">
                                                        <span class="text-warning"><i class="fa fa-star"></i></span>
                                                        <span class="text-warning"><i class="fa fa-star"></i></span>
                                                        <span class="text-warning"><i class="fa fa-star"></i></span>
                                                        <span class="text-warning"><i class="fa fa-star"></i></span>
                                                        <span class=""><i class="fa fa-star"></i></span>
                                                    </span>
                                                    <h2 class="mt-0 mb-0 ml-3 text-warning">4.0</h2>
                                                </div>
                                                <span class="text-pale-sky ">Customer Satisfaction</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                
            </div>
        </div>
    
     
    
    @include('footer.footer')
