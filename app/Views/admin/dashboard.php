<?php include(VIEWPATH . 'admin/include/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6 ">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $all_users ?></h3>

              <p>TOTAL USERS</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="<?= base_url('admin/users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $active_users ?></h3>

              <p>ACTIVE USERS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $deactive_users ?></h3>

              <p>DEACTIVE USERS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/users') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $all_employers ?></h3>

              <p>TOTAL EMPLOYERS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/employer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $active_employers ?></h3>

              <p>ACTIVE EMPLOYERS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/employer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $deactive_employers ?></h3>

              <p>DEACTIVE EMPLOYERS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= base_url('admin/employer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-lg-6 col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Latest Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Job Title</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($latest_users as $row) : ?>
                    <tr>
                      <td><a href="#"><?= $row['firstname'] . ' ' . $row['lastname']; ?></a></td>
                      <td>
                        <p><?= $row['email']; ?>
                      </td>
                      <td><?= $row['job_title']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="card-footer">
                <div class="box-footer">
                  <a href="<?= base_url('admin/users'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-lg-6 col-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Latest Jobs</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Company</th>
                    <th>Title</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($latest_jobs as $row) : ?>
                    <tr>
                      <td><a href="#"><?= $row['company_name']; ?></a></td>
                      <td>
                        <p><?= $row['title']; ?>
                      </td>
                      <td><span class="label label-success"><?= ucfirst($row['is_status']); ?></span></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <div class="card-footer clearfix">
                <div class="box-footer clearfix">
                  <a href="<?= base_url('admin/list_job'); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Jobs</a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include(VIEWPATH . 'admin/include/footer.php'); ?>