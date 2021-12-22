<?php include(VIEWPATH . 'users/include/header.php'); ?>
<style>
  .featured_box {
    padding: 20px;
}
</style>
<div class='header_inner '>
  <div class="header_btm">
    <h2>Applied Jobs</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'users/include/profile_info.php'); ?>
      <div class="row job_main">
        <?php include(VIEWPATH . 'users/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="jm_headings">
            <h5>Applied Jobs in list</h5>
          </div>
          <div class="row full_width featured_box_outer">
            <!-- single-job-content -->
            <?php if(!empty($data)) : 
            foreach ($data as $key => $value) : ?>
              <div class="col-sm-12 mb_5">
                <div class="featured_box ">
                  <div class="fb_image">
                    <img height="50" width="50" src="<?= get_company_logo($value['employer_id']) ?>" alt="">
                  </div>
                  <div class="fb_content">
                    <h4><?= $value['title'] ?></h4>
                    <ul>
                      <li><i class="fas fa-landmark"></i><?= get_company_name($value['company_id']) ?></li>
                      <li><i class="fas fa-map-marker-alt"></i><?= get_city_name($value['city']); ?>, <?= get_country_name($value['country']); ?></li>
                      <li><i class="far fa-clock"></i><?= time_ago($value['created_date']); ?></li>
                      <li>₹<?= $value['min_salary'] ?> - ₹<?= $value['max_salary'] ?></li>
                    </ul>
                  </div>
                  <div class="fb_action">
                    <!-- <a title="add to favourite" href="#"><i class="far fa-heart"></i></a> -->
                    <button class="alert alert-danger" disabled>Applied</button>
                    <!-- <a class="alert alert-danger" disabled href="#">Applied</a> -->
                  </div>
                </div>
              </div>
            <?php endforeach; 
            else : ?>
            <div class="col-sm-12 text-center">
              <p>No Applied Jobs.</p>
            </div>
            <?php endif ; ?>
            <!-- single-job-content -->

          </div>

          <div class="row two_col featured_box_outer">

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>