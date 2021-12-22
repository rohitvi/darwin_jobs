<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Employment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/employment'); ?>">Employment List</a></li>
              <li class="breadcrumb-item active"><a>Edit Employment</a></li>
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
                <h3 class="card-title">Edit Employment</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('admin/updateemployment/'.$data[0]['id']); ?>" method="post">
                <input type="hidden" name="_method" value="PUT" />
                <div class="card-body">
                    <div class="form-group">
                        <label>Type Name</label>
                        <input type="text" name="type" value="<?= set_value('type', $data[0]['type']) ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
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
