<?php include(VIEWPATH . 'user/include/header.php'); ?>
<style>
    @media (min-width: 992px) {
        .col-lg-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 63.666667%;
            margin-left: 1%;
        }
    }

    .employer-dashboard-thumb {
        border: 1px solid #efefef;
        width: 140px;
        height: 140px;
        display: inline-block;
        border-radius: 100%;
        padding: 4px 4px 4px 6px;
        margin-bottom: 22px;
    }

    .employer-dashboard-thumb img {
        border-radius: 100%;
        height: 125px;
        margin-top: 3px;
    }

    .out {
        position: relative;
    }

    .iconn {
        position: absolute;
        top: 25%;
        right: 40%;
        z-index: 5;
    }

    .genric-btn.default,
    .genric-btn.success {
        width: 73%;
    }
</style>
<!-- Hero Area Start-->
<div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Candidate Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero Area End -->
<!-- Start Align Area -->
<div class="whole-wrap">
    <div class="container box_1170">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 col-md-4 mt-sm-30">
                    <div class="single-element-widget" style="text-align:center">
                        <div class="out">
                            <a href="javascript:avoid(0)" class="employer-dashboard-thumb">
                                <img class="profile-picture" src="http://localhost/reference-job/uploads/profile_pictures/2371115986d7a15f9904cb4a355cf5f0.jpg" alt="">
                            </a>
                            <form id="change_file">
                                <div class="iconn">
                                    <label>
                                        <i class="loader_class fas fa-camera fa-3x"></i>
                                        <input type="file" style="display: none" name="profile_picture" class="change_file">
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div>
                            <a href="" class="genric-btn success large mt-15 text-left">
                                <div class="icon"><i class="fas fa-user" aria-hidden="true"></i> &nbsp;&nbsp; My Profile</div>
                            </a>
                        </div>
                        <div>
                            <a href="" class="genric-btn default large mt-15 text-left">
                                <div class="icon"><i class="fas fa-file-word" aria-hidden="true"></i> &nbsp;&nbsp; My Applications</div>
                            </a>
                        </div>
                        <div>
                            <a href="<?= base_url('home/matching_jobs') ?>" class="genric-btn default large mt-15 text-left">
                                <div class="icon"><i class="fas fa-briefcase" aria-hidden="true"></i> &nbsp;&nbsp; Matching Jobs</div>
                            </a>
                        </div>
                        <div>
                            <a href="" class="genric-btn default large mt-15 text-left">
                                <div class="icon"><i class="fas fa-heart" aria-hidden="true"></i> &nbsp;&nbsp; Saved Jobs</div>
                            </a>
                        </div>
                        <div>
                            <a href="" class="genric-btn default large mt-15 text-left">
                                <div class="icon"><i class="fas fa-lock" aria-hidden="true"></i> &nbsp;&nbsp; Change Password</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <h3 class="mb-30">Personal Information</h3>
                    <form action="#">
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" required class="single-input">
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" required class="single-input">
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" required class="single-input">
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input type="text" name="phone" required class="single-input">
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-6">
                                <label>Date Of Birth</label>
                                <input type="date" name="dob" required class="single-input">
                            </div>
                            <div class="col-md-6">
                                <label>Age</label>
                                <input type="number" name="age" required class="single-input">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Align Area -->
<?php include(VIEWPATH . 'user/include/footer.php'); ?>

<!-- Change Profile Image -->
<script>
    $(document).ready(function(e) {
        $('.change_file').on('change', (function(e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById("change_file"));
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Home/updateProfileImage') ?>",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader_class').removeClass('fa-camera fa-pulse');
                    $('.loader_class').addClass('fa-spinner fa-pulse');
                },
                success: function(response) {
                    var response = response.split('~');
                    if ($.trim(response[0]) == 1) {
                        $('.profile-picture').attr("src", response[1]);
                        Alert('success', 'Profile Picture Successfully Updated');
                    } else {
                        Alert('error', response[1]);
                    }
                    $('.loader_class').removeClass('fa-spinner fa-pulse');
                    $('.loader_class').addClass('fa-camera');
                },
                error: function(data) {
                    $('.loader_class').removeClass('fa-spinner fa-pulse');
                    $('.loader_class').addClass('fa-camera');
                    Alert('error', 'Failed To Update Profile Picture');
                }
            });
        }));
    });
</script>
<!-- End Change Profile Image -->