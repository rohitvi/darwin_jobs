<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= get_g_setting_val('application_name') ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/flaticon.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/price_rangs.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/slicknav.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/slick.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/noty/noty.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="<?= base_url(); ?>/public/user/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.html"><img src="<?= base_url(); ?>/public/user/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.html">Home</a></li>
                                            <li><a href="job_listing.html">Find a Jobs </a></li>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="#">Page</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                    <li><a href="elements.html">Elements</a></li>
                                                    <li><a href="job_details.html">job Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    <?php if (session('user_logged_in')) : ?>
                                        <a href="<?= base_url('home/logout') ?>" class="btn head-btn1">Logout</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('home/login') ?>" class="btn head-btn1">Login / Registration</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>