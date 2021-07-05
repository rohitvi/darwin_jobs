<?php include(VIEWPATH . 'users/include/header.php'); ?>
</div>
</header>
<main>
    <div class="section status_section">
        <div class="bg-v">
            <div class="bg-v-1 bg-t-r">
            </div>
            <div class="bg-v-2 bg-b-l">
            </div>
        </div>
        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="400" class="section_h">Jobs by Category</h2>

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