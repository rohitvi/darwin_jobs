<?php include(VIEWPATH . 'admin/include/header.php'); ?>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Packages</h1>
        </div>
        <div class="col-sm-4">


        </div>
        <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Packages</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><a href="<?= base_url('admin/add_packages'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Packages</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped" id="basic_filter">
                <thead>
                  <tr>
                    <th>#ID</th>
                    <th>Package Title</th>
                    <th>Price</th>
                    <th>No. of Days</th>
                    <th>No. of Posts</th>
                    <th>Package For</th>
                    <th>Status</th>
                    <th style="width: 150px;" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($packages as $package) : ?>
                    <tr>
                      <td><?= $package['id']; ?></td>
                      <td><?= $package['title']; ?></td>
                      <td><?= $package['price']; ?></td>
                      <td><?= $package['no_of_days']; ?></td>
                      <td><?= $package['no_of_posts']; ?></td>
                      <td><?= ($package['package_for'] == 0) ? '<span class="btn btn-primary btn-xs">JobSeeker</span>' : '<span class="btn btn-info btn-xs">Employer</span>' ?></td>
                      <td><?= ($package['is_active'] == 1) ? '<span class="btn btn-success btn-xs">Active</span>' : '<span class="btn btn-danger btn-xs">Inactive'; ?></td>
                      <td class="text-center"><a class="btn-sm btn-primary" href="<?= base_url('admin/edit_packages/' . $package['id']); ?>"><i class="nav-icon fas fa-edit"></i> Edit</a></td>
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
    </div>
  </section>

  <script>
    $(document).ready(function() {
      <?php if (session()->getFlashdata('status')) { ?>
        swal({
          title: "<?= session()->getFlashdata('status') ?>",
          icon: "<?= session()->getFlashdata('status_icon') ?>",
          button: "OK",
        });
      <?php } ?>

      $('.swal-overlay').delay(3000).fadeOut('slow');
    });
  </script>


</div>

<!-- /.content-wrapper -->
<?php include(VIEWPATH . 'admin/include/footer.php'); ?>