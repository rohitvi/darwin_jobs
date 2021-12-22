<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
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
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('admin/updateadmin/'.$data[0]['id']); ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name='username' value="<?= set_value('username', $data[0]['username']) ?>" placeholder="Enter Username" required>
                  </div>
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" value="<?= set_value('firstname', $data[0]['firstname']) ?>" name="firstname" placeholder="Firstname" required>
                  </div>
                  <div class="form-group">
                   <label for="lastname">Last Name</label>
                   <input type="text" class="form-control" id="lastname" value="<?= set_value('lastname', $data[0]['lastname']) ?>" name="lastname" placeholder="Lastname" required>
                  </div>
                  <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" value="<?= set_value('email', $data[0]['email']) ?>" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                   <label for="mobile_no">Mobile Number</label>
                   <input type="number" class="form-control" id="mobile_no" value="<?= set_value('mobile_no', $data[0]['mobile_no']) ?>" name="mobile_no" placeholder="Mobile No" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include(VIEWPATH.'admin/include/footer.php'); ?>
