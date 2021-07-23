<?php include(VIEWPATH.'admin/include/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employers </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a>List Employers</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/addemployer'); ?>" >Add Employer</a></li>
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
                <h3 class="card-title">Employers Table</h3>

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
              <div class="card-body table-responsive">
              
                <table class="table text-nowrap" id="basic_filter">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Company Name</th>
                      <th>Email</th>
                      <th>Mobile No</th>
                      <th>Employer Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $row) : ?>
                    <tr>
                      <td>
                        <?= $row['id']; ?>
                      </td>
                      <td>
                        <?= $row['company_name']; ?>
                      </td>
                      <td>
                        <?= $row['email']; ?>
                      </td>
                      <td>
                        <?= $row['mobile_no']; ?>
                      </td>
                      <td>
                        <?= $row['firstname']; ?>
                      </td>
                      <td>
                        <a href="<?= base_url('admin/employer/'.$row['employer_id']); ?>" class="btn btn-dark" type="button">Edit</a>
                        <a href="<?= base_url('admin/deleteemployer/'.$row['employer_id']); ?>" class="btn btn-danger" onclick="return confirm('Are you Sure to Delete ?')" type="button">Delete</a>
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
