<<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
    <h2>Jobs by Industry</h2>
  </div>
</div>
</header>
<main>
    <div class="section status_section">
        <div class="container">
            <div class="row justify-content-center">
                <?php foreach ($industries as $industry) : ?>
                    <div class="col-auto">
                        <div class="status_box" data-aos="fade-in" data-aos-delay="1000">
                            <a href="<?= base_url('search?industry=' . $industry['industry_id']); ?>">
                                <img alt="" data-aos="fade-up" data-aos-delay="1400" src="<?= base_url(); ?>/public/users/images/i-company.png">
                                <h3><?= $industry['total_jobs'] ?></h3>
                                <p><?= get_industry_name($industry['industry_id']); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>