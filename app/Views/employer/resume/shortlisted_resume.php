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
                                <button class="btn btn-sm btn-light mb-2" onclick="interview(<?= $value['user_id'] ?>)" data-toggle="modal" data-target="#modal-centered"><i class="la la-wechat animated swing"></i>Interview</button>
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
<!-- Begin User Modal -->
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
<!-- End User Modal -->

<!-- Begin Interview Modal -->
<div id="modal-centered" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body" id="interview-modal">
                <p>
                    Donec non lectus nec est porta eleifend. Morbi ut dictum augue, feugiat condimentum est. Pellentesque tincidunt justo nec aliquet tincidunt. Integer dapibus tellus non neque pulvinar mollis. Maecenas dictum laoreet diam, non convallis lorem sagittis nec. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc venenatis lacus arcu, nec ultricies dui vehicula vitae.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End Interview Modal -->

<script>
    function userdetails(id){
        event.preventDefault();
        var id = id;
        $.ajax({
            type: "POST",
            data: {
                user_id: id,
            },
            url: '<?= base_url();?>/employer/userdetails/'+id,
            cached: false,
            success: function(data) {
                $('#modal-body').html(data);
            }
        });
    }
    function interview(id){
        event.preventDefault();
        var id = id;
        $.ajax({
            type: "POST",
            data: {user_id: id,},
            url: '<?= base_url();?>/employer/interview/'+id,
            cached: false,
            success: function(data) {
                $('#interview-modal').html(data);
            }
        });
    }
</script>
<?php include(VIEWPATH.'employer/include/footer.php'); ?>
