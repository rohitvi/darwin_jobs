<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Employer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/employer'); ?>">List Employers</a></li>
              <li class="breadcrumb-item active"><a>Add Employer</a></li>
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
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Employer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('admin/addemployer'); ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" class="form-control" id="firstname" name='firstname' placeholder="First name" required>
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                  </div>
                  <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                   <label for="cpassword">Confirm Password</label>
                   <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- Company section -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            <!-- general form elements -->
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Company Information</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name='company_name' placeholder="Enter Company Name">
                  </div>
                  <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                      <option selected="selected">Select Category</option>
                      <?php
                        foreach($categories as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php
                        } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="org_type">Organization Type</label>
                    <select class="form-control" id="org_type" name="org_type">
                      <option value="private">Private</option>
                      <option value="public">Public</option>
                      <option value="government">Government</option>
                      <option value="ngo">NGO</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country">
                      <option selected="selected">Select Country</option>
                      <?php
                        foreach($countries as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php
                        } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="state">State</label>
                    <select class="form-control" id="state" name="state">
                      <option selected="selected">Select State</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="city">City</label>
                    <select class="form-control" id="city" name="city">
                      <option selected="selected">Select City</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="postcode">Pin Code</label>
                    <input type="text" class="form-control" id="postcode" name='postcode' placeholder="Pin Code">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name='address' placeholder="Address">
                  </div>
                  <div class="form-group">
                    <label for="phone_no">Mobile No.</label>
                    <input type="text" class="form-control" id="phone_no" name='phone_no' placeholder="Mobile Number">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" name='website' placeholder="Website">
                  </div>
                  <div class="form-group">
                    <label for="description">Company Description</label>
                    <textarea class="form-control" id="description" name='description'></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    $(document).ready(function(){
      $('#country').on('change',function(){
        var country_id = this.value;
        $.ajax({
          url: '<?= base_url('admin/addemployer'); ?>',
          type: 'POST',
          data: {
            country_id: country_id
          },
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $state = $('#state');
            for (var i = 0; i < json.length; i++) {
              $state.append('<option value=' + json[i].id + '>' + json[i].name + '</option>')
            }
            // $('#state').html(result);
            // $('#city').html('<option value="">Select State First!</option>');
          }
        });
      });
      $('#state').on('change',function(){
        var state_id = this.value;
        $.ajax({
          url: '<?= base_url('admin/getcities'); ?>',
          type: 'POST',
          data: {state_id:state_id},
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $cities = $('#city');
            for (var i = 0; i < json.length; i++) {
              $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
            }
          }
        });
      });
    });
  </script>

<?php include(VIEWPATH.'admin/include/footer.php'); ?>
