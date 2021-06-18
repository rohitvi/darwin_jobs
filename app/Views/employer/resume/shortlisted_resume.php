<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">ShortListed Resumes</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li><li class="breadcrumb-item active">ShortListed Resumes
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Begin Row -->
        <div class="row flex-row">
            <?php foreach ($data as $value): ?>
            <div class="col-xl-3 col-md-6 col-sm-6">
                <!-- Begin Widget 01 -->
                <div class="widget widget-01 has-shadow">
                    <div class="widget-body no-padding text-center">
                        <h3><?= $value['firstname'].' '.$value['lastname'] ?></h3>
                        <h5 class="m0p14"><?= $value['job_title'] ?></h5>
                        <h5 class="m0p14">Location : <?= get_state_name($value['state']).', '.get_country_name($value['country']) ?></h5>
                        <h5 class="m0p14">Current Salary : INR <?= $value['current_salary'] ?></h5>
                        <h5 class="m0p14"><a href="<?= base_url($value['resume']) ?>"><i class="la la-download animated swing"></i> Download CV</a></h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-sm btn-light mb-2" onclick="userdetails(<?= $value['user_id'] ?>)" data-toggle="modal" data-target="#modal-large"><i class="la la-user animated swing"></i>User Profile</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-sm btn-light mb-2"><i class="la la-wechat animated swing"></i>Interview</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Widget 01 -->
            </div>
            <?php endforeach ?>
        </div>
        <!-- End Row -->
    </div>
<!-- End Container -->
<!-- Begin Centered Modal -->
<div id="modal-large" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User Details</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Centered Modal -->

<script>
    function userdetails(id){
        event.preventDefault();
        var id = id;
        $.ajax({
            type: "POST",
            data: {
                user_id: id,
            },
            url: "<?= base_url('employer/userdetails') ?>",
            cached: false,
            success: function(data) {
                console.log(data);
                $('#modal-body').html(data);
            }
        });
    }
</script>
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
