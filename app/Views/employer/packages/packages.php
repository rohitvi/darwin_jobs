<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Packages</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li><li class="breadcrumb-item active">Packages
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Begin Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="widget has-shadow">
                    <!-- Begin Widget Header -->
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                        <h2>Select Package</h2>
                    </div>
                    <!-- End Widget Header -->
                    <!-- Begin Widget Body -->
                    <div class="widget-body">
                        <div class="pricing-tables-fixed">
                            <div class="row">
                                <?php foreach ($data as $value): ?>
                                    <div class="col-lg-4 no-padding">
                                        <div class="pricing-tables-01 pricing-wrapper">
                                            <div class="inner-container">
                                                <div class="pricing-image">
                                                    <img src="<?= base_url('public/employer/assets/img/icone-01.png') ?>" alt="...">
                                                </div>
                                                <div class="title"><?= $value['title']; ?></div>
                                                <div class="container-text"><?= $value['slug']; ?></div>
                                                <div class="main-number"><?= $value['price']; ?></div>
                                                <div class="pricing-list">
                                                    <p><?= $value['detail']; ?></p>
                                                </div>
                                            </div>
                                            <a class="btn btn-lg btn-shadow" href="<?= base_url('') ?>">Purchase</a>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Body -->
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
                    <!-- End Container -->
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
