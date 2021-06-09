<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Industry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Industry</li>
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
              <form  name="addcategory" id="addcategory" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Industry Name</label>
                    <input type="text" name="industry" class="form-control" id="category" value="" placeholder="Industry Name">
                    <?php
                   // print_r($validation);
                      if(isset($validation) && $validation->hasError('category')){
                        echo '<p class="invalid-feedback">'.$validation->getError('category').'</p>';
                      }
                    ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" name="submit" value="Add Industry" class="btn btn-info">
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