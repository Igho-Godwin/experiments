<!DOCTYPE html>
<html lang="en" class="h-100" id="login-page1">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>JOEville ITS Hotel Management System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/f-logo.png">
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
                                <h4 class="text-center mt-4">Log into Your Account</h4>
                                <form class="mt-5 mb-5" id='login-Form'>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name='email' id='email' class="form-control" placeholder="Email" required=''>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name='password' id='password' class="form-control" placeholder="Password" required=''>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12 text-right"><a href="forgot_password">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <input type='text' style='display:none;' name='ad' value='<?php echo Hash::make("admin@admin.de"); ?>' />
                                    <div class="text-center mb-4 mt-4">
                                        <button id='login-user' type="button" class="btn btn-primary">Sign in &nbsp; <i class="fa fa-spinner fa-spin hide " aria-hidden="true"></i></button>
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
    <script src="js/main.js"></script>
    <!-- Custom script -->
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
</body>

</html>