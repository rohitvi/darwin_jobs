<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title .' | '. get_g_setting_val('application_name') ?></title>
  <link rel="shortcut icon" href="<?= get_g_setting_val('favicon') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/ionicons.min.css'); ?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- JQVMap -->
  
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/jqvmap/jqvmap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/summernote/summernote-bs4.min.css') ?>">
  <!-- Custom Css -->
  <link rel="stylesheet" href="<?= base_url('public/admin/custom/style.css') ?>">
  <!-- sweet alert -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/toastr/toastr.min.css') ?>">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Jquery -->
  <script src="<?= base_url('./public/admin/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <a href="#"><i class="fas fa-sign-out-alt fa-lg"></i></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url(); ?>" class="brand-link">
        <img src="<?= base_url('public/admin/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= get_g_setting_val('application_name') ?></span>
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
              <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link <?= (uri_string(true) == 'admin/dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item menu <?= (uri_string(true) === 'admin/showadmin' || uri_string(true) === 'admin/account' || uri_string(true) === 'admin/changepassword' || uri_string(true) === 'admin/registeradmin') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) === 'admin/showadmin' || uri_string(true) === 'admin/account' || uri_string(true) === 'admin/changepassword' || uri_string(true) === 'admin/registeradmin') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-user"></i>
                <p>
                  Admin
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/showadmin'); ?>" class="nav-link <?= (uri_string(true) == 'admin/showadmin') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Show Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/account'); ?>" class="nav-link <?= (uri_string(true) == 'admin/account') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Account</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/changepassword'); ?>" class="nav-link <?= (uri_string(true) == 'admin/changepassword') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Change Password</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/registeradmin'); ?>" class="nav-link <?= (uri_string(true) == 'admin/registeradmin') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Register Admin</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu <?= (uri_string(true) == 'admin/post' ||uri_string(true) == 'admin/list_job') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/post' || uri_string(true) == 'admin/list_job') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Job Posting
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/list_job'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_job') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Jobs</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/post'); ?>" class="nav-link <?= (uri_string(true) == 'admin/post') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Job</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- separator -->
            <li class="nav-item menu <?= (uri_string(true) == 'admin/users' || uri_string(true) == 'admin/adduser') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/users' || uri_string(true) == 'admin/adduser') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-user"></i>
                <p>
                  Users
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/users'); ?>" class="nav-link <?= (uri_string(true) == 'admin/users') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/adduser'); ?>" class="nav-link <?= (uri_string(true) == 'admin/adduser') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New User</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item menu <?= (uri_string(true) == 'admin/list_category' || uri_string(true) == 'admin/add_category') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/list_category' || uri_string(true) == 'admin/add_category') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-bars"></i>
                <p>
                  Category
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/list_category'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_category') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Category List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/add_category'); ?>" class="nav-link <?= (uri_string(true) == 'admin/add_category') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Category</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu <?= (uri_string(true) == 'admin/list_industry' || uri_string(true) == 'admin/add_industry') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/list_industry' || uri_string(true) == 'admin/add_industry') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-industry "></i>
                <p>
                  Industry
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/list_industry'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_industry') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Industry List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/add_industry'); ?>" class="nav-link <?= (uri_string(true) == 'admin/add_industry') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Industry</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item menu <?= (uri_string(true) == 'admin/list_packages' || uri_string(true) == 'admin/add_packages') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/list_packages' || uri_string(true) == 'admin/add_packages') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-bars"></i>
                <p>
                  Packages
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/list_packages'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_packages') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Packages List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/add_packages'); ?>" class="nav-link <?= (uri_string(true) == 'admin/add_packages') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Packages</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('admin/list_newsletters'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_newsletters') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-envelope"></i>
                <p>Newsletters</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('admin/list_contact'); ?>" class="nav-link <?= (uri_string(true) == 'admin/list_contact') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-envelope"></i>
                <p>Contact Queries</p>
              </a>
            </li>

            <!-- separator -->
            <li class="nav-item menu <?= (uri_string(true) == 'admin/employer' || uri_string(true) == 'admin/addemployer') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= (uri_string(true) == 'admin/employer' || uri_string(true) == 'admin/addemployer') ? 'active' : '' ?>">
                <i class="nav-icon fas fa fa-user-circle"></i>
                <p>
                  Employers/Company
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('admin/employer'); ?>" class="nav-link <?= (uri_string(true) == 'admin/employer') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employers List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('admin/addemployer'); ?>" class="nav-link <?= (uri_string(true) == 'admin/addemployer') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add New Employer</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('admin/payments'); ?>" class="nav-link <?= (uri_string(true) == 'admin/payments') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>View Payments</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('admin/job_type'); ?>" class="nav-link <?= (uri_string(true) == 'admin/job_type') ? 'active' : '' ?>">
                <i class="nav-icon far fa fa-industry"></i>
                <p>
                  Job Type
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/education'); ?>" class="nav-link <?= (uri_string(true) == 'admin/education') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-graduation-cap"></i>
                <p>
                  Education
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/employment'); ?>" class="nav-link <?= (uri_string(true) == 'admin/employment') ? 'active' : '' ?>">
                <i class="nav-icon far fa fa-industry"></i>
                <p>
                  Employment Type
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('admin/add_general_settings'); ?>" class="nav-link <?= (uri_string(true) == 'admin/add_general_settings') ? 'active' : '' ?>">
                <i class="nav-icon fa fa-cogs"></i>
                <p>
                General Settings
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>