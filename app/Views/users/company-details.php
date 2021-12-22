<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
    <div class="header_btm header_job_single">
        <div class="header_job_single_inner container">
            <div class="poster_company">
                <img alt="brand logo" src="<?= $company_info[0]['company_logo']; ?>">
            </div>
            <div class="poster_details">
                <h2><?= $company_info[0]['company_name']; ?> <span class="varified"><i class="fas fa-check"></i>Verified</span></h2>
                <h5>About Company</h5>
                <ul>
                    <li>
                        <i class="fas fa-building"></i>
                        <?= get_category_name($company_info[0]['category']); ?>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <?= get_city_name($company_info[0]['city']); ?>, <?= get_country_name($company_info[0]['country']); ?>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <?= $company_info[0]['address']; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</header>
<main>
    <div class="single_job">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row ">
                        <div class="col-md-12 single_job_main">
                            <h2>About Company</h2>
                            <?= $company_info[0]['description']; ?>
                        </div>
                        <div class="section-divider"></div>
                        <div class="col-md-12 single_job_main">
                            <h2>Location</h2>
                            <iframe class="full-width-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3428.916507434128!2d76.78322631470263!3d30.748846681631466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed76ab9f14c1%3A0xd6362b158b8994aa!2sEiffel%20Tower%20Replica!5e0!3m2!1sen!2sin!4v1581932177674!5m2!1sen!2sin" height="300" allowfullscreen=""></iframe>
                        </div>
                        <?php if (!empty($jobs)) : ?>
                            <div class="section-divider"></div>
                            <div class="col-md-12 single_job_main">
                                <h2> Open Positions</h2>
                                <div class="row two_col featured_box_outer">
                                    <?php foreach ($jobs as $key => $value) : ?>
                                        <div class="col-sm-6">
                                            <div class="featured_box ">
                                                <div class="fb_image">
                                                    <img alt="brand logo" src="<?= $value['company_logo']; ?>">
                                                </div>
                                                <div class="fb_content">
                                                    <h4><?= $value['title'] ?></h4>
                                                    <ul>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fas fa-landmark"></i>
                                                                Magna Aliqua
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fas fa-map-marker-alt"></i>
                                                                <?= get_city_name($value['city']); ?>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="far fa-clock"></i>
                                                                <?= time_ago($value['created_date']); ?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="fb_action">
                                                    <a title="add to favourite" onclick="save(<?= $value['id'] ?>)"><i id="save<?= $value['id'] ?>" style="cursor:pointer; color:#ff6158;" class="<?= (in_array($value['id'], $saved_job)) ? 'fas fa-heart' : 'far fa-heart' ?>"></i></a>
                                                    <a class="btn btn-primary" href="<?= base_url('home/jobdetails/' . $value['id']) ?>">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>
<script>
    function save(id) {
        event.preventDefault();
        var data = {
            job_id: id
        };
        $.ajax({
            url: '<?= base_url('home/save_job') ?>',
            method: 'POST',
            data: data,
            success: function(response) {
                $("#save" + id).toggleClass("fas far");
            }
        });
    }
</script>