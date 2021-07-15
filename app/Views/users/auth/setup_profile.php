<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
    <h2>Complete Profile</h2>
  </div>
</div>
</header>
<main>
    <div class="job_container">
        <div class="container">
            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Languages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Resume/CV</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active">
                    <h3>Profile</h3>
                    <div class="container">
                        <form action="<?= base_url('home/setup/profile') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label  >Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group text-center">
                            <?php if($data[0]['profile_picture'] == "")  :?>
                                <img src="<?= base_url('/public/users/images/ava.jpg') ?>" alt="No Image" width='80px'>
                            <?php else :?>
                                <img src="<?= $data[0]['profile_picture']; ?>" alt="No Image" width='80px'>
                            <?php endif ;?>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>First Name</label>
                                    <input type="text" name="firstname" value="<?= (isset($data[0]['firstname'])) ? $data[0]['firstname'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Last Name</label>
                                    <input type="text" name="lastname" value="<?= (isset($data[0]['lastname'])) ? $data[0]['lastname'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?= (isset($data[0]['email'])) ? $data[0]['email'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Phone </label>
                                    <input type="text" name="mobile_no" value="<?= (isset($data[0]['mobile_no'])) ? $data[0]['mobile_no'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Date of Birth:</label>
                                    <input type="text" name="dob" id="dob" value="<?= (isset($data[0]['dob'])) ? $data[0]['dob'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Age * </label>
                                    <input type="text" name="age" id="age" value="<?= (isset($data[0]['age'])) ? $data[0]['age'] : '' ?>" class="form-control">
                                    <!-- <select name="age" class="form-control  ">
                                    <?php for ($i = 11; $i < 80; $i++) : ?>
                                        <?php if ($data[0]['age'] == $i) : ?>
                                        <option selected><?= $i; ?></option>
                                        <?php else : ?>
                                        <option><?= $i; ?></option>
                                    <?php endif;
                                    endfor; ?>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Category</label>
                                    <select class="form-control" name="category">
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <?php if ($data[0]['category'] == $category['id']) : ?>
                                        <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                                        <?php else : ?>
                                        <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                    <?php endif;
                                    endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Job Title</label>
                                    <input type="text" name="job_title" value="<?= (isset($data[0]['job_title'])) ? $data[0]['job_title'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Experience</label>
                                    <select name="experience" class="form-control">
                                    <option value="0-1" <?php if ($data[0]['experience'] == '0-1') {
                                        echo "selected";
                                    } ?>>0-1 Years</option>
                                    <option value="1-2" <?php if ($data[0]['experience'] == '1-2') {
                                        echo "selected";
                                    } ?>>1-2 Years</option>
                                    <option value="2-5" <?php if ($data[0]['experience'] == '2-5') {
                                        echo "selected";
                                    } ?>>2-5 Years</option>
                                    <option value="5-10" <?php if ($data[0]['experience'] == '5-10') {
                                        echo "selected";
                                    } ?>>5-10 Years</option>
                                    <option value="10-15" <?php if ($data[0]['experience'] == '10-15') {
                                        echo "selected";
                                    } ?>>10-15 Years</option>
                                    <option value="15+" <?php if ($data[0]['experience'] == '15+') {
                                        echo "selected";
                                    } ?>>15+ Years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Skills</label>
                                    <input type="text" name="skills" value="<?= (isset($data[0]['skills'])) ? $data[0]['skills'] : '' ?>" class="form-control tagin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Current Salary(INR)</label>
                                    <select name="current_salary" class="form-control  ">
                                    <?php for ($i = 500; $i < 10000; $i = $i + 500) : ?>
                                        <?php if ($data[0]['current_salary'] == $i) : ?>
                                        <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                                        <?php else : ?>
                                        <option><?= $i; ?></option>
                                    <?php endif;
                                    endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Expected Salary(INR)</label>
                                    <select name="expected_salary" class="form-control  ">
                                    <?php for ($i = 500; $i < 10000; $i = $i + 500) : ?>
                                        <?php if ($data[0]['expected_salary'] == $i) : ?>
                                        <option value="<?= $i; ?>" selected> <?= $i; ?> </option>
                                        <?php else : ?>
                                        <option><?= $i; ?></option>
                                    <?php endif;
                                    endfor; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Country</label>
                                    <select class="form-control  " id="country" name="country">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $country) : ?>
                                        <?php if ($data[0]['country'] == $country['id']) : ?>
                                            <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                        <?php else : ?>
                                        <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                        <?php endif;
                                    endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>State</label>
                                    <?php
                                    $states = get_country_states($data[0]['country']);
                                    $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                    echo form_dropdown('state', $options, $data[0]['state'], 'class="state form-control  "');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>City</label>
                                    <?php
                                    $cities = get_state_cities($data[0]['state']);
                                    $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                    echo form_dropdown('city', $options, $data[0]['city'], 'class="city form-control  "');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label>Full Address</label>
                                    <input type="text" name="address" value="<?= (isset($data[0]['address'])) ? $data[0]['address'] : '' ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 text-right mt-3">
                                <button class="btn btn-primary btn-sm">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include(VIEWPATH . 'users/include/footer.php'); ?>
<script>
    for (const el of document.querySelectorAll('.tagin')) {
      tagin(el)
    }

    var csfr_token_name = '<?= csrf_token() ?>';
    var csfr_token_value = '<?= csrf_hash() ?>';
    $(document).ready(function() {
        $('#country').on('change', function() {
        var data = {
            country: this.value,
        }
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
            url: '<?= base_url('home/get_country_states'); ?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            cached: false,
            success: function(obj) {
            $('.state').html(obj.msg);
            }
        });
        });
        $('.state').on('change', function() {
        var data = {
            state: this.value,
        }
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
            url: '<?= base_url('home/get_state_cities'); ?>',
            type: 'POST',
            data: data,
            dataType: 'json',
            cached: false,
            success: function(obj) {
            $('.city').html(obj.msg);
            }
        });
        });

        $("#dob").datepicker({
        onSelect: function(value, ui) {
            var today = new Date(),
                age = today.getFullYear() - ui.selectedYear;
            $('#age').val(age);
        },
        dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+0"
        });

    });
</script>