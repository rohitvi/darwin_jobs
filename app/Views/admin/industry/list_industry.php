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
          <?php
               // if(!empty($session->getFlashdata('success'))){
              ?>
                <strong class="btn btn-warning"> <?php //echo $session->getFlashdata('success');?></strong>
              <?php
               // }
              ?>

              
              <?php
                //if(!empty($session->getFlashdata('error'))){
              ?>
                <strong class="btn btn-warning"> <?php //echo $session->getFlashdata('error');?></strong>
              <?php
                //}
              ?>

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
                <h3 class="card-title"><a href="<?= base_url('admin/add_industry'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Industry</a></h3>

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
                      <th>No</th>
                      <th>Industry Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $count=0; foreach($industry as $row): ?>
                    <tr>
                      <td><?= ++$count; ?></td>
                      <td><?= $row['name']; ?></td>
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

 </div>

  <!-- /.content-wrapper -->
  <?php include(VIEWPATH.'admin/include/footer.php'); ?>