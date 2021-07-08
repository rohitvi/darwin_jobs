<?php include(VIEWPATH . 'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Change Company Info</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
      <div class="row job_main">
      <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
<div class=" job_main_right">
  <div class="row job_section">
    <div class="col-sm-12">
      <div class="jm_headings">
        <h5>Update My Company</h5>
        <a class="btn btn-primary mypbtn" href="<?= base_url('employer/profile') ?>">Personal profile</a>
      </div>
      <div class="section-divider">
      </div>
      <form action="<?= base_url('employer/cmp_info_update') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" />
        <div class="big_form_group">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Comapany Logo *</label>
                <input name="company_logo" type="file" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Company Name</label>
                <input name="company_name" type="text" class="form-control" placeholder="Enter Company Name" value="<?= (isset($data[0]['company_name'])) ? $data[0]['company_name'] : '' ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Company Email</label>
                <input name="email" type="email" class="form-control" placeholder="Enter Company Email" value="<?= $data[0]['email'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone No</label>
                <input name="phone_no" type="number" class="form-control" placeholder="Enter Phone Number" value="<?= $data[0]['phone_no'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Company Website</label>
                <input name="website" type="text" class="form-control" placeholder="Enter Company Website" value="<?= $data[0]['website'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label  >Category</label>
                <select name="category" class="form-control">
                  <option>Select Category</option>
                  <?php foreach($categories as $value) : 
                    if ($data[0]['category'] == $value['id']) : ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                  <?php else : ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                  <?php endif ;
                  endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Founded Date</label>
                <input name="founded_date" type="date" class="form-control" placeholder="Enter Founded Date" value="<?= $data[0]['founded_date'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Organization Type</label>
                <select name="org_type" class="form-control">
                  <option <?= ($data[0]['org_type'] == 'Public') ? 'selected' : '' ?>>Public</option>
                  <option <?= ($data[0]['org_type'] == 'Private') ? 'selected' : '' ?>>Private</option>
                  <option <?= ($data[0]['org_type'] == 'Government') ? 'selected' : '' ?>>Government</option>
                  <option <?= ($data[0]['org_type'] == 'Ngo') ? 'selected' : '' ?>>Ngo</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No. of Employers</label>
                <select name="no_of_employers" class="form-control select">
                  <option value="1-10" <?= ($data[0]['no_of_employers'] == '1-10') ? "selected" : " " ?>>1-10</option>
                  <option value="10-20" <?= ($data[0]['no_of_employers'] == '10-20') ? "selected" : " " ?>>10-20</option>
                  <option value="20-30" <?= ($data[0]['no_of_employers'] == '20-30') ? "selected" : " " ?>>20-30</option>
                  <option value="30-50" <?= ($data[0]['no_of_employers'] == '30-50') ? "selected" : " " ?>>30-50</option>
                  <option value="50-100" <?= ($data[0]['no_of_employers'] == '50-100') ? "selected" : " " ?>>50-100</option>
                  <option value="100+" <?= ($data[0]['no_of_employers'] == '100+') ? "selected" : " " ?>>100+</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Comapany Description</label>
                <input name="description" type="text" class="form-control" placeholder="Enter Company Description" value="<?= $data[0]['description'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Country</label>
                <select name="country" class="form-control">
                  <?php foreach($countries as $value) : 
                    if ($value['id'] == $data[0]['country']) : ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                  <?php else : ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                  <?php endif;
                endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>State</label>
                <?php
                  $states = get_country_states($data[0]['country']);
                  $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                  echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state" required');
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>City</label>
                <?php
                  $cities = get_state_cities($data[0]['state']);
                  $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                  echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city" required');
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pin Code</label>
                <input name="postcode" type="number" class="form-control" placeholder="Enter Pincode" value="<?= $data[0]['postcode'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Full Address</label>
                <input name="address" type="text" class="form-control" placeholder="Enter Adress" value="<?= $data[0]['address'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label>Facebook</label>
                <input name="facebook_link" type="text" class="form-control" placeholder="Enter Facebook Url" value="<?= $data[0]['facebook_link'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Twitter</label>
                <input name="twitter_link" type="text" class="form-control" placeholder="Enter Twitter Url" value="<?= $data[0]['twitter_link'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Youtube</label>
                <input name="youtube_link" type="text" class="form-control" placeholder="Enter Youtube Url" value="<?= $data[0]['youtube_link'] ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>LinkedIn</label>
                <input name="linkedin_link" type="text" class="form-control" placeholder="Enter LinkedIn" value="<?= $data[0]['linkedin_link'] ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>

      </form>
    </div>
  </div>


</div>
</div>
</div>
</div>
</main>



<?php include(VIEWPATH . 'employer/include/footer.php'); ?>

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
    });
  </script>