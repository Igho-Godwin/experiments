<!DOCTYPE html>
<html lang="en" class="h-100" id="login-page1">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gleek - Bootstrap Admin Dashboard HTML Template</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    
</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div class="login-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content login-form">
                        <div class="card">
                            <div class="card-body">
                                <div class="logo text-center">
                                    <a href="index.html">
                                        <img src="../../assets/images/f-logo.png" alt="">
                                    </a>
                                </div>
                                <h4 class="text-center mt-4">Change Password</h4>
                                <form class="mt-5 mb-5" id='change-pass-Form'>
                                    <br>
                                    <div id='error' style='color:red;'></div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name='password' id='password' class="form-control" placeholder="Password" required=''>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name='password_confirmation' id='password_confirmation' class="form-control" placeholder="Confirm Password" required=''>
                                    </div>
                                    <input type='text' style='display:none;' name='ad' value='<?php echo Hash::make("admin@admin.de"); ?>' />
                                    <div class="text-center mb-4 mt-4">
                                        <button id='change-pass' type="button" class="btn btn-primary">Submit &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i></button>
                                    </div>
                                </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    <!-- Common JS -->
   <script src="assets/plugins/common/common.min.js"></script>
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/main.js"></script>
    <script src="js/main2.js"></script>
    <!-- Custom script -->
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
</body>

</html>