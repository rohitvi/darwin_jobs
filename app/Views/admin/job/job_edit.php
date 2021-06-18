<?php include(VIEWPATH . 'admin/include/header.php'); ?>

<<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Job</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/view_jobs'); ?>">List Job</a></li>
                            <li class="breadcrumb-item active"><a>Edit Job</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Job</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="<?= base_url('admin/edit_post/' . $job_detail['id']); ?>" id="edit_job" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Job Title*</label>
                                        <input type="text" name="job_title" value="<?= $job_detail['title']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Job Type*</label>
                                        <?php
                                        $types = get_job_type_list();
                                        $options = array('' => 'Select Job Type') + array_column($types, 'type', 'id');
                                        echo form_dropdown('job_type', $options, $job_detail['job_type'], 'class="form-control select2bs4" required')
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Job Category*</label>
                                        <select class="form-control select2bs4" name="category">
                                            <option>Select Category</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <?php if ($job_detail['category'] == $category['id']) : ?>
                                                    <option value="<?= $category['id']; ?>" selected> <?= $category['name']; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                            <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Job Indusry*</label>
                                        <select class="form-control select2bs4" name="industry">
                                            <option>Select Indusry</option>
                                            <?php foreach ($industries as $industry) : ?>
                                                <?php if ($job_detail['industry'] == $industry['id']) : ?>
                                                    <option value="<?= $industry['id']; ?>" selected> <?= $industry['name']; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $industry['id']; ?>"> <?= $industry['name']; ?> </option>
                                            <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Position Available *</label>
                                        <select name="total_positions" class="form-control">
                                            <?php for ($i = 1; $i < 30; $i++) : ?>
                                                <?php if ($job_detail['total_positions'] == $i) : ?>
                                                    <option value="<?= $i; ?>" selected><?= $i; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                            <?php endif;
                                            endfor; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Working Experience *</label>
                                        <?php
                                        $exp = explode('-', $job_detail['experience']);
                                        $min = $exp[0];
                                        $max = $exp[1];
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                    $options = get_experience_list('Minimum');
                                                    echo form_dropdown('min_experience', $options, $min, 'class="form-control"');
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                    $options = get_experience_list('Maximum');
                                                    echo form_dropdown('max_experience', $options, $max, 'class="form-control"');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Salary *</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" name="min_salary" class="form-control" placeholder="Minimum" value="<?= $job_detail['min_salary'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="number" name="max_salary" class="form-control" placeholder="Maximum" value="<?= $job_detail['max_salary'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Salary Period *</label>
                                        <select name="salary_period" class="form-control select2bs4">
                                            <option value="Hourly" <?= ($job_detail['salary_period'] == 'Hourly') ? 'selected' : '' ?>>Hourly</option>
                                            <option value="Weekly" <?= ($job_detail['salary_period'] == 'Weekly') ? 'selected' : '' ?>>Weekly</option>
                                            <option value="Monthly" <?= ($job_detail['salary_period'] == 'Monthly') ? 'selected' : '' ?>>Monthly</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Skills*</label>
                                        <input type="text" name="skills" value="<?= $job_detail['skills']; ?>" class="form-control" placeholder="e.g. job title, responsibilites">
                                    </div>
                                    <div class="form-group">
                                        <label>Job Description*</label>
                                        <textarea name="description" class="textarea form-control" id="exampleFormControlTextarea1" rows="5"><?= $job_detail['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Gender Requirement*</label>
                                        <select name="gender" class="form-control">	
                                            <option value="Male" <?php if($job_detail['gender'] == 'Male'){ echo "selected";} ?> >Male</option>
                                            <option value="Female" <?php if($job_detail['gender'] == 'Female'){ echo "selected";} ?> >Female</option>
                                            <option value="No Preference" <?php if($job_detail['gender'] == 'No Preference'){ echo "selected";} ?> >No Preference</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Employment Type*</label>
                                        <?php
                                        $types = get_employment_type_list();
                                        $options = array('' => 'Select Employement Type') + array_column($types, 'type', 'id');
                                        echo form_dropdown('employment_type', $options, $job_detail['employment_type'], 'class="form-control select2bs4"');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Education*</label>
                                        <select class="form-control select2bs4" name="education">
                                            <option value="">Select Education</option>
                                            <?php foreach ($educations as $education) : ?>
                                                <?php if ($job_detail['education'] == $education['id']) : ?>
                                                    <option value="<?= $education['id']; ?>" selected> <?= $education['type']; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
                                            <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Country *</label>
                                        <select class="country form-control select2bs4" name="country">
                                            <option>Select Country</option>
                                            <?php foreach ($countries as $country) : ?>
                                                <?php if ($job_detail['country'] == $country['id']) : ?>
                                                    <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                                <?php else : ?>
                                                    <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                            <?php endif;
                                            endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>State *</label>
                                        <?php
                                        $states = get_country_states($job_detail['country']);
                                        $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                                        echo form_dropdown('state', $options, $job_detail['state'], 'class="form-control select2bs4 state" required');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>City *</label>
                                        <?php
                                        $cities = get_state_cities($job_detail['state']);
                                        $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                                        echo form_dropdown('city', $options, $job_detail['city'], 'class="form-control select2bs4 city" required');
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Location*</label>
                                        <input type="text" name="location" value="<?= $job_detail['location']; ?>" class="form-control" placeholder="Type Address">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" name="edit_job" class="btn btn-primary">Submit</button>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- Company section -->

    <!-- /.content -->
    </div>
    <?php include(VIEWPATH . 'admin/include/footer.php'); ?>
    <script type="text/javascript">
        var base_url = '<?= base_url(); ?>';
        var csfr_token_name = '<?= csrf_token() ?>';
        var csfr_token_value = '<?= csrf_hash() ?>';

        //-------------------------------------------------------------------
        // Country State & City Change
        $(document).on('change', '.country', function() {
            var data = {
                country: this.value,
            }
            data[csfr_token_name] = csfr_token_value;

            $.ajax({
                type: "POST",
                url: "<?= base_url('home/get_country_states') ?>",
                data: data,
                dataType: "json",
                success: function(obj) {
                    $('.state').html(obj.msg);
                },

            });
        });

        $(document).on('change', '.state', function() {
            var data = {
                state: this.value,
            }
            data[csfr_token_name] = csfr_token_value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('home/get_state_cities') ?>",
                data: data,
                dataType: "json",
                success: function(obj) {
                    $('.city').html(obj.msg);
                },
            });

        });
    </script>