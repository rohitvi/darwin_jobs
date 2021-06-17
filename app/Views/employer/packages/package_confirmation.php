<?php include(VIEWPATH.'employer/include/header.php'); ?>

<div class="content-inner">
    <div class="container-fluid">
        <!-- Begin Page Header-->
        <div class="row">
            <div class="page-header">
                <div class="d-flex align-items-center">
                    <h2 class="page-header-title">Package Confirmation</h2>
                    <div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('employer') ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item active">Package Confirmation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
<div class="row flex-row">
    <div class="col-xl-6">
        <div class="widget has-shadow conf">
            <div class="widget-body">
                <div class="section-title mt-3 mb-3">
                    <h4><?= $data[0]['title'].' '.'(INR '.$data[0]['price'].' / '.$data[0]['title'].')' ?></h4>
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
    </div>
    <div class="col-xl-6">
        <div class="widget has-shadow">
            <div class="widget-body">
            	<div class="section-title mt-3">
                	<h4>Payment Method</h4>
            	</div>
            	<div class="widget-body sliding-tabs">
                    <ul class="nav nav-tabs" id="example-one" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="base-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Credit Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="base-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="Paypal" aria-selected="false">Paypal</a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="base-tab-1">
                        	<form action="<?= base_url('employer/payment') ?>" method="post" class="needs-validation" novalidate>
                                <input type="hidden" name="payment_amount" value="<?= $data[0]['price'] ?>">
                                <input type="hidden" name="purchased_plan" value="<?= $data[0]['id'] ?>">
                                <input type="hidden" name="emp_id" value="<?= session('employer_id') ?>">
                                <input type="hidden" name="package_id" value="<?= $data[0]['id'] ?>">
                                <input type="hidden" name="package_days" value="<?= $data[0]['no_of_days'] ?>">
			                    <div class="form-group">
			                        <label class="form-control-label ml-1">Full Name (on the card)</label>
			                        <input type="text" class="form-control" name="fullname" required placeholder="Enter Full Card Name">
			                    </div>
			                    <div class="form-group">
			                        <label class="form-control-label ml-1">Email</label>
			                        <input type="email" class="form-control" name="payer_email" required placeholder="Enter Email Address">
			                    </div>
			                    <div class="form-group">
			                        <label class="form-control-label ml-1">Card Number</label>
			                        <input type="number" class="form-control" name="card_no" required placeholder="Enter Card Number">
			                    </div>
			                    <div class="form-group row">
			                        <div class="col-8">
			                        	<label class="form-control-label ml-1">Expiration</label>
			                        	<div class="input-group">
			                        		<input class="form-control mx-1" required type="number" name="mm" placeholder="MM">
			                        		<input class="form-control mx-1" required type="number" name="yy" placeholder="YY" >
			                        	</div>
			                        </div>
			                    	<div class="col-4">
			                        	<label class="form-control-label ml-1">CVV</label>
			                    		<input class="form-control" required type="number" name="cvv" placeholder="CVV" >
			                    	</div>
			                    </div>
			                    <div class="form-group">
			                    	<input type="submit" value="Submit" class="btn btn-primary" >
			                    </div>
			                </form>
                        </div>
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="base-tab-2">
                        	<p>Pay with your Paypal account.</p>
                        	<button class="btn btn-primary mb-3">Pay with Paypal</button>
                        	<p>System will take you to Paypal website for payment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
</div>
<!-- End Container -->
<?php include(VIEWPATH.'employer/include/footer.php'); ?>