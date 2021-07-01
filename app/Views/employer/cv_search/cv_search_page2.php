<?php include(VIEWPATH.'employer/include/header.php'); ?>
<style>
.form-control{
    padding-left:27px;
}
#big_form_group{
  box-shadow: 2px 14px 14px 12px rgb(14 13 13 / 11%);
    padding-left: 20px;
}
</style>
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
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="2" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-ax-container"><span class="select2-selection__rendered" id="select2-state-ax-container" role="textbox" aria-readonly="true" title="ALABAMA">ALABAMA</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="5" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-s4-container"><span class="select2-selection__rendered" id="select2-state-s4-container" role="textbox" aria-readonly="true" title="e.g. job title">e.g. job title</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
                    </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="8" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-state-2u-container"><span class="select2-selection__rendered" id="select2-state-2u-container" role="textbox" aria-readonly="true" title="Admin Support">Admin Support</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
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
            <li class="is-active">
              <a href="edit-profile.html"><i class="fas fa-user"></i> Update My Profile</a>
            </li>
            <li>
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
                <h5>Search Candidates</h5>
              </div>
              <div class="section-divider">
              </div>
              <?php if(isset($_POST['search']) && empty($profiles)): ?>
            <p class="alert alert-danger" >Sorry, we could not find any profile for the keywords that you entered</p>
            <?php endif; ?>
              <form id='search' method='post'>
                <div class="big_form_group">
                  <div class="row">

                    <div class="col-md-4">
                            <div class="form-group">
                                <div class="field">
                                <i class="fa fa-search"></i>
                                <input type="text" name='job_title' class="form-control" placeholder='what are you looking for?'>
                                </div>
                            </div>
                    </div>

                    <div class="col-md-4">
                            <div class="form-group">
                                <div class="field">
                                <i class="fa fa-list"></i>
                                <select name="category" class="form-control select">
                                    <option value="">Select Category</option>
                                        <?php foreach($categories as $category):?>
                                    <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
                                        <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                    </div> 

                    <div class="col-md-4">
                            <div class="form-group">
                                <div class="field">
                                <i class="fas fa-map-marker-alt"></i>
                                <select name="country" class="form-control">
                                    <option value="">Select Location</option>
                                    <?php foreach($countries as $country):?>
                                    <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                    </div>  

                    <div class="col-md-4">
                          <div class="form-group">
                                <div class="field">
                                <i class="fas fa-money"></i>
                                <select name="expected_salary" class="form-control select">
									<option value="">Expected Salary</option>
									<?php for($i=500; $i<10000; $i=$i+500){ ?>
											<option value="<?= $i; ?>"> <?= $i; ?> </option>
									<?php } ?>
								</select>
                                </div>
                            </div>
                    </div>

                    <div class="col-md-4">
                            <div class="form-group">
                                <div class="field">
                                <i class="fas fa-user-graduate"></i>
                                    <select name="education_level" class="form-control select">
                                <option value="">Select Education</option>
                                <?php foreach($education as $education):?>
                                    <option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                                </div>
                            </div>
                    </div>

                    <div class="col-md-4">
                            <div class="form-group">
                                <div class="field">
                                <i class="fas fa-briefcase"></i>
                                <select name="experience" class="form-control select">
                                <option value="">Select Experience</option>
                                <option value="0-1">0-1 years</option>
                                <option value="1-2">1-2 years</option>
                                <option value="2-5">2-5 years</option>
                                <option value="5-10">5-10 years</option>
                                <option value="10-15">10-15 years</option>
                                <option value="15+">15+ years</option>
                              </select>
                                </div>
                            </div>
                    </div> 

                    <div class="col-md-4">
                    </div>

                    <div class="col-md-4">
                    <input type="submit" name="search" class="btn btn-primary btn-block mb-2" value='Search'>
                    </div>
                    <div class="col-md-4">
                    </div>
                  </div>
                </div>
              </form>   
          </div>
          </div>             

          <?php foreach ($profiles as $row): ?>
            <div id='big_form_group' class='big_form_group' >
              <div class="row"> 
                  <table>
                    <tr>
                    <td><h5><?= $row['firstname'].' '.$row['lastname']; ?></h5></td>

                      <td> <img src="<?= base_url('public/employer/assets/img/avatar/user.png')?>" height=60 alt=""></td>
                    </tr>
                    <tr>
                      <td><b>Job Title :&nbsp;&nbsp;&nbsp;</b><?= $row['job_title']; ?></td>
                    </tr>
                    <tr>
                    <td><b>Category :&nbsp;&nbsp;&nbsp;</b><?= get_category_name($row['category']); ?></td>
                    <td><i class="fas fa-briefcase"></i>&nbsp;&nbsp;&nbsp;<?= $row['experience']; ?> Years</td>
                    </tr>
                    <tr>
                    <td><b>Current Salary :</b>&nbsp;&nbsp;&nbsp;INR  <?= $row['current_salary']; ?></td>
                    <td><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;<?= get_city_name($row['city']).','. get_country_name($row['country']); ?></td>
                    </tr>
                    <tr>
                    <td><b>Expected Salary :</b>&nbsp;&nbsp;&nbsp;INR  <?= $row['current_salary']; ?></td>
                    <td><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;&nbsp;<b>Nationality :&nbsp;&nbsp;&nbsp;</b><?= get_country_name($row['nationality']); ?></td>
                    </tr>
                    <tr>
                    <td><b>Skills :</b>&nbsp;&nbsp;&nbsp;<?php  $skills = explode("," , $row['skills']);?>	<?php foreach($skills as $skill): ?><span class='tags'><a href="#"><?= $skill; ?></a></span><?php endforeach; ?></td>
                      <td><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;&nbsp;<?= get_education_level($row['education_level']); ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="<?= base_url('employer/candidates_shortlisted/'.$row['id']) ?>"><input type="submit" name="search" class="btn btn-primary btn-rounded" value="Shortlist"></a></td>
                    <td><input type="submit" name="search" class="btn btn-primary btn-rounded" value="Download CV"></td>
                    </tr>
                  </table>
                </div>  
            </div>
            <?php endforeach; ?>           

                    
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>

<script>
$('#search').on('submit',function(){
  event.preventDefault();
  var fields = $('#search').serialize();
  $.ajax({
    url: "<?=base_url('home/insert_user_experience');?>",
    method: "POST",
    data: fields,
    

  });
});
</script>