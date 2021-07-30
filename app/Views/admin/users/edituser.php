<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
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
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('admin/updateuser/'.$data[0]['id']); ?>" method="post">
                <input type="hidden" name="_method" value="PUT" />
                <div class="card-body">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name='firstname' placeholder="First Name" value="<?= set_value('firstname', $data[0]['firstname']) ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?= set_value('lastname', $data[0]['lastname']) ?>" required>
                  </div>
                  <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email', $data[0]['email']) ?>" required>
                  </div>
                  <div class="form-group">
                   <label for="mobile_no">Mobile Number</label>
                   <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile Number" value="<?= set_value('mobile_no', $data[0]['mobile_no']) ?>" required>
                  </div>
                  <div class="form-group">
                   <label for="is_active">Select Status</label>
                   <select class="form-control" id="country" name="is_active" required>
                      <option>Select Status</option>
                      <option value="1">Active</option>
                      <option value="0">Deactivate</option>
                    </select>
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
