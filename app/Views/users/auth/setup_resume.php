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
                    <a class="nav-link">Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Languages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active">Resume/CV</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active">
                    <h3>Resume</h3>
                    <div class="container">
                        <form action="<?= base_url('home/setup/resume') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class='col-md-6'>
                                <h5>Resume * <small>(Maximum file size is 1MB, pdf only)</small></h5>
                                <input class="my-3" type="file" name="user_resume">
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary my-3">Submit</button>
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