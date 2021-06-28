<?php include(VIEWPATH.'users/include/header.php'); ?>

<main>
  <div class="job_container">
    <div class="container">
      <div class="row job_main">
        <div class="sidebar">
          <ul class="user_navigation">
            <li>
              <a href="browse-jobs.html"><i class="fas fa-search"></i> Browse Jobs </a>
              <a class="filter_btn" href="#sidebar_filter_option"> 
                <i class="fas fa-filter"></i>
                <i class="fas fa-times"></i>
              </a>
            </li>
            <li>
            <form id="#sidebar_filter_option" class="filter_option">
              <div class="form-group">
                <label>Location</label>
                <div class="field">
                    <i class="fas fa-map-marker-alt"></i>
                    <select class="js-example-basic-single select2-hidden-accessible" name="state" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <option value="AL" data-select2-id="3">ALABAMA</option>
                      <option value="WY">WYOMING</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-dg-container"><span class="select2-selection__rendered" id="select2-state-dg-container" role="textbox" aria-readonly="true" title="ALABAMA">ALABAMA</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>  
              <div class="form-group">
                <label>Keywords</label>
                <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single select2-hidden-accessible" name="state" data-select2-id="4" tabindex="-1" aria-hidden="true">
                      <option value="AL" data-select2-id="6">e.g. job title</option>
                      <option value="WY">Title 1</option>
                      <option value="WY">Title 2</option>
                      <option value="WY">Title 3</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-cs-container"><span class="select2-selection__rendered" id="select2-state-cs-container" role="textbox" aria-readonly="true" title="e.g. job title">e.g. job title</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>
              
              <div class="form-group">
                <label>Category</label>
                <div class="field">
                    <i class="fas fa-briefcase"></i>
                    <select class="js-example-basic-single select2-hidden-accessible" name="state" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      <option data-select2-id="9">Admin Support</option>
                      <option>Customer Service</option>
                      <option>Data Analytics</option>
                      <option>Design &amp; Creative</option>
                      <option>Legal</option>
                      <option>Software Developing</option>
                      <option>IT &amp; Networking</option>
                      <option>Writing</option>
                      <option>Translation</option>
                      <option>Sales &amp; Marketing</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="8" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-8s-container"><span class="select2-selection__rendered" id="select2-state-8s-container" role="textbox" aria-readonly="true" title="Admin Support">Admin Support</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                </div>
              </div>

              <div class="form-group">
                <label>Salary</label>
                <div class="field">
                  <input type="text" placeholder="e.g. 10k" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label>Tags</label>
                <div class="field">
                  <div class="form-group custom_checkboxes">
                    <label class="custom_checkbox" for="tag-1">
                      <input type="checkbox" name="usertype" id="tag-1" value="job seeker">
                      <span><i class="fas fa-check"></i>PHP</span>
                    </label>
                    <label class="custom_checkbox" for="tag-2">
                      <input type="checkbox" name="usertype" id="tag-2" value="employer">
                      <span><i class="fas fa-check"></i> MySQL</span>
                    </label>
                    <label class="custom_checkbox" for="tag-3">
                      <input type="checkbox" name="usertype" id="tag-3" value="employer">
                      <span><i class="fas fa-check"></i> API</span>
                    </label>
                    <label class="custom_checkbox" for="tag-4">
                      <input type="checkbox" name="usertype" id="tag-4" value="employer">
                      <span><i class="fas fa-check"></i> react</span>
                    </label>
                    <label class="custom_checkbox" for="tag-5">
                      <input type="checkbox" name="usertype" id="tag-5" value="employer">
                      <span><i class="fas fa-check"></i> design</span>
                    </label>
                  </div>
                </div>
              </div>

            </form>
            </li>
            <li>
              <a href="job-seeker-dashboard.html">
                <i class="fas fa-border-all"></i> Job Dashboard
              </a>
            </li>
        </ul>
        <h5>Organize and Manage</h5>
        <ul class="user_navigation">
            <li>
              <a href="my-stared-jobs.html"><i class="fas fa-star"></i> View My Stared Jobs</a>
            </li>
        </ul>
        <h5>Account</h5>
        <ul class="user_navigation">    
            <li>
              <a href="edit-profile.html"><i class="fas fa-user"></i> Update My Profile</a>
            </li>
            <li class="is-active">
              <a href="edit-password.html"><i class="fas fa-key"></i>Change Password</a>
            </li>
            <li>
              <a href="edit-password.html"><i class="fas fa-power-off"></i> Logout</a>
            </li>
          </ul>
        </div>
        <div class=" job_main_right">
          <div class="row job_section">
          <div class="col-sm-12">
            <div class="jm_headings">
                <h5>Change Password</h5>
              </div>
              <div class="section-divider">
          </div>
          <form action="<?= base_url('home/change_password');?>" method="post">
                <div class="form-group row">
                  <div class="col-md-3">
                      <label for="current-password">Current password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="old_password" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="new-password">New password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="new_password" id="new-password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="confirm-new-password">Confirm new password</label>
                  </div>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="confirm_password" id="confirm-new-password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

<?php include(VIEWPATH.'users/include/footer.php'); ?>