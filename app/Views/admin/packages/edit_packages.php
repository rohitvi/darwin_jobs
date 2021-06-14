<?php include(VIEWPATH.'admin/include/header.php'); ?>
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Package </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Package </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class='col-md-1'>
            </div>

            <div class='col-md-10'>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Package Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url('admin/edit_packages/'.$packages_row[0]['id'])?>" name="editpackage" id="editpackage" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Package Title</label>
                    <input type="title" name="title" class="form-control <?php echo (isset($validation) && $validation->hasError('title')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['title'];?>"  placeholder="eg. basic, premium">
                    <?php
                      if(isset($validation) && $validation->hasError('title')){
                        echo '<p class="invalid-feedback">'.$validation->getError('title').'</p>';
                      }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="price" name="price" class="form-control  <?php echo (isset($validation) && $validation->hasError('price')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['price'];?>">
                    <?php
                      if(isset($validation) && $validation->hasError('price')){
                        echo '<p class="invalid-feedback">'.$validation->getError('price').'</p>';
                      }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No of Days</label>
                    <input type="number" name='no_of_days' class="form-control  <?php echo (isset($validation) && $validation->hasError('no_of_days')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['no_of_days'];?>">
                    <?php
                      if(isset($validation) && $validation->hasError('no_of_days')){
                        echo '<p class="invalid-feedback">'.$validation->getError('no_of_days').'</p>';
                      }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No of Posts</label>
                    <input type="number" name='no_of_posts' class="form-control <?php echo (isset($validation) && $validation->hasError('no_of_posts')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['no_of_posts'];?>">
                    <?php
                      if(isset($validation) && $validation->hasError('no_of_posts')){
                        echo '<p class="invalid-feedback">'.$validation->getError('no_of_posts').'</p>';
                      }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Package Detail</label>
                    <input type="text" name='detail' class="form-control  <?php echo (isset($validation) && $validation->hasError('detail')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['detail'];?>">
                    <?php
                      if(isset($validation) && $validation->hasError('detail')){
                        echo '<p class="invalid-feedback">'.$validation->getError('detail').'</p>';
                      }
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Sort Order</label>
                    <input type="number" name='sort_order' class="form-control  <?php echo (isset($validation) && $validation->hasError('sort_order')) ? 'is-invalid' : '';?>" value="<?php echo  $packages_row[0]['sort_order'];?>">
                    <?php
                      if(isset($validation) && $validation->hasError('sort_order')){
                        echo '<p class="invalid-feedback">'.$validation->getError('sort_order').'</p>';
                      }
                    ?>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control">
                    <option value="0" <?= ($packages_row[0]['is_active'] == 0)?'selected' :'' ?> >Inactive</option>
                    <option value="1" <?= ($packages_row[0]['is_active'] == 1)?'selected' :'' ?>>Active</option>
                    </select>
                    <?php
                      if(isset($validation) && $validation->hasError('sort_order')){
                        echo '<p class="invalid-feedback">'.$validation->getError('sort_order').'</p>';
                      }
                    ?>
                  </div>
                 
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Packages</button>
                </div>
              </form>
            </div>
            </div>

            <div class='col-md-1'>
            </div>
        </div>
      </div>
    </section>

    </div>

  <!-- /.content-wrapper -->
  <?php include(VIEWPATH.'admin/include/footer.php'); ?>