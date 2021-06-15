<?php include(VIEWPATH.'admin/include/header.php'); ?>

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
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
              
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                      <th>Job Title</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data as $row) : ?>
                    <tr>
                      <td>
                        <?= $row['firstname'].' '.$row['lastname'] ?>
                      </td>
                      <td>
                        <?= $row['email']; ?>
                      </td>
                      <td>
                        <?= $row['mobile_no']; ?>
                      </td>
                      <td>
                        <?= $row['job_title']; ?>
                      </td>
                      <td>
                        <?= ($row['is_active'] == 1)? '<span class="btn btn-success btn-xs">Active</span>': '<span class="btn btn-danger btn-xs">Inactive</span>'; ?>
                      </td>
                      <td>
                        <a type="button" class="btn btn-secondary" href="<?= base_url('admin/edituser/'.$row['id']); ?>">Edit</a>
                        <a type="button" class="btn btn-danger" href="<?= base_url('admin/deleteuser/'.$row['id']); ?>">Delete</a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include(VIEWPATH.'admin/include/footer.php'); ?>
