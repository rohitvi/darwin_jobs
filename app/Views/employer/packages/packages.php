<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class='header_inner '>
  <div class="header_btm">
    <h2>Packages</h2>
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
                    <div class="container-fluid">
                        <h2 data-aos="fade-up" data-aos-delay="200" class="section_h">Membership Plans</h2>
                            <div class="row">
                                <?php foreach($data as $value) : ?>
                                <div class="col-md-4 my-3">
                                    <div class="plan_box" data-aos="fade-up" data-aos-delay="400">
                                        <h3><?= $value['title']; ?></h3>
                                        <p><?= $value['detail']; ?></p>
                                        <div class="plan_price pl-monthly">
                                            <h4><strong>₹ <?= $value['price']; ?></strong></h4>
                                        </div>
                                        <h5>Features of <?= $value['title']; ?> Plan</h5>
                                        <ul>
                                            <li><i class="fas fa-check"></i> Number of Post : <?= $value['no_of_posts']; ?></li>
                                            <li><i class="fas fa-check"></i> Number of Days : <?= $value['no_of_days']; ?></li>
                                            <li><i class="fas fa-check"></i> Highlighted in Search Results</li>
                                            <li><i class="fas fa-check"></i>Fraud protection</li>
                                            <li><i class="fas fa-check"></i>Featured Listing</li>
                                        </ul>
                                        <a class="btn btn-third" type="button" href="<?= base_url('employer/package_confirmation/'.$value['id']) ?>" <?= ($value['price'] == 0) ? 'disabled' : '' ?>>Buy Now</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>
