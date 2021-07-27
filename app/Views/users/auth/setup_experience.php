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
                    <a class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Experience</a>
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
                    <h3>Experience</h3>
                    <div class="container">
                        <form action="<?= base_url('home/setup/experience') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Job Title</label>
                                <input class="form-control valid" name="job_title" value="<?= (isset($experience['job_title'])) ? $experience['job_title'] : '' ?>" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Company</label>
                                <input class="form-control valid" name="company" value="<?= (isset($experience['company'])) ? $experience['company'] : '' ?>" type="text">
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select class="form-control select" id="country" name="country">
                                    <option value="">Select Country</option>
                                    <?php foreach($countries as $country):?>
                                    <?php if(isset($experience['country']) == $country['id']): ?>
                                    <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                    <?php else: ?>
                                    <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Start Month</label>
                                <?php
                                    $options = get_months_list();
                                    echo form_dropdown('starting_month', $options, (isset($experience['starting_month'])) ? $experience['starting_month'] : '', 'class="form-control"');
                                ?>
                            </div>
                            <div class="col-md-3">
                                <label>Start Year</label>
                                <?php
                                    $options = get_years_list();
                                    echo form_dropdown('starting_year', $options, (isset($experience['starting_year'])) ? $experience['starting_year'] : '', 'class="form-control"');
                                ?>
                            </div>
                            <div class="col-md-3">
                                <div class="exp-end-field">
                                    <label>End Month</label>
                                    <?php
                                        $options = get_months_list();
                                        echo form_dropdown('ending_month', $options, (isset($experience['ending_month'])) ? $experience['ending_month'] : '', 'class="form-control "');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="exp-end-field">
                                    <label>End Year</label>
                                    <?php
                                        $options = get_years_list();
                                        echo form_dropdown('ending_year', $options, (isset($experience['ending_year'])) ? $experience['ending_year'] : '', 'class="form-control "');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Currently Working Here</label><br>
                                <input type="checkbox" name="currently_working_here" class="currently_working_here" value="1">
                            </div>
                            <div class="col-md-12">
                                <h5>Description</h5>
                                <textarea name="description" class="form-control" rows="2"><?= (isset($experience['description'])) ? $experience['description'] : '' ?></textarea>
                            </div>
                            <div class="col-md-12 text-right">
                                <button class='btn btn-primary my-3'>Next</button>
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
    $(document).on('click','.currently_working_here',function(){
        $this = $(this);
        if($this.is(':checked'))
            $('.exp-end-field').hide();
        else
            $('.exp-end-field').show();
        });
</script>