<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>My Package Details</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'employer/include/profile_info.php'); ?>
      <div class="row job_main">
      <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
                <div class="jm_headings">
                  <h6>Your listings are shown in the table below.</h6>
                </div>
              <div class="table-cont">
                <?php foreach($data as $value) : ?>
                <div class="staffBox">
                  <div class="staff_detail">
                    <div class="row">
                      <div class="col-lg-6">
                        <h3>Package Name: <?= $value['title']; ?></h3>
                        <p><?= $value['detail']; ?></p>
                      </div>
                      <div class="col-lg-6 text-right">
                        <p class="my-0">Purchased Date</p>
                        <p><?= date_time($value['buy_date']) ?></p>
                      </div>
                    </div>
                    <ul>
                      <li>
                        <h6>Number of Posts</h6>
                        <i class="fas fa-comment"></i>
                        <span><?= $value['no_of_posts'] ?> Posts</span>
                      </li>
                      <li>
                        <h6>Number of Days</h6>
                        <i class="fas fa-calendar-check"></i>
                        <span><?= $value['no_of_days'] ?> Days</span>
                      </li>
                      <li>
                        <h6>Price</h6>
                        <i class="fas fa-rupee-sign"></i>
                        <span><?= ($value['price'] == 0) ? 'Free' : $value['price'] ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <?php endforeach ; ?>
              </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>
