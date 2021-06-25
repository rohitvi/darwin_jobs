<?php include(VIEWPATH . 'user/include/header.php'); ?>
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
<!-- Job List Area Start -->
<div class="job-listing-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <!-- Left content -->
            <div class="col-xl-3 col-lg-3 col-md-4">
                <div class="row">
                    <div class="col-12">
                            <div class="small-section-tittle2 mb-45">
                            <div class="ion">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Job Category Listing start -->
                <div class="job-category-listing mb-50">
                   <div class="single-listing text-center">
                        <div class="out">
                            <a href="javascript:avoid(0)" class="employer-dashboard-thumb">
                                <img class="profile-picture img-fluid rounded" height="125" width="125" src="http://localhost/reference-job/uploads/profile_pictures/2371115986d7a15f9904cb4a355cf5f0.jpg" alt="">
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
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/profile'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-user ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Profile</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-file-word ml-3" aria-hidden="true"></i> &nbsp;&nbsp; My Applications</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/matching_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-briefcase ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Matching Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="<?= base_url('home/saved_jobs'); ?>" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-heart ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Saved Jobs</div>
                        </a>
                   </div>
                   <div class="single-listing mt-3 text-left">
                        <a href="" class="ahref mt-3">
                            <div class="icon"><i class="fas fa-lock ml-3" aria-hidden="true"></i> &nbsp;&nbsp; Change Password</div>
                        </a>
                   </div>
                </div>
                <!-- Job Category Listing End -->
            </div>
            <!-- Right content -->
            <div class="col-xl-9 col-lg-9 col-md-8">
                <!-- Featured_job_start -->
                <section class="featured-job-area">
                    <div class="container">
                        <!-- single-job-content -->
                        <div class="section-top-border mb-30">
                            <h3 class="mb-30">Personal Information</h3>
                            <form action="#">
                                <div class="my-4">
                                    <input type="text" name="first_name" placeholder="First Name"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required
                                        class="single-input">
                                </div>
                                <div class="my-4">
                                    <input type="text" name="last_name" placeholder="Last Name"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required
                                        class="single-input">
                                </div>
                                <div class="my-4">
                                    <input type="text" name="last_name" placeholder="Last Name"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required
                                        class="single-input">
                                </div>
                                <div class="my-4">
                                    <input type="email" name="EMAIL" placeholder="Email address"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required
                                        class="single-input">
                                </div>
                                <div class="input-group-icon my-4">
                                    <div class="icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i></div>
                                    <input type="text" name="address" placeholder="Address" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Address'" required class="single-input">
                                </div>
                                <div class="input-group-icon my-4">
                                    <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                    <div class="form-select" id="default-select"">
                                                <select>
                                                    <option value=" 1">City</option>
                                        <option value="1">Dhaka</option>
                                        <option value="1">Dilli</option>
                                        <option value="1">Newyork</option>
                                        <option value="1">Islamabad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group-icon my-4">
                                    <div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
                                    <div class="form-select" id="default-select"">
                                                <select>
                                                    <option value=" 1">Country</option>
                                        <option value="1">Bangladesh</option>
                                        <option value="1">India</option>
                                        <option value="1">England</option>
                                        <option value="1">Srilanka</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="my-4">
                                    <textarea class="single-textarea" placeholder="Message" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Message'" required></textarea>
                                </div>
                                <div class="my-4">
                                    <input type="text" name="first_name" placeholder="Primary color"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Primary color'" required
                                        class="single-input-primary">
                                </div>
                                <div class="my-4">
                                    <input type="text" name="first_name" placeholder="Accent color"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Accent color'" required
                                        class="single-input-accent">
                                </div>
                                <div class="my-4">
                                    <input type="text" name="first_name" placeholder="Secondary color"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Secondary color'"
                                        required class="single-input-secondary">
                                </div>
                            </form>
                        </div>
                        <!-- single-job-content -->
                    </div>
                </section>
                <!-- Featured_job_end -->
            </div>
        </div>
    </div>
</div>
<!-- Job List Area End -->
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