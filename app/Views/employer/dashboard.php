<?php include(VIEWPATH.'employer/include/header.php'); ?>
<div class='header_inner '>
  <div class="header_btm">
    <h2>Dashboard</h2>
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
                  <h4>Hello, <?= session('employer_username') ?> !</h4>
                </div>
                 <div class="dashboard_boxes row">

                      <div class="col-md-4">
                        <div class="dashboard_box ">
                          <i class="fas fa-paper-plane"></i>
                          <h2>Jobs Posted<span><?= $total_posted_jobs ?></span></h2>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="dashboard_box ">
                          <i class="fas fa-user-check"></i>
                          <h2>Job Seekers Applied <span><?= $job_seekers_applied ?></span></h2>
                        </div>
                      </div>
                      <?php  if(!empty($current_package)): ?>
                      <div class="col-md-4">
                        <div class="dashboard_box ">
                          <i class="fas fa-list"></i>
                          <h2>Featured Jobs Credits<span><?= ($current_package['price'] != 0)? $total_featured_jobs.'/'. $current_package['no_of_posts']: 0 ?></span> </h2>
                        </div>
                      </div> 

                      <div class="col-md-4">
                        <div class="dashboard_box ">
                          <i class="fas fa-list"></i>
                          <h2>Active Package<span><?= $current_package['title'] ?></span> </h2>
                          <p>Total No. of Posts (<?= $current_package['no_of_posts'] ?>)</p>
                        </div>
                      </div> 
                      <?php endif; ?>
               </div>
          </div>            
        </div>

      </div>
    </div>
  </div>
</main>



<?php include(VIEWPATH.'employer/include/footer.php'); ?>
