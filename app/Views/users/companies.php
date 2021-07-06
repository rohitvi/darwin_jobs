<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
    <div class="header_btm">
        <h2>Browse Companies</h2>
    </div>
</div>
</header>
<main>
    <div class="job_container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="letters-list">
                        <?php
                        $uri = new \CodeIgniter\HTTP\URI(current_url());
                        foreach (range('A', 'Z') as $char) { ?>
                            <a href="<?= base_url('home/companies/' . $char) ?>" class="<?= $uri->getSegment(4) == $char ? 'current' : '' ?>"><?= $char ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row company_names">
                <?php
                if (count($companies) > 0) :
                    foreach ($companies as $company) : ?>
                        <div class="col-md-3">
                            <div class="company_name_box">
                                <a href="<?= base_url('home/company_detail/' . $company['id']); ?>">
                                    <img alt="" src="<?= $company['company_logo']; ?>">
                                    <h3><?= $company['company_name']; ?></h3>
                                </a>
                            </div>
                        </div>
                    <?php endforeach;
                else : ?>
                    <div class="col-md-12 text-center">
                        <h3>No Company Found</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>