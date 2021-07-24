<?php include(VIEWPATH.'admin/include/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4>Personal Details</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>Full Name : <?= $query["firstname"] ?> <?= $query["lastname"] ?></p>
                                <hr>
                                <p>Email : <?= $query["email"] ?></p>
                                <hr>
                                <p>Phone : <?= $query["mobile_no"] ?></p>
                                <hr>
                                <p>Date Of Birth : <?= $query["dob"] ?></p>
                                <hr>
                                <p>Category : <?= get_category_name($query["category"]) ?></p>
                                <hr>
                                <p>User Job Title : <?= $query["job_title"]  ?></p>
                                <hr>
                                <p>Experience : <?= $query["experience"] ?> years</p>
                                <hr>
                                <p>Skills : <?= $query["skills"] ?></p>
                                <hr>
                                <p>Current Salary (INR) : <?= $query["current_salary"] ?> (INR)</p>
                                <hr>
                                <p>Country : <?= (isset($query["country"])) ? get_country_name($query["country"]) : '' ?></p>
                                <hr>
                                <p>City / Town : <?= get_city_name($query["city"]) ?></p>
                                <hr>
                                <p>Postcode : <?= $query["postcode"] ?></p>
                                <hr>
                                <p>Address : <?= $query["address"] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($education)) : ?>
                    <div class="col-lg-6">
                        <h4>Education</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p><?= (isset($education["type"])) ? $education["type"] : '' ?>  <?= (isset($education["degree_title"])) ? $education["degree_title"] : '' ?></p>
                                <hr>
                                <p><?= (isset($education["institution"])) ? $education["institution"] : '' ?></p>
                                <hr>
                                <p><?= (isset($education["completion_year"])) ? $education["completion_year"] : '' ?></p> 
                                <hr>
                                <h4>Experience</h4>
                                <hr>
                                <p><?= (isset($experience["job_title"])) ? $experience["job_title"] : '' ?></p>
                                <hr>
                                <p><?= (isset($experience["company"])) ? $experience["company"] : '' ?></p>
                                <hr>
                                <p><?= (isset($experience["starting_month"])) ? get_month($experience["starting_month"]) : '' ?> <?= (isset($experience["starting_year"])) ? $experience["starting_year"] : '' ?> - <?= (isset($experience["ending_month"])) ? get_month($experience["ending_month"]) : '' ?> <?= (isset($experience["ending_year"])) ? $experience["ending_year"] : '' ?> | <?= (isset($experience["country"])) ? get_country_name($experience["country"]) : '' ?></p>
                                <hr>
                                <p><?= (isset($experience["job_title"])) ? $experience["job_title"] : '' ?></p>
                                <hr>
                                <p><?= (isset($experience["description"])) ? $experience["description"] : '' ?></p>
                                <hr>
                                <h4>Languages</h4>
                                <hr>
                                <p><?= (isset($language["lang_name"])) ? $language["lang_name"] : '' ?></p>
                                <hr>
                                <h4>Resume</h4>
                                <a href="<?= $query["resume"] ?>" class="btn-sm btn-primary"><i class="nav-icon fas fa fa-download"></i> Download CV</a>
               
                            </div>
                        </div>
                    </div>
                    <?php else : ?>
                        <div class="col-lg-6">
                            <h4>Education</h4>
                            <p>No Data.</p>
                            <h4>Experience</h4>
                            <p>No Data.</p>
                            <h4>Languages</h4>
                            <p>No Data.</p>
                            <h4>Resume</h4>
                            <p>No Data.</p>
                        </div>
                    <?php endif ; ?>
                </div>

            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include(VIEWPATH.'admin/include/footer.php'); ?>
