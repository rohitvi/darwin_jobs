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

        <!-- tab start -->
        <div class="user_elements_box">
            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
              <li class="nav-item">
                <a class="nav-link">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#mycompany">Company</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div id="home" class="container tab-pane ">
                <h3>HOME</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div>
              <div id="mycompany" class="container tab-pane active">
                <h3>Company</h3>
                <div class="container">
                <form action="<?= base_url('employer/setup/company') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label>Comapany Logo *</label>
                                <input name="company_logo" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <img src="<?= $data[0]['company_logo'] ?>" alt="Profile Photo" width="100px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input name="company_name" type="text" class="form-control" placeholder="Enter Company Name" value="<?= (isset($data[0]['company_name'])) ? $data[0]['company_name'] : '' ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Email</label>
                                <input name="email" type="email" class="form-control" placeholder="Enter Company Email" value="<?= $data[0]['email'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Website</label>
                                <input name="website" type="text" class="form-control" placeholder="Enter Company Website" value="<?= $data[0]['website'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control js-example-basic-single" required>
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
                                <input name="founded_date" type="date" class="form-control" placeholder="Enter Founded Date" value="<?= $data[0]['founded_date'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Organization Type</label>
                                <select name="org_type" class="form-control js-example-basic-single" required>
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
                                <select name="no_of_employers" class="form-control select js-example-basic-single" required>
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
                            <input name="description" type="text" class="form-control" placeholder="Enter Company Description" value="<?= $data[0]['description'] ?>" required>
                        </div>
                        </div>
                        <div class="col-md-6 text-right mt-3">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </div> <!-- row end -->
                    </form><!-- form end -->
                </div>
              </div>
            </div>
          </div>
        <!-- tab end -->

        </div>
    </div>
</main>
<?php include(VIEWPATH . 'employer/include/footer.php'); ?>
<script>
    $('.js-example-basic-single').select2();
  </script>