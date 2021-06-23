<?php include(VIEWPATH.'employer/include/header.php'); ?>

<!-- End Left Sidebar -->
<!-- Begin Content -->
<div class="content-inner profile">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Profile</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('employer/dashboard') ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row flex-row">
            <div class="col-xl-3">
                <!-- Begin Widget -->
                <div class="widget has-shadow">
                    <div class="widget-body">
                        <div class="mt-5">
                            <img src="<?= base_url('public/employer/assets/img/avatar/avatar-01.jpg') ?>" alt="..." style="width: 120px;" class="avatar rounded-circle d-block mx-auto">
                        </div>
                        <h3 class="text-center mt-3 mb-1">David Green</h3>
                        <p class="text-center">dgreen@example.com</p>
                        <div class="em-separator separator-dashed"></div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('employer/profile') ?>"><i class="la la-user la-2x align-middle pr-2"></i>Personal Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('employer/mypackages') ?>"><i class="la la-bell la-2x align-middle pr-2"></i>My Packages</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Widget -->
            </div>
            <div class="col-xl-9">
                <div class="widget has-shadow conf">
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                        <h4><?= $data[0]['title'] ?></h4>
                    </div>
                    <div class="widget-body">
                        <div class="section-title mb-5">
                            <h4>Details</h4>
                        </div>
                        <p>Package Name : <?= $data[0]['title'] ?></p>
                        <p>Package Description : <?= $data[0]['detail'] ?></p>
                        <p>Total No of Post : <?= $data[0]['no_of_posts'] ?></p>
                        <p>Total No of Days : <?= $data[0]['no_of_days'] ?></p>
                        <p>Package Ends on : <?= $data[0]['expire_date'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    <!-- End Container -->
                    
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
