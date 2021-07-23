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
              <div class="card-body table-responsive">
              
                <table class="table table-hover text-nowrap" id="basic_filter">
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
                      <button type="button" class="btn btn-info" onclick="userdetails(<?= $row['id'] ?>)" data-toggle="modal" data-target="#modal-lg">View Profile</button>
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





<!-- /.modal -->
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">User Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary"  data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



<?php include(VIEWPATH.'admin/include/footer.php'); ?>

<script>
  function userdetails(id){
        event.preventDefault();
        $('#modal-body').html('');
        var id = id;
        $.ajax({
            type: "GET",
            url: '<?= base_url();?>/admin/userdetails/'+id,
            cached: false,
            success: function(data) {
                $('#modal-body').html(data);
            }
        });
    }
</script>
