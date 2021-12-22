<?php include(VIEWPATH . 'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Change Personal Info</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
        <div class="user_elements_box">
            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">Profile</a>
                </li>
                <li class="nav-item">
                <a class="nav-link">Company</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane fade active show">
                <h3>Profile</h3>
                <div class="container">
                <form action="<?= base_url('employer/setup/profile') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Profile Picture</label>
                        <input name="profile_picture" type="file" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group text-center">
                        <img src="<?= $data[0]['profile_picture'] ?>" alt="Company Logo" width="80px">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>First Name</label>
                        <input name="firstname" type="text" class="form-control" placeholder="Enter First Name" value="<?= $data[0]['firstname'] ?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Last Name</label>
                        <input name="lastname" type="text" class="form-control" placeholder="Enter Last Name" value="<?= $data[0]['lastname'] ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter Email" value="<?= $data[0]['email'] ?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Designation</label>
                        <input name="designation" type="text" class="form-control" placeholder="Enter Designation" value="<?= $data[0]['designation'] ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Phone Number</label>
                        <input name="mobile_no" type="number" class="form-control" placeholder="Enter phone Number" value="<?= $data[0]['mobile_no'] ?>" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Country</label>
                        <select id="country" name="country" class="form-control js-example-basic-single" required>
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
                      <div class="form-group ">
                        <label>State</label>
                        <?php
                          $states = get_country_states($data[0]['country']);
                          $options = array('' => 'Select State') + array_column($states, 'name', 'id');
                          echo form_dropdown('state', $options, $data[0]['state'], 'class="form-control select2bs4 state js-example-basic-single" required');
                        ?>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>City</label>
                        <?php
                          $cities = get_state_cities($data[0]['state']);
                          $options = array('' => 'Select City') + array_column($cities, 'name', 'id');
                          echo form_dropdown('city', $options, $data[0]['city'], 'class="form-control select2bs4 city js-example-basic-single" required');
                        ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label>Address</label>
                        <input name="address" type="text" class="form-control" placeholder="Enter Adress" value="<?= $data[0]['address'] ?>" required>
                      </div>
                    </div>

                    <div class="col-md-12 text-right">
                      <div class="form-group ">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>

                   </div> <!-- container end -->
                  </form>

                </div>

                </div>
                <div id="menu1" class="container tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
      $('#country').on('change', function() {
      var data = {country: this.value,}
      data[csfr_token_name] = csfr_token_value;
      $.ajax({
        url: '<?= base_url('home/get_country_states'); ?>',
        type: 'POST',
        data: data,
        dataType: 'json',
        cached: false,
        success: function(obj) {
          $('.state').html(obj.msg);
        }
      });
    });
    $('.state').on('change', function() {
      var data = {
        state: this.value,
      }
      data[csfr_token_name] = csfr_token_value;
      $.ajax({
        url: '<?= base_url('home/get_state_cities'); ?>',
        type: 'POST',
        data: data,
        dataType: 'json',
        cached: false,
        success: function(obj) {
          $('.city').html(obj.msg);
        }
      });
    });
    });

    $('.js-example-basic-single').select2();
  </script>