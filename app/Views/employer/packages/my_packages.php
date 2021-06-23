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
                                        <h4>My Packages</h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="table-responsive">
                                            <table id="sorting-table" class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Package Name</th>
                                                        <th><span style="width:100px;">Status</span></th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($data as $row) : ?>
                                                    <tr>
                                                        <td><span class="text-primary"><?= $row['id'] ?></span></td>
                                                        <td><?= $row['title'] ?></td>
                                                        <td><span style="width:50px;"><span class="badge-text badge-text-small info">Active</span></span></td>
                                                        <td class="td-actions">
                                                            <a href="<?= base_url('employer/mypackage/'.$row['id']) ?>"><button class="btn btn-primary btn-sm">View</button></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Container -->
                    
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
