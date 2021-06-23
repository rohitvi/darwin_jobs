<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Elisyam - Forgot Password</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/public/employer/assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/public/employer/assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/public/employer/assets/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="<?= base_url(); ?>/public/employer/assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/public/employer/assets/vendors/css/base/elisyam-1.5.min.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="bg-fixed-02">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="<?= base_url(); ?>/public/employer/assets/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 overflow-y">
            <div class="row flex-row h-100">
                <div class="col-12 my-auto">
                    <div class="password-form mx-auto">
                        <div class="logo-centered">
                            <a href="<?= base_url('employer'); ?>">
                                <img src="<?= base_url(); ?>/public/employer/assets/img/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Reset Password</h3>
                        <form id="reset" action="" method="post">
                            <div class="group material-input">
                                <input type="password" name="password" required>
                                <input type="hidden" name="id" value="<?= $data[0]['id'] ?>">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Password</label>
                            </div>
                            <div class="group material-input">
                                <input type="password" name="cpassword" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Confirm Password</label>
                            </div>
                        </form>
                        <div class="button text-center">
                            <a href="" type="submit" class="btn btn-lg btn-gradient-01 reset-pass">
                                Update Password
                            </a>
                        </div>
                        <div class="back">
                            <a href="<?= base_url('employer/login'); ?>">Sign In</a>
                        </div>
                    </div>        
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>  
        <!-- End Container --> 
        <!-- Begin Vendor Js -->
        <script src="<?= base_url(); ?>/public/employer/assets/vendors/js/base/jquery.min.js"></script>
        <script src="<?= base_url(); ?>/public/employer/assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="<?= base_url(); ?>/public/employer/assets/vendors/js/app/app.min.js"></script>
        <!-- End Page Vendor Js -->
        <!-- Noty Js -->
        <script src="<?= base_url('public/employer/assets/vendors/js/noty/noty.min.js')?>"></script>
        <script>
            $('.reset-pass').click(function(e){
                event.preventDefault();
                var _form = $("#reset").serialize();
                $.ajax({
                    data: _form,
                    type: 'POST',
                    url: '<?= base_url("employer/update_reset_password"); ?>',
                    success: function(response){
                        $("#reset").trigger('reset');
                        var response = response.split('~');
                        if ($.trim(response[0]) == 0) {
                            new Noty({
                                type: "error",
                                layout: "topRight",
                                text: response[1],
                                progressBar: true,
                                timeout: 2000,
                                animation: {
                                    open: "animated bounceInRight",
                                    close: "animated bounceOutRight"
                                }
                            }).show();
                        }else if ($.trim(response[0]) == 1) {
                            new Noty({
                                type: "success",
                                layout: "topRight",
                                text: response[1],
                                progressBar: true,
                                timeout: 2000,
                                animation: {
                                    open: "animated bounceInRight",
                                    close: "animated bounceOutRight"
                                }
                            }).show();
                        }
                    }
                });
            });
        </script>
    </body>
</html>