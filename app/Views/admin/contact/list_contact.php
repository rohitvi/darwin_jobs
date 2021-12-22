<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Contact Form Queries</h1>
          </div>
          <div class="col-sm-4">
          

          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact</li>
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
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped" id="basic_filter">
                  <thead>
                    <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th style="width: 150px;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach($contact as $row): ?>
                    <tr>
                    <td><?= ++$count; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= ($row['user_type']  == 'JobSeeker') ? '<span class="btn btn-primary btn-xs">JobSeeker</span>' : '<span class="btn btn-success  btn-xs">Employer</span>' ?></td>
                    <td><?= $row['subject']; ?></td>
                    <td><?= $row['message']; ?></td>
                        <td><a title="Delete" class="btn-delete btn btn-sm btn-danger" onclick="return confirm('Are you Sure to Delete ?')" href="<?= base_url('admin/del_contactus/'.$row['id']); ?>"> <i class="fa fa-trash"></i>    Delete</a></td>
                    </tr>
                    <?php endforeach;?>
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