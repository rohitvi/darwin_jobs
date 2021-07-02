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
                  <h4>Hello, Donec Software !</h4>
                </div>
                 <div class="dashboard_boxes row">
                <div class="col-md-4">
                  <div class="dashboard_box ">
                    <i class="fas fa-paper-plane"></i>
                    <h2><span>18</span>Jobs Posted</h2>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="dashboard_box ">
                    <i class="fas fa-user-check"></i>
                    <h2><span>68</span>job Seekers Applied </h2>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="dashboard_box ">
                    <i class="fas fa-comments"></i>
                    <h2><span>28</span>Reviews </h2>
                  </div>
                </div>    
               </div>
          </div>    
           
                    
        </div>
      </div>
    </div>
  </div>
</main>



<?php include(VIEWPATH.'employer/include/footer.php'); ?>
