<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Employer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/employer'); ?>">List Employers</a></li>
              <li class="breadcrumb-item active"><a>Edit Employer</a></li>
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
                <h3 class="card-title">Personal Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('admin/updateemployer/'.$data[0]['id']); ?>" method="post">
                <input type="hidden" name="_method" value="PUT" />
                <div class="card-body">
                  <div class="form-group">
                    <label for="firstname">First Name *</label>
                    <input type="text" class="form-control" id="firstname" name='firstname' placeholder="First name" value="<?= set_value('firstname', $data[0]['firstname']) ?>">
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?= set_value('lastname', $data[0]['lastname']) ?>">
                  </div>
                  <div class="form-group">
                   <label for="email">Email *</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email', $data[0]['email']) ?>">
                  </div>
                  <div class="form-group">
                   <label for="designation">Designation *</label>
                   <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation" value="<?= set_value('designation', $data[0]['designation']) ?>">
                  </div>
                  <div class="form-group">
                   <label for="mobile_no">Mobile Number *</label>
                   <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number" value="<?= set_value('mobile_no', $data[0]['mobile_no']) ?>">
                  </div>
                  <div class="form-group">
                    <label for="country">Country *</label>
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
                    <label for="state">State *</label>
                    <select class="form-control" id="state" name="state">
                      <option selected="selected">Select State</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="city">City *</label>
                    <select class="form-control" id="city" name="city">
                      <option selected="selected">Select City</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="address">Address *</label>
                    <input type="text" class="form-control" id="address" name='address' placeholder="Address" value="<?= set_value('address', $data[0]['address']) ?>">
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update">
                  </div>
                </div>
              </form>
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
              <form id="companyForm" action="" method="post" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="form-group">
                    <label for="company_logo">Company Logo *</label>
                    <input type="file" class="form-control" id="company_logo" name='company_logo'>
                  </div>
                  <div class="form-group">
                    <label for="company_name">Company Name *</label>
                    <input type="text" class="form-control" id="company_name" name='company_name' placeholder="Enter Company Name">
                  </div>
                  <div class="form-group">
                    <label for="company_email">Company Email *</label>
                    <input type="email" class="form-control" id="company_email" name='company_email' placeholder="Enter Company Email">
                  </div>
                  <div class="form-group">
                    <label for="phone_no">Phone No. *</label>
                    <input type="text" class="form-control" id="phone_no" name='phone_no' placeholder="Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="website">Website *</label>
                    <input type="text" class="form-control" id="website" name='website' placeholder="Website">
                  </div>
                  <div class="form-group">
                    <label for="category">Category *</label>
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
                    <label for="founded_date">Founded Date</label>
                    <input type="date" class="form-control" id="founded_date" name='founded_date'>
                  </div>
                  <div class="form-group">
                    <label for="org_type">Organization Type*</label>
                    <select class="form-control" id="org_type" name="org_type">
                      <option value="private">Private</option>
                      <option value="public">Public</option>
                      <option value="government">Government</option>
                      <option value="ngo">NGO</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="no_of_employers">No. of Employers *</label>
                    <select class="form-control" id="no_of_employers" name="no_of_employers">
                      <option value="1-10">1-10</option>
                      <option value="10-20">10-20</option>
                      <option value="20-30">20-30</option>
                      <option value="30-50">30-50</option>
                      <option value="50-100">50-100</option>
                      <option value="100+">100+</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="description">Company Description *</label>
                    <textarea class="form-control" id="description" name='description'></textarea>
                  </div>
                  <div class="form-group">
                    <label for="ccountry">Country *</label>
                    <select class="form-control" id="ccountry" name="country">
                      <option selected="selected">Select Country</option>
                      <?php
                        foreach($countries as $key => $value) { ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php
                        } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="cstate">State *</label>
                    <select class="form-control" id="cstate" name="state">
                      <option selected="selected">Select State</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="ccity">City *</label>
                    <select class="form-control" id="ccity" name="city">
                      <option selected="selected">Select City</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="postcode">Pin Code *</label>
                    <input type="text" class="form-control" id="postcode" name='postcode' placeholder="Pin Code">
                  </div>
                  <div class="form-group">
                    <label for="full_address">Full Address *</label>
                    <input type="text" class="form-control" id="full_address" name='full_address' placeholder="Full Address">
                  </div>
                  <div class="form-group">
                    <label for="facebook_link">Facebook</label>
                    <input type="text" class="form-control" id="facebook_link" name='facebook_link' placeholder="Facebook Link">
                  </div>
                  <div class="form-group">
                    <label for="twitter_link">Twitter</label>
                    <input type="text" class="form-control" id="twitter_link" name='twitter_link' placeholder="Twitter Link">
                  </div>
                  <div class="form-group">
                    <label for="youtube_link">Youtube</label>
                    <input type="text" class="form-control" id="youtube_link" name='youtube_link' placeholder="Youtube Link">
                  </div>
                  <div class="form-group">
                    <label for="linkedin_link">LinkedIn</label>
                    <input type="text" class="form-control" id="linkedin_link" name='linkedin_link' placeholder="LinkedIn Link">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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
      $('#ccountry').on('change',function(){
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
            var $state = $('#cstate');
            for (var i = 0; i < json.length; i++) {
              $state.append('<option value=' + json[i].id + '>' + json[i].name + '</option>')
            }
            // $('#state').html(result);
            // $('#city').html('<option value="">Select State First!</option>');
          }
        });
      });
      $('#cstate').on('change',function(){
        var state_id = this.value;
        $.ajax({
          url: '<?= base_url('admin/getcities'); ?>',
          type: 'POST',
          data: {state_id:state_id},
          cached: false,
          success: function(result){
            var json = JSON.parse(result);
            var $cities = $('#ccity');
            for (var i = 0; i < json.length; i++) {
              $cities.append('<option value=' + json[i].id + '>' + json[i].name + '</option>');
            }
          }
        });
      });
      $('#companyForm').on('submit',function(){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
          url: '<?= base_url("admin/updatecompany/".$data[0]['id']); ?>',
          method: 'POST',
          data: formData,
          mimeType: "multipart/form-data",
          contentType: false,
          cache: false,
          dataType: false,
          processData: false,
          success: function(response){
            alert(response);
          }
        });
      });
    });
  </script>

<?php include(VIEWPATH.'admin/include/footer.php'); ?>
