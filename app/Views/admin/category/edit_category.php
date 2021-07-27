<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
              
              <!-- /.card-header -->
              <!-- form start-->
              <form action="<?= base_url('admin/edit_category/'.$category_row[0]['id'])?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" name="category" class="form-control" value="<?php echo  $category_row[0]['name'];?>" placeholder="category Name" required>
                   
                  </div>

                  <div class='form-group'>
                      <label for="iconfield">Add Icon Field</label>
                      <input type="text" name="iconfield" class="form-control" value="<?php echo  $category_row[0]['iconfield'];?>" placeholder="Add Icon Field" required>
          
                  </div>

                  <div class='form-group'>
                      <label for="">Status</label>
                      <select name="status" class="form-control">
                      <option value="">Please Select</option>
                      <option value="0" <?= ($category_row[0]['status'] == 0)?'selected' :'' ?>>Inactive</option>
                      <option value="1" <?= ($category_row[0]['status'] == 1)?'selected' :'' ?>>Active</option>
                      </select> 
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="submit" value="Update category" class="btn btn-info">
                </div>
                </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <!-- /.content-wrapper -->
    <?php include(VIEWPATH.'admin/include/footer.php'); ?>