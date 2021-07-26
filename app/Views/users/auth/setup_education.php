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
                    <a class="nav-link">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Education</a>
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
                    <h3>Education</h3>
                    <div class="container">
                    <form action="<?= base_url('home/setup/education') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Degree Level</label>
                                <?php 
                                    $educations = get_education_list();
                                    $options = array('' => 'Select Option') + array_column($educations,'type','id');
                                    echo form_dropdown('level',$options,(isset($edu['degree'])) ? $edu['degree'] : '','class="form-control"');
                                ?>
                            </div>
                            <div class="col-md-6">
                                <label>Degree Title</label>
                                <input class="form-control" name="title" type="text" value="<?= (isset($edu['degree_title'])) ? $edu['degree_title'] : '' ?>" placeholder="e.g., Computer Science">
                            </div>
                            <div class="col-md-6">
                                <label>Major Subjects</label>
                                <input class="form-control" name="majors" type="text" value="<?= (isset($edu['major_subjects'])) ? $edu['major_subjects'] : '' ?>" placeholder="please specify your major subjects">
                            </div>
                            <div class="col-md-6">
                                <label>Institution</label>
                                <input class="form-control" name="institution" type="text" value="<?= (isset($edu['institution'])) ? $edu['institution'] : '' ?>" placeholder="Institution">
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select class="form-control select" id="country" name="country">
                                    <option value="">Select Country</option>
                                    <?php foreach($countries as $country):?>
                                    <?php if(isset($edu['country']) == $country['id']): ?>
                                    <option value="<?= $country['id']; ?>" selected> <?= $country['name']; ?> </option>
                                    <?php else: ?>
                                    <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Completion Year</label>
                                <?= year_dropdown('year', '1985', ''); ?>
                            </div>
                            <div class='col-md-12 text-right'>
                                <button type="submit" class="btn btn-primary my-3" >Next</button>
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