<!doctype html>
<html lang="en">

<head>

    <!-- Basic Page Needs
================================================== -->
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="<?= get_g_setting_val('favicon'); ?>" type="image/gif" sizes="64x64">

    <!-- CSS================================================== -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/all.min.css">
    <link href="<?= base_url(); ?>/public/users/css/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/bootstrap.min.css">
    <link href="<?= base_url(); ?>/public/users/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/public/users/css/owl.carousel.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/color-1.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/css/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/users/toastr/toastr.min.css">
</head>

<body>

    <!-- Header 01
================================================== -->
    <header class="header_01">
        <div class="header_main">
            <div class="header_menu fixed-top">
                <div class="container">
                    <div class="header_top">
                        <div class="logo">
                            <a href="<?= base_url('home') ?>">
                                <img alt="JoDice" class="img-fluid" src="<?= base_url(); ?>/public/users/images/dice-logo.png">
                            </a>
                        </div>
                        <div class="navigation">
                            <nav>
                                <div class="hamburger hamburger--spring js-hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                <ul>
                                    <?php if (!session('employer_logged_in')) : ?>
                                    <li class="current_page"><a href="<?= base_url('employer') ?>"> Home </a></li>
                                    <li><a href="<?= base_url('employer/post') ?>"> Post A Job </a></li>
                                    <?php endif; ?>
                                    <?php if (session('employer_logged_in')) : ?>
                                    <li><a href="<?= base_url('employer/dashboard') ?>"> Dashboard </a></li>
                                    <li><a href="<?= base_url('employer/list_jobs') ?>"> Manage Jobs</a></li>
                                    <li><a href="<?= base_url('employer/search') ?>"> Find Candidate</a></li>
                                    <li class="has-sub-menu">
                                        <a href="#"><?= session('employer_username'); ?></a>
                                        <ul class="sub-menu">
                                            <li><a href="<?= base_url('employer/profile'); ?>">My Profile</a></li>
                                            <li><a href="<?= base_url('employer/logout') ?>">Logout</a></li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                            <div class="ac_nav">
                                <!--Not logedin-->
                                <?php if (session('user_logged_in')) : ?>
                                    <div class="">
                                        <a class="btn btn-primary" href="<?= base_url('employer/login'); ?>">Employer Login</a>
                                    </div>
                                <?php elseif (session('employer_logged_in')) : ?>
                                    <div class="">
                                        <a class="btn btn-primary" href="<?= base_url('employer/login'); ?>">Job Seeker Login</a>
                                    </div>
                                <?php else : ?>
                                    <div class="dropdown login_pop">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="<?= base_url('login'); ?>">Job Seeker Login</a>
                                            <a class="dropdown-item" href="<?= base_url('employer/login'); ?>">Employer Login</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!--end logedin-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header 02
================================================== -->