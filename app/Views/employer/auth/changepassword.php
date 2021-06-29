<?php include(VIEWPATH . 'employer/include/header.php'); ?>

<div class=" job_main_right">
  <div class="row job_section">
    <div class="col-sm-12">
      <div class="jm_headings">
        <h5>Update My Password</h5>
        <a class="btn btn-primary mypbtn" href="<?= base_url('employer/profile') ?>">Personal profile</a>
      </div>
      <div class="section-divider">
      </div>
      <form action="<?= base_url('employer/changepassword') ?>" method="post">
        <input type="hidden" name="_method" value="PUT" />
        <div class="big_form_group">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group ">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter Password" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Confirm Password</label>
                <input name="cpassword" type="password" class="form-control" placeholder="Confirm Password" required>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Change</button>
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



<?php include(VIEWPATH . 'employer/include/footer.php'); ?>