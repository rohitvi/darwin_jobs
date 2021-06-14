<?php include(VIEWPATH.'admin/include/header.php'); ?>
    <div class="container">
        <div class="col-12 my-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php include(VIEWPATH.'admin/include/flash_message.php'); ?>

              <form action="<?= base_url('admin/changepassword'); ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Change</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
    </div>
<?php include(VIEWPATH.'admin/include/footer.php'); ?>