<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Job Categories</h1>
          </div>
          <div class="col-sm-4">
         <!-- get flash meassage display -->

          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title"><a href="<?= base_url('admin/add_category'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Category</a></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table mv_datatable table-hover text-nowrap" id="basic_filter">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Category Name</th>
                      <th>Icons</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $count=0; foreach($categories as $row): ?>
                    <tr>
                      <td><?= ++$count; ?></td>
                      <td><?= $row['name']; ?></td>
                      <td><i class="<?= $row['iconfield'] ?>"></i></td>
                      <td><?= ($row['status'] == 1)? '<span class="btn btn-success btn-xs">Active</span>': '<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>

                      <td><a title="Delete" onclick="return confirm('Are you Sure to Delete ?')" class="btn-delete btn btn-sm btn-danger pull-right" href="<?= base_url('admin/del_category/'.$row['id']); ?>"> <i class="nav-icon fas fa-trash"></i>Delete</a>
            <a title="Edit" class="update btn btn-sm btn-primary pull-right" href="<?= base_url('admin/edit_category/'.$row['id'])?>"> <i class="nav-icon fas fa-edit"></i>Edit</a>
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
      </div>
    </section>

<script>
$(document).ready(function(){
<?php if (session()->getFlashdata('status')) {?>
      swal({
        title: "<?= session()->getFlashdata('status') ?>",
        icon: "<?= session()->getFlashdata('status_icon') ?>",
        button: "OK",
        });
<?php }?>

$('.swal-overlay').delay(3000).fadeOut('slow');
});
</script>

 </div>
  <!-- /.content-wrapper -->
  <?php include(VIEWPATH.'admin/include/footer.php'); ?>
  