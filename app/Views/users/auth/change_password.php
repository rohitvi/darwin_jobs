<?php include(VIEWPATH . 'users/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Change Password</h2>
  </div>
</div>
</header>
<!-- Main 
================================================== -->
<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'users/include/profile_info.php'); ?>
      <div class="row job_main">
        <?php include(VIEWPATH . 'users/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
              <div class="jm_headings">
                <h5>Change Password</h5>
              </div>
              <div class="section-divider">
              </div>
              <form action="<?= base_url('home/change_password'); ?>" method="post">
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="current-password">Current password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="old_password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="new-password">New password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="new_password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="confirm-new-password">Confirm new password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="confirm_password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH . 'users/include/footer.php'); ?>