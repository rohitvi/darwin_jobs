<?php include(VIEWPATH . 'employer/include/header.php'); ?>

<div class='header_inner '>
    <div class="header_btm">
        <h2>Package Confirmation</h2>
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
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="widget-body">
                                        <div class="section-title mt-3 mb-3">
                                            <h4><?= $data[0]['title'] . ' ' . '(INR ' . $data[0]['price'] . ' / ' . $data[0]['title'] . ')' ?></h4>
                                        </div>
                                        <label>This package includes following features :</label>
                                        <br>
                                        <label>No of Posts : <?= $data[0]['no_of_posts'] ?></label>
                                        <br>
                                        <label>No of Days : <?= $data[0]['no_of_days'] ?></label>
                                        <br>
                                        <label>Details : <?= $data[0]['detail'] ?></label>
                                        <div class="section-title mt-3 mb-3">
                                            <h4>Total Due : INR <?= $data[0]['price'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <button type="button" class="btn btn-third btn-block" id="paynow">BUY NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include(VIEWPATH . 'employer/include/footer.php'); ?>
<?php $orderID = "OD" . strtoupper(uniqid()); ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $('#paynow').click(function() {
        $.ajax({
            url: '<?= base_url('employer/getPackageInfo') ?>',
            type: 'post',
            data: {
                package_id: '<?= $id ?>',
            },
            success: function(data) {
                const data = $.parseJSON(data);
                console.log(data);
                
            }
        });
    });
</script>