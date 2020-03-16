
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Lpg 247</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box" style='max-width:50%;'>
                <div>
                    <div class="logo">
                        <span class="db"><img src="assets/images/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign Up </h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div id='error' class='error-color'>
                                
                            </div>
                            <form id='salesRepForm' class="form-horizontal m-t-20" action="index.html">
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 ">
                                        <input type='text' class="form-control form-control-lg" name='fullName' placeholder='Full Name' title='Full Name' id='fullName' />
                                    </div>
                                    <div class="col-sm-6 ">
                                       <input type='text' class="form-control form-control-lg" name='phoneNumber' placeholder="Phone Number" id='phoneNumber' title='Phone Number' />
                                    </div>
                                </div>
                                
                                <div class="form-group row ">
                                    <div class="col-sm-6 ">
                                        <input name='email' id='emailAddress' title='Email Address' class="form-control form-control-lg" type="text"  required=" " placeholder="Email Address">
                                    </div>
                                    <div class="col-sm-6 ">
                                       <select name='company_name' class="form-control form-control-lg">
                                                <option value=''>Select A Marketer you attached to</option>
                                           @foreach($major_marketers as $val)
                                                <option value='{{$val->id}}'>{{$val->marketer_name}}</option>
                                           @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 ">
                                        <input name='locationOfDepot' id='autocomplete' title='location Of Depot' class="form-control form-control-lg" type="text"  required=" " placeholder="location Of Depot">
                                    </div>
                                    <div class="col-sm-6 ">
                                        <select class="form-control form-control-lg" name='product_to_sell' title='Select product For Sale'>
                                            <option value=''>Select Product For Sale</option>
                                            <option value='1'>AGO</option>
                                            <option value='2'>LPG</option>
                                            <option value='3'>BITUMEN</option>
                                            <option value='4'>PMS</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 ">
                                        <button type='button' class="btn btn-block btn-lg btn-info signup-sales-rep-btn" type="submit ">SIGN UP&nbsp;<i class='fa fa-spinner fa-spin hide'></i></button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Already have an account? <a href="login" class="text-info m-l-5 "><b>Sign In</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    
    <script>
    
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {types: ['geocode']});
        }
    
    </script>
     
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPJNYpRGMzD_dQp4jOHU_OwMoZ09vXzcU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script src="assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="js/user.js "></script>
    <script src='js/signup_sales_rep.js'></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
    </script>
</body>

</html>