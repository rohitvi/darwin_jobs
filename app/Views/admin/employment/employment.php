<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a type="button" class="btn btn-primary" href="<?= base_url('admin/addemployment'); ?>">Add Employment</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employment List</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="basic_filter" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $count=0; foreach($data as $row):?>
                    <tr>
                      <td><?= ++$count; ?></td>
                      <td><?= $row['type']; ?></td>
                      <td>
                        <a href="<?= base_url('admin/editemployment/'.$row['id']); ?>" type="button" class="btn btn-secondary">Edit</a>   
                        <a href="<?= base_url('admin/deleteemployment/'.$row['id']); ?>" type="button" class="btn btn-danger">delete</a>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include(VIEWPATH.'admin/include/footer.php'); ?>