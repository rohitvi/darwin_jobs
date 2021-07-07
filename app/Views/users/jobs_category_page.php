<<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
    <h2>Jobs by Category</h2>
  </div>
</div>
</header>
<main>
    <div class="section status_section">
        <div class="container">
            <div class="row justify-content-center">
                <?php foreach ($categories as $category) : ?>
                    <div class="col-auto">
                        <div class="status_box" data-aos="fade-in" data-aos-delay="1000">
                            <a href="<?= base_url('search?category=' . $category['category_id']); ?>">
                                <img alt="" data-aos="fade-up" data-aos-delay="1400" src="<?= base_url(); ?>/public/users/images/i-company.png">
                                <h3><?= $category['total_jobs'] ?></h3>
                                <p><?= get_category_name($category['category_id']); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>