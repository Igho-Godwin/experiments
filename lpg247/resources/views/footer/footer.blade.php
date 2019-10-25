    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
        
       @if(Auth::user()->dept != 7)
        $('.ed').addClass('hide');
     @endif
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed by <a href="https://www.joevilleits.com">JOEville ITS</a> 2018</p>
            </div>
        </div>

<style>

.sidebar-right-trigger1 {
    position: absolute;
    z-index: 9;
    top: 6rem;
    right: 100%;
    background-color: #7f63f4;
    color: #fff;
    display: inline-block;
    height: 5rem;
    width: 5rem;
    text-align: center;
    line-height: 4.7rem;
    font-size: 2.1rem;
    border-radius: 50px;
}

</style>
     <!--
      Right sidebar start
        ***********************************-->
        <div class="sidebar-right">
            <a class="sidebar-right-trigger1"  href="ShoppingCartPage" style='font-size:10px;'>
               <span id='item_count' class='text-color-white' style='display: block;margin-top: -10px;height:2px;'>@if(Session::get('item_count') != null){{Session::get('item_count')}} @endif</span>
               <i class="fa fa-shopping-cart" aria-hidden="true" style='color:white;font-size:24px;margin-top: 25px;'></i> 
            </a>
        </div>
        <!--**********************************
            Right sidebar end
        ***********************************-->
 
   <!--
    <link href="time_picker/time_picker/css/jquery.timesetter.css" rel="stylesheet">
    -->
  
       
       <script>//$(".demo").timesetter();</script>
       <script>//$(".demo2").timesetter();</script>



  <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  


  
  

<div id='error_data' style='display:none;'>
    
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

     
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Restaurant</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="">Restaurant</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row" id="dragdrop">
                    <div class="col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-two">
                                    <div class="media">
                                        <div class="media-body">
                                            <h2 class="mt-0 mb-1 text-info">2,02,150</h2><span class="">Total Orders</span>
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
                                            <h2 class="mt-0 mb-1 text-danger">2,02,150</h2><span class="">Total Orders</span>
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
                                            <h2 class="mt-0 mb-1 text-warning">2,02,150</h2><span class="">Total Orders</span>
                                        </div>
                                        <img class="ml-3" src="../../assets/images/icons/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-xxl-7 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title m-t-10">Orders Monthly</h4>
                                <div class="table-action float-right">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group m-b-0">
                                                <select class="selectpicker show-tick" data-width="auto">
                                                    <option selected="selected">Last 30 Days</option>
                                                    <option>Last 1 Month</option>
                                                    <option>Last 6 Month</option>
                                                    <option>Last Year</option>
                                                </select>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="monthly-orders-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-5 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <!-- <div class="card-action"><a href="javascript:void(0)" data-action="collapse"><i class="ti-plus"></i></a> <a href="javascript:void(0)" data-action="expand"><i class="icon-size-fullscreen"></i></a>
                                    <a href="javascript:void(0)" data-action="close"><i class="ti-close"></i> 
                                    </a><a href="javascript:void(0)" data-action="reload"><i class="icon-reload"></i></a>
                                </div> -->
                                <h4 class="card-title">Most Selling Items</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="most-selling-items"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Worldwide Customers</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 col-xl-6">
                                        <div id="world-map-restaurant"></div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="map-coruntry-list">
                                            <h4 class="mb-5">Country List</h4>
                                            <ul>
                                                <li><a href="javascript:void()"><i class="fa fa-circle-o text-success"></i> Canada <span>55%</span></a>
                                                </li>
                                                <li><a href="javascript:void()"><i class="fa fa-circle-o text-warning"></i> Brasil <span>60%</span></a>
                                                </li>
                                                <li><a href="javascript:void()"><i class="fa fa-circle-o text-info"></i> Russia <span>18%</span></a>
                                                </li>
                                                <li><a href="javascript:void()"><i class="fa fa-circle-o text-secondary"></i> Egypt <span>20%</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xl-3">
                                        <div class="restaurant-country-data">
                                            <div id="australia"></div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12 col-sm-4">
                                                    <p>Percentage</p>
                                                    <h3>65%</h3>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-sm-4">
                                                    <p>Customers</p>
                                                    <h3>12,500</h3>
                                                </div>
                                                <div class="col-lg-12 col-sm-4">
                                                    <p>Profit</p>
                                                    <h3>25.20%</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card transparent-card">
                            <div class="card-header pb-0">
                                <h4 class="card-title mt-2"> Recent Orders List</h4>
                                <div class="table-action float-sm-right mt-4 mt-sm-0">
                                    <form action="#">
                                        <div class="form-row">
                                            <div class="form-group mr-3">
                                                <select class="selectpicker show-tick" data-width="auto">
                                                    <option selected="selected">Russia</option>
                                                    <option>USA</option>
                                                    <option>Canada</option>
                                                    <option>Australia</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="selectpicker show-tick" data-width="auto">
                                                    <option selected="selected">Last 30 Days</option>
                                                    <option>Last 1 MOnth</option>
                                                    <option>Last 6 MOnth</option>
                                                    <option>Last Year</option>
                                                </select>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-padded recent-order-list-table table-responsive-fix-big">
                                        <thead>
                                            <tr>
                                                <th>#No</th>
                                                <th>Customer Name</th>
                                                <th>Delivery Date & Time</th>
                                                <th>Location</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-primary rounded-circle text-center text-uppercase d-inline-block">SM</a> <span class="text-pale-sky">Valentino Morose</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Moscow</a></td>
                                                <td><span class="text-pale-sky">$ 25.000</span></td>
                                                <td><span class="label label-xl label-rounded label-warning">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>02</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-lgreen rounded-circle text-center text-uppercase d-inline-block">RM</a> <span class="text-pale-sky">Adib</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Samara</a></td>
                                                <td><span class="text-pale-sky">$ 35.000</span></td>
                                                <td><span class="label label-xl label-rounded label-success">Delivered</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>03</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-dpink rounded-circle text-center text-uppercase d-inline-block">SE</a> <span class="text-pale-sky">Adam Razu</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Suzdal</a></td>
                                                <td><span class="text-pale-sky">$ 29.000</span></td>
                                                <td><span class="label label-xl label-rounded label-danger">Cancel</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>04</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-success rounded-circle text-center text-uppercase d-inline-block">FM</a> <span class="text-pale-sky">David Aziz</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Hrasnoyarsk</a></td>
                                                <td><span class="text-pale-sky">$ 38.000</span></td>
                                                <td><span class="label label-xl label-rounded label-success">Delivered</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>05</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-info rounded-circle text-center text-uppercase d-inline-block">FK</a> <span class="text-pale-sky">David Morose</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Samara</a></td>
                                                <td><span class="text-pale-sky">$ 75.000</span></td>
                                                <td><span class="label label-xl label-rounded label-warning">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>06</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-warning rounded-circle text-center text-uppercase d-inline-block">MS</a> <span class="text-pale-sky">Lionel Morose</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Suzdal</a></td>
                                                <td><span class="text-pale-sky">$ 225.000</span></td>
                                                <td><span class="label label-xl label-rounded label-warning">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>07</td>
                                                <td><a href="javascript:void()" class="mr-2 bg-primary rounded-circle text-center text-uppercase d-inline-block">GM</a> <span class="text-pale-sky">Cristiano Morose</span>
                                                </td>
                                                <td class="text-muted">04 May 2018, 10:30 AM</td>
                                                <td><a href="javascript:void()" class="text-primary">Moscow</a></td>
                                                <td><span class="text-pale-sky">$ 25. 000</span></td>
                                                <td><span class="label label-xl label-rounded label-danger">Cancel</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <nav>
                                    <ul class="pagination pagination-rounded pagination-md justify-content-end">
                                        <li class="page-item"><a class="page-link" href="javascript:void()">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void()">2</a></li>
                                        <li class="page-item active"><a class="page-link" href="javascript:void()">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void()">4</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void()">5</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed by <a href="https://themeforest.net/user/digitalheaps">Digitalheaps</a>, Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        
        <!--**********************************
            Right sidebar start
        ***********************************-->
        <div class="sidebar-right">
            <a class="sidebar-right-trigger" href="javascript:void(0)">
                <span><i class="mdi mdi-tune"></i></span>
            </a>
            <div class="sidebar-right-inner">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#home8"><span><i class="mdi mdi-wrench" aria-hidden="true"></i>
                    </span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile8"><span><i class="mdi mdi-reload" aria-hidden="true"></i>
                    </span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages8"><span><i class="mdi mdi-message-reply-text" aria-hidden="true"></i>
                    </span></a>
                    <!-- </li><li class="nav-item"><a class="nav-link" data-toggle="tab" href="#messages9"><span><i class="fa fa-cog"></i></span></a>
                    </li> -->
                </ul>

                <div class="tab-content tab-content-default tabcontent-border">
                    <div class="tab-pane fade active show" id="home8" role="tabpanel">
                        <div class="admin-settings">
                            <h4>Pick your style</h4>
                            <div>
                                <p>Background</p>
                                <select class="form-control" name="theme_version" id="theme_version">
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <div>
                                <p>Layout</p>
                                <select class="form-control" name="theme_layout" id="theme_layout">
                                    <option value="vertical">Vertical</option>
                                    <option value="horizontal">Horizontal</option>
                                </select>
                            </div>
                            <div>
                                <p>Sidebar</p>
                                <select class="form-control" name="sidebar_style" id="sidebar_style">
                                    <option value="full">Full</option>
                                    <option value="mini">Mini</option>
                                    <option value="compact">Compact</option>
                                    <option value="overlay">Overlay</option>
                                </select>
                            </div>
                            <div>
                                <p>Sidebar position</p>
                                <select class="form-control" name="sidebar_position" id="sidebar_position">
                                    <option value="static">Static</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                            <div>
                                <p>Header position</p>
                                <select class="form-control" name="header_position" id="header_position">
                                    <option value="static">Static</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                            </div>
                            <div>
                                <p>Container</p>
                                <select class="form-control" name="container_layout" id="container_layout">
                                    <option value="wide">Wide</option>
                                    <option value="boxed">Boxed</option>
                                    <option value="wide-boxed">Wide Boxed</option>
                                </select>
                            </div>
                            <div>
                                <p>Direction</p>
                                <select class="form-control" name="theme_direction" id="theme_direction">
                                    <option value="ltr">LTR</option>
                                    <option value="rtl">RTL</option>
                                </select>
                            </div>
                            <div>
                                <p>Navigation Header</p>
                                <div>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_1" class="filled-in chk-col-primary" id="nav_header_bg_1">
                                        <label for="nav_header_bg_1"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_2" class="filled-in chk-col-primary" id="nav_header_bg_2">
                                        <label for="nav_header_bg_2"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_3" class="filled-in chk-col-primary" id="nav_header_bg_3">
                                        <label for="nav_header_bg_3"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_4" class="filled-in chk-col-primary" id="nav_header_bg_4">
                                        <label for="nav_header_bg_4"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_5" class="filled-in chk-col-primary" id="nav_header_bg_5">
                                        <label for="nav_header_bg_5"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_6" class="filled-in chk-col-primary" id="nav_header_bg_6">
                                        <label for="nav_header_bg_6"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_7" class="filled-in chk-col-primary" id="nav_header_bg_7">
                                        <label for="nav_header_bg_7"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_8" class="filled-in chk-col-primary" id="nav_header_bg_8">
                                        <label for="nav_header_bg_8"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_9" class="filled-in chk-col-primary" id="nav_header_bg_9">
                                        <label for="nav_header_bg_9"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="navigation_header" value="color_10" class="filled-in chk-col-primary" id="nav_header_bg_10">
                                        <label for="nav_header_bg_10"></label>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p>Header</p>
                                <div>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_1" class="filled-in chk-col-primary" id="header_bg_1">
                                        <label for="header_bg_1"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_2" class="filled-in chk-col-primary" id="header_bg_2">
                                        <label for="header_bg_2"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_3" class="filled-in chk-col-primary" id="header_bg_3">
                                        <label for="header_bg_3"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_4" class="filled-in chk-col-primary" id="header_bg_4">
                                        <label for="header_bg_4"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_5" class="filled-in chk-col-primary" id="header_bg_5">
                                        <label for="header_bg_5"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_6" class="filled-in chk-col-primary" id="header_bg_6">
                                        <label for="header_bg_6"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_7" class="filled-in chk-col-primary" id="header_bg_7">
                                        <label for="header_bg_7"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_8" class="filled-in chk-col-primary" id="header_bg_8">
                                        <label for="header_bg_8"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_9" class="filled-in chk-col-primary" id="header_bg_9">
                                        <label for="header_bg_9"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="header_bg" value="color_10" class="filled-in chk-col-primary" id="header_bg_10">
                                        <label for="header_bg_10"></label>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p>Sidebar</p>
                                <div>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_1" class="filled-in chk-col-primary" id="sidebar_bg_1">
                                        <label for="sidebar_bg_1"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_2" class="filled-in chk-col-primary" id="sidebar_bg_2">
                                        <label for="sidebar_bg_2"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_3" class="filled-in chk-col-primary" id="sidebar_bg_3">
                                        <label for="sidebar_bg_3"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_4" class="filled-in chk-col-primary" id="sidebar_bg_4">
                                        <label for="sidebar_bg_4"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_5" class="filled-in chk-col-primary" id="sidebar_bg_5">
                                        <label for="sidebar_bg_5"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_6" class="filled-in chk-col-primary" id="sidebar_bg_6">
                                        <label for="sidebar_bg_6"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_7" class="filled-in chk-col-primary" id="sidebar_bg_7">
                                        <label for="sidebar_bg_7"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_8" class="filled-in chk-col-primary" id="sidebar_bg_8">
                                        <label for="sidebar_bg_8"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_9" class="filled-in chk-col-primary" id="sidebar_bg_9">
                                        <label for="sidebar_bg_9"></label>
                                    </span>
                                    <span>
                                        <input type="radio" name="sidebar_bg" value="color_10" class="filled-in chk-col-primary" id="sidebar_bg_10">
                                        <label for="sidebar_bg_10"></label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile8" role="tabpanel">
                        <div class="sidebar-recent-activity ">
                            <h4 class="card-title">Recent Activity</h4>
                            <div class="timeline_content">
                                <ul class="timeline timeline-workplan">
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>After 3 hours</p>
                                                    <h6 class="mt-0 mb-0"><a href="javascript:void()" class="text-primary">Space X</a> is going to launch a Rocket</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>5 minites ago</p>
                                                    <h6 class="mt-0 mb-0"><a href="javascript:void()" class="text-primary">Niloy</a> commented on your photo</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>1 hour ago</p>
                                                    <h6 class="mt-0 mb-0"><a href="javascript:void()" class="text-primary">Bill Gates</a> likes your photo</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>2 hours ago</p>
                                                    <h6 class="mt-0 mb-0"><a href="javascript:void()" class="text-primary">You</a> reacted on <a href="javascript:void()" class="text-primary">Shelly</a>'s photo</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>2 days ago</p>
                                                    <h6 class="mt-0 mb-0"><a href="" class="text-primary">Elon Mask</a> invited you on an <a href="javascript:void()" class="text-primary">Event</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-inverted">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-panel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <p>3 days ago</p>
                                                    <h6 class="mt-0 mb-0"><a href="" class="text-primary">Mark Jukarbarg</a> invited you on <a href="javascript:void()" class="text-primary">Facebook</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-work-progress">
                            <h4 class="card-title mb-5">Daily prograss</h4>
                            <div class="progress-wrapper">
                                <h6 class="mb-3">Light Weight Lifting</h6>
                                <div class="progress mb-5">
                                    <div class="progress-bar bg-warning" style="width: 80%; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper">
                                <h6 class="mb-3">Push Ups</h6>
                                <div class="progress mb-5">
                                    <div class="progress-bar bg-danger" style="width: 60%; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-wrapper">
                                <h6 class="mb-3">Step Aerobics</h6>
                                <div class="progress mb-5">
                                    <div class="progress-bar bg-dpink" style="width: 70%; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>  
                            <div class="progress-wrapper">
                                <h6 class="mb-3">Down Aerobics</h6>
                                <div class="progress mb-5">
                                    <div class="progress-bar bg-lgreen" style="width: 90%; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="messages8" role="tabpanel">
                        <div class="user-chat">
                            <ul class="list-group all-chats">
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/1.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity inactive"></span>
                                            <img src="../../assets/images/user/2.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>22 minites ago</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/3.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/4.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity inactive"></span>
                                            <img src="../../assets/images/user/4.jpg" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>26 minites ago</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/6.jpg" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/7.jpg" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/8.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/1.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/4.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity inactive"></span>
                                            <img src="../../assets/images/user/2.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>52 minites ago</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity inactive"></span>
                                            <img src="../../assets/images/user/2.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>22 Hours ago</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/6.jpg" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity active"></span>
                                            <img src="../../assets/images/user/3.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>Online</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                                <li class="list-group-item single-chat border-0">
                                    <div class="media align-items-center">
                                        <div class="user-img mr-3">
                                            <span class="activity inactive"></span>
                                            <img src="../../assets/images/user/8.png" height="40" width="40" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h6 class="mb-0">Lurch Schpel</h6>
                                            <small>6 Hours ago</small>
                                        </div>
                                        <a href="javascript:void()" class="chat-open d-inline-block px-2 py-1">
                                            <i class="fa fa-comment-o"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Right sidebar end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->




</div>



 
    
      
    
        <!--**********************************
            Footer end
        ***********************************-->
      <script src="bootstrap-tagsinput-master/dist/bootstrap-tagsinput.min.js"></script>   







    <script src="assets/plugins/common/common.min.js"></script>
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

      <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="js/plugins-init/bs-daterange-picker-init.js"></script>
   
   <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
    

    <script src="js/dashboard/dashboard-1.js"></script>

  
    <script src="js/dashboard/dashboard-1.js"></script>

 

   
    <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

     <style>
         
            .btn-default:not([disabled]):not(.disabled).active, .btn-default:not([disabled]):not(.disabled):active, .show>.btn-default.dropdown-toggle {
    -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
    box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
    background-color: transparent!important;
}
         
            .btn-light.dropdown-toggle {
                background-color: transparent!important;
            }
        
            .btn-light:not([disabled]):not(.disabled).active, .btn-light:not([disabled]):not(.disabled):active, .show>.btn-light.dropdown-toggle {
                 -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
                    /* box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15); */
                background-color: transparent!important;
                color: black;
                }
        
        .bootstrap-select>.dropdown-toggle.bs-placeholder, .bootstrap-select>.dropdown-toggle.bs-placeholder:active, .bootstrap-select>.dropdown-toggle.bs-placeholder:focus, .bootstrap-select>.dropdown-toggle.bs-placeholder:hover {
    color: black;
}
         
         
    
    </style>

   <style>
       
       .btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 150%;
    height: 100%;
    z-index: -1;
    background-color: transparent;
    -webkit-transform: rotate3d(0, 0, 1, -45deg) translate3d(0, -3em, 0);
    transform: rotate3d(0, 0, 1, -45deg) translate3d(0, -3em, 0);
    -webkit-transform-origin: 0% 100%;
    transform-origin: 0% 100%;
    -webkit-transition: -webkit-transform 0.4s, opacity 0.4s, background-color 0.4s;
    transition: transform 0.4s, opacity 0.4s, background-color 0.4s;
}
        
        .add-btn:hover{
            color:white!important;
            background-color:#337ab7!important;
        }
    
    </style>
    
         <script src="js/main.js"></script>
         
       <script src="js/edit_subAccount.js"></script> 
       
       <script src="js/createMajorMarketer.js"></script>

          
<script src="js/main2.js"></script>

<script src="js/remission.js"></script>

      <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="js/plugins-init/bs-daterange-picker-init.js"></script>
   
   <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
    

   <script src="cropper/cropper-master/dist/cropper.js"></script> 
   
 
  
     <script src="js/simple.money.format.js"></script>
  
   
   <script>
     
      jQuery(function ($) {
     
        $('.money').simpleMoneyFormat();
     
        $('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
     
      });

    </script> 

      <script>
      
   $(function () {
       
      // Import image
  var $inputImage = $('#image-logo');

  
  
    $inputImage.change(function () {
      var files = this.files;
      var file;
        
     
        
        var options = {
      aspectRatio: 1 / 1,
      minCropBoxWidth: 200,
      minCropBoxHeight: 200,
      dragCrop: false,
      mouseWheelZoom: false,
      resizable: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
        $('#image').cropper('setCropBoxData',{
            width: 200,
            height: 200
        });
    }
  };

    

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1 / 1,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
          
     
    }
  });

            
   
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });

// Import image
  var $inputImage = $('#image1');

  //alert('hi');



  
    $inputImage.change(function () {
      var files = this.files;
      var file;
        
     
        
        var options = {
      aspectRatio: 1 / 1,
      minCropBoxWidth: 200,
      minCropBoxHeight: 200,
      dragCrop: false,
      mouseWheelZoom: false,
      resizable: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
        $('#image').cropper('setCropBoxData',{
            width: 50,
            height: 50
        });
    }
  };

    

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1 / 1,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
          
     
    }
  });

            
   
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });

// Import image



      var $inputImage = $('#image-room');

  //alert('hi');

    $inputImage.change(function () {
      var files = this.files;
      var file;
        
     
        
        var options = {
      aspectRatio: 1.7 / 1,
    
      dragCrop: false,
      mouseWheelZoom: false,
      resizable: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
        $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 884
        });
         
        
    }
  };

    

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1.7 / 1,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
         
         $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 884
        });
     
    }
  });

            
   
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });


var $inputImage = $('#image-food');

  

    $inputImage.change(function () {
      var files = this.files;
      var file;
      
      
        
     
        
        var options = {
      aspectRatio: 1.37 / 1,
    
      dragCrop: false,
      mouseWheelZoom: false,
      resizable: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
        $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 514
        });
         
      //  $image.cropper("setCropBoxData", { height: 514 });
    }
  };

    

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1.37 / 1,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
          $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 514
        });
     
    }
  });

            
   
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });

var $inputImage = $('#image-drink');

  //alert('hi');

    $inputImage.change(function () {
      var files = this.files;
      var file;
        
     
        
        var options = {
      aspectRatio: 1 / 1.21,
    
      dragCrop: false,
      mouseWheelZoom: false,
      resizable: false,
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
        $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 326
        });
         
        //image.cropper("setCropBoxData", { height: 514 });
    }
  };

    

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          uploadedImageName = file.name;
          uploadedImageType = file.type;

         

          uploadedImageURL = URL.createObjectURL(file);
          $('#image').cropper('destroy').attr('src', uploadedImageURL);
          
          var $image = $('#image');

$image.cropper({
      aspectRatio: 1 / 1.21,
     
      crop: function(event) {
        console.log(event.detail.x);
        console.log(event.detail.y);
        console.log(event.detail.width);
        console.log(event.detail.height);
        console.log(event.detail.rotate);
        console.log(event.detail.scaleX);
        console.log(event.detail.scaleY);
     },
     built: function(){
          $('#image').cropper('setCropBoxData',{
           // width: 50,
            height: 326
        });
     
    }
  });

            
   
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
    
  });
  
  /*
  
  $('.datepicker').datepicker({
    dateFormat: 'dd-mm-yy'
});
*/
  </script>

<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
  
<!-- Latest compiled and minified JavaScript -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>







</body>

</html>