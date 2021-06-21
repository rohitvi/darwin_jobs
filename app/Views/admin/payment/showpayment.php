<?php include(VIEWPATH.'admin/include/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payments</h1>
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
                <h3 class="card-title">Payments Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              
                <table class="table table-hover text-nowrap" id="basic_filter">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>TXN ID</th>
                      <th>Package Name</th>
                      <th>Amount</th>
                      <th>Date</th>
                      <th>Payment Mode</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data as $row) : ?>
                    <tr>
                      <td>
                        <?= $row['id']; ?>
                      </td>
                      <td>
                        <?= $row['txn_id']; ?>
                      </td>
                      <td>
                        <?= $row['title']; ?>
                      </td>
                      <td>
                        <?= $row['payment_amount']; ?>
                      </td>
                      <td>
                        <?= $row['payment_date']; ?>
                      </td>
                      <td>
                        <?= $row['payment_method']; ?>
                      </td>
                      <td>
                        <?= $row['payment_status']; ?>
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
