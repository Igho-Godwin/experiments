
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
            <div class="auth-box">
                <div>
                    <div class="logo">
                        <span class="db"><img src="assets/images/logo-icon.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign Up </h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <div id='error' class='error-color'>
                                
                            </div>
                            <form id='createUserForm' class="form-horizontal m-t-20" action="index.html">
                                
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <select id='user_category' name='user_category' class="form-control form-control-lg" title='Select Account Type' >
                                            <option value=''>Select Account Type</option>
                                            <option value='0' >Consumer</option>
                                            <option value='1'>Marketer</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row ">
                                    <div class="col-12 ">
                                        <input name='fullName' id='fullName' title='Full Name' class="form-control form-control-lg" type="text"  required=" " placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input title='email' name='email' class="form-control form-control-lg" type="text" required=" " placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input title='phone number' name='phoneNumber'  class="form-control form-control-lg" type="text" required=" " placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                
                                
                                <div class='hide' id='documents'>
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                           <input title='cac number' name='cacNumber'  class="form-control form-control-lg" type="text" required=" " placeholder="Enter Cac Number">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                            <textarea cols='45' name='about_company' class="form-control form-control-lg" rows='5' placeholder='About Company'></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                            
                                            <input title='Dpr license Number' name='dprLicenseNumber'  class="form-control form-control-lg" type="text" required=" " placeholder="Enter Dpr License Number">
                                    
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-12 ">
                                           <select id='marketer_type' name='marketer_type' class="form-control form-control-lg" title='Marketer Type' onChange='chooseMajorMarketers()' >
                                            <option value=''>Select Marketer Type</option>
                                            <option value='0' >Retail</option>
                                            <option value='1'>Whole Sale</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                <div class="form-group row hide " id='major_marketers'>
                                        <div class="col-12 ">
                                           <select name='major_marketer[]' class="form-control form-control-lg " title='Marketer Type' onChange='chooseMajorMarketers()' multiple>
                                            <option value=''>Select Major Marketer</option>
                                            <?php $__currentLoopData = $MajorMarketers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major_maketer_values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value='<?php echo e($major_maketer_values->id); ?>' ><?php echo e($major_maketer_values->marketer_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input title='address' name='address' class="form-control form-control-lg"  required=" " id='autocomplete'  placeholder="Enter Address" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input title='password' name='password' class="form-control form-control-lg" type="password" required=" " placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg" name='password_confirmation' type="password" title='password' required=" " placeholder="Confirm Password">
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group row">
                                    <div class="col-md-12 ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name='terms' id="customCheck1" value='1' required=' '>
                                            <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 ">
                                        <button type='button' class="btn btn-block btn-lg btn-info add-user" type="submit ">SIGN UP&nbsp;<i class='fa fa-spinner fa-spin hide'></i></button>
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
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
    </script>
</body>

</html><?php /**PATH /home/lpg247/public_html/resources/views/user/register_user.blade.php ENDPATH**/ ?>