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
            success: function(package) {
                const NewPackage = $.parseJSON(package);
                console.log(NewPackage);
                var options = {
                    "key": "<?= get_g_setting_val('razorpay_key'); ?>",
                    "amount": data.price * 100,
                    "name": <?= get_g_setting_val('application_name'); ?>,
                    "description": data.title,
                    "image": <?= get_g_setting_val('logo'); ?>,
                    "handler": function(response) {
                        if (response != '') {
                            var payid = response.razorpay_payment_id;
                            $.ajax({
                                url: '<?= base_url('employer/process_payment') ?>',
                                type: 'POST',
                                data: {
                                    package_id: '<?= $id ?>',
                                    payid: payid
                                },
                                beforeSend: function() {
                                    swal({
                                        title: 'Dont click back button Transaction in process...',
                                        allowEscapeKey: false,
                                        allowOutsideClick: false,
                                        buttons: false
                                    });
                                    $('#paynow').text('Please Wait..');

                                    document.getElementById("shares").readOnly = true;
                                    document.getElementById("paynow").disabled = true;
                                },
                                success: function(data) {
                                    if (data == 1) {
                                        swal.close();
                                        swal({
                                            title: "Purchased Successfully",
                                            text: "Payment has been received, Product(s) will be allocated to you within 2 business days.",
                                            type: "success",
                                        }).then(function() {
                                            location.reload();
                                        });
                                    } else if (daat == 2) {
                                        alert("Sorry! something went wrong");
                                    }
                                }
                            });
                        }
                    },
                    "prefill": {
                        "name": '<?= get_direct_value('employers', 'firstname', 'id', session('employer_id')) . ' ' . get_direct_value('employers', 'lastname', 'id', session('employer_id')) ?>',
                        "email": '<?= get_direct_value('employers', 'email', 'id', session('employer_id')) ?>',
                        "contact": '<?= get_direct_value('employers', 'mobile_no', 'id', session('employer_id')) ?>'
                    },
                    "theme": {
                        "color": "#15b8f3" // screen color
                    }
                };
                console.log(options);
                var propay = new Razorpay(options);
                propay.open();
            }
        });
    });
</script>