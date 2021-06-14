<?php $ap = basename($_SERVER['PHP_SELF'], ".php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/ionicons.min.css'); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/summernote/summernote-bs4.min.css')?>">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?= base_url('public/admin/custom/style.css')?>">
  <!-- sweet alert -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/sweetalert2/sweetalert2.min.css')?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

  <!-- Jquery -->
  <script src="<?= base_url('./public/admin/plugins/jquery/jquery.min.js')?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('./public/admin/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a href="<?= base_url('admin/logout'); ?>"><i class="fas fa-sign-out-alt fa-lg"></i></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('public/admin/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= general_value('application_name') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('public/admin/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session('admin_username') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Divider -->
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link <?=($ap==='index' || $ap==='dashboard') ?'active':''?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item menu <?=($ap==='showadmin' || $ap==='account' || $ap==='changepassword' || $ap==='registeradmin')? 'menu-open':''?>">
            <a href="#" class="nav-link <?=($ap==='showadmin' || $ap==='account' || $ap==='changepassword' || $ap==='registeradmin')? 'active':''?>">
              <i class="nav-icon fas fa fa-user"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/showadmin'); ?>" class="nav-link <?=($ap==='showadmin') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/account'); ?>" class="nav-link <?=($ap==='account') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/changepassword'); ?>" class="nav-link <?=($ap==='changepassword') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/registeradmin'); ?>" class="nav-link <?=($ap==='registeradmin') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- separator -->
          <li class="nav-item menu <?=($ap==='employer' || $ap==='addemployer')? 'menu-open':''?>">
            <a href="#" class="nav-link <?=($ap==='employer' || $ap==='addemployer')? 'active':''?>">
              <i class="nav-icon fas fa fa-user-circle"></i>
              <p>
                Employers/Company
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/employer'); ?>" class="nav-link <?=($ap==='employer') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employers List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/addemployer'); ?>" class="nav-link <?=($ap==='addemployer') ?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Employer</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/list_category'); ?>" class="nav-link <?=($ap==='list_category') ?'active':''?>">
              <i class="nav-icon far fa fa-bars"></i>
              <p>
              Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/list_industry'); ?>" class="nav-link <?=($ap==='list_industry') ?'active':''?>">
              <i class="nav-icon far fa fa-industry"></i>
              <p>
              Industry
              </p>
            </a>
          </li>
          <li class="nav-item <?=($ap==='list_packages')? 'menu-open':''?>">
            <a href="#" class="nav-link <?=($ap==='list_packages')? 'active':''?>">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Packages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/list_packages'); ?>" class="nav-link  <?=($ap==='list_packages')? 'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Packages List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Packages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?=($ap==='payments')? 'menu-open':''?>">
            <a href="#" class="nav-link <?=($ap==='payments')? 'active':''?>">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Payments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/payments'); ?>" class="nav-link  <?=($ap==='payments')? 'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Payments</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>