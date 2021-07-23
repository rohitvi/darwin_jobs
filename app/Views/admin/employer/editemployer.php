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
                   <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email', $data[0]['eemail']) ?>">
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
                      <?php foreach($countries as $value) : 
                        if ($data[0]['ecountry'] == $value['id']) : ?>
                          <option value="<?= $value['id']; ?>" selected> <?= $value['name']; ?></option>
                        <?php else : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php endif; endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="state">State *</label>
                    <?php
                      $states = get_country_states($data[0]['country']);
                            $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                            echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state" required');
                        ?>
                  </div>
                  <div class="form-group">
                    <label for="city">City *</label>
                    <?php
                      $cities = get_state_cities($data[0]['state']);
                      $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                      echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city" required');
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="address">Address *</label>
                    <input type="text" class="form-control" id="address" name='address' placeholder="Address" value="<?= $data[0]['caddress'] ?>">
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
              <form id="companyForm" action="<?= base_url('admin/updatecompany/'.$data[0]['id']); ?>" method="post" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="form-group">
                            <label for="company_logo">Company Logo *  <?php if(!empty($data[0]['company_logo'])):?>
                            <img src="<?= $data[0]['company_logo']; ?>" class="company_logo" style="width:50px"><?php endif; ?></label>
                            <input type="file" class="form-control" id="company_logo" name='company_logo'>
                  </div>
                  <div class="form-group">
                    <label for="company_name">Company Name *</label>
                    <input type="text" class="form-control" id="company_name" value="<?= set_value('company_name', $data[0]['company_name']) ?>" name='company_name' placeholder="Enter Company Name">
                  </div>
                  <div class="form-group">
                    <label for="company_email">Company Email *</label>
                    <input type="email" class="form-control" id="company_email" name='company_email' value="<?= set_value('email', $data[0]['eemail']) ?>" placeholder="Enter Company Email">
                  </div>
                  <div class="form-group">
                    <label for="phone_no">Phone No. *</label>
                    <input type="text" class="form-control" id="phone_no" name='phone_no' value="<?= set_value('phone_no', $data[0]['phone_no']) ?>" placeholder="Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="website">Website *</label>
                    <input type="text" class="form-control" id="website" name='website' value="<?= set_value('website', $data[0]['website']) ?>" placeholder="Website">
                  </div>
                  <div class="form-group">
                    <label for="category">Category *</label>
                    <select class="form-control" id="category" name="category">
                      <option selected="selected">Select Category</option>
                      <?php
                        foreach($categories as $key => $value) : 
                           if ($data[0]['category'] == $value['id']) : ?>
                              <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                            <?php else : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php endif;
                    endforeach; ?>
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
                    <textarea class="form-control" id="description" name='description'><?= $data[0]['description'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="ccountry">Country *</label>
                    <select class="form-control" id="ccountry" name="country">
                      <option selected="selected">Select Country</option>
                      <?php foreach($countries as $value) : 
                        if ($data[0]['ccountry'] == $value['id']) : ?>
                          <option value="<?= $value['id']; ?>" selected> <?= $value['name']; ?></option>
                        <?php else : ?>
                          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                      <?php endif; endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="cstate">State *</label>
                    <?php
                      $states = get_country_states($data[0]['country']);
                            $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                            echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 cstate" required');
                        ?>
                  </div>
                  <div class="form-group">
                    <label for="ccity">City *</label>
                    <?php
                      $cities = get_state_cities($data[0]['state']);
                      $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                      echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 ccity" required');
                    ?>
                  </div>
                  <div class="form-group">
                    <label for="postcode">Pin Code *</label>
                    <input type="text" class="form-control" id="postcode" name='postcode' value="<?= set_value('postcode', $data[0]['postcode']) ?>" placeholder="Pin Code">
                  </div>
                  <div class="form-group">
                    <label for="full_address">Full Address *</label>
                    <input type="text" class="form-control" id="full_address" name='full_address' value="<?= $data[0]['eaddress'] ?>" placeholder="Full Address">
                  </div>
                  <div class="form-group">
                    <label for="facebook_link">Facebook</label>
                    <input type="text" class="form-control" id="facebook_link" name='facebook_link' value="<?= set_value('facebook_link', $data[0]['facebook_link']) ?>" placeholder="Facebook Link">
                  </div>
                  <div class="form-group">
                    <label for="twitter_link">Twitter</label>
                    <input type="text" class="form-control" id="twitter_link" name='twitter_link' value="<?= set_value('twitter_link', $data[0]['twitter_link']) ?>" placeholder="Twitter Link">
                  </div>
                  <div class="form-group">
                    <label for="youtube_link">Youtube</label>
                    <input type="text" class="form-control" id="youtube_link" name='youtube_link' value="<?= set_value('youtube_link', $data[0]['youtube_link']) ?>" placeholder="Youtube Link">
                  </div>
                  <div class="form-group">
                    <label for="linkedin_link">LinkedIn</label>
                    <input type="text" class="form-control" id="linkedin_link" name='linkedin_link' value="<?= set_value('linkedin_link', $data[0]['linkedin_link']) ?>" placeholder="LinkedIn Link">
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
    var csfr_token_name = '<?= csrf_token() ?>';
    var csfr_token_value = '<?= csrf_hash() ?>';
    $(document).ready(function(){
      $('#country').on('change',function(){
        var data = {country: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_country_states'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.state').html(obj.msg);
          }
        });
      });
      $('.state').on('change',function(){
        var data = {state: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_state_cities'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.city').html(obj.msg);
          }
        });
      });
      $('#ccountry').on('change',function(){
        var data = {country: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_country_states'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.cstate').html(obj.msg);
          }
        });
      });
      $('#cstate').on('change',function(){
        var data = {state: this.value,}
        data[csfr_token_name] = csfr_token_value;
        $.ajax({
          url: '<?= base_url('home/get_state_cities'); ?>',
          type: 'POST',
          data: data,
          dataType: 'json',
          cached: false,
          success: function(obj){
            $('.ccity').html(obj.msg);
          }
        });
      });
      // $('#companyForm').on('submit',function(){
      //   event.preventDefault();
      //   var formData = new FormData($(this)[0]);
      //   $.ajax({
      //     url: '<?= base_url("admin/updatecompany/".$data[0]['id']); ?>',
      //     method: 'POST',
      //     data: formData,
      //     mimeType: "multipart/form-data",
      //     contentType: false,
      //     cache: false,
      //     dataType: false,
      //     processData: false,
      //     success: function(response){
      //       alert(response);
      //     }
      //   });
      // });
    });
  </script>

<?php include(VIEWPATH.'admin/include/footer.php'); ?>
