<?php include(VIEWPATH.'employer/include/header.php'); ?>

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
                <div class="col-xl-6">
                    <div class="user_elements_box">
                        <h4>Payment Method</h4>
                        <!-- Nav pills -->
                        <ul class="nav nav-pills" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#home">Credit Card/Debit Card</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu1">Paypal</a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div id="home" class="container tab-pane active">
                            <form action="<?= base_url('employer/payment') ?>" method="post">
                                <input type="hidden" name="payment_amount" value="<?= $data[0]['price'] ?>">
                                <input type="hidden" name="purchased_plan" value="<?= $data[0]['id'] ?>">
                                <input type="hidden" name="emp_id" value="<?= session('employer_id') ?>">
                                <input type="hidden" name="package_id" value="<?= $data[0]['id'] ?>">
                                <input type="hidden" name="package_days" value="<?= $data[0]['no_of_days'] ?>">
                                <div class="big_form_group">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group ">
                                        <label>Full Name On Card</label>
                                        <input type="text" name="fullname" class="form-control" placeholder="Enter full name on card">
                                      </div>
                                      <div class="form-group ">
                                        <label>Email</label>
                                        <input name="payer_email" type="email" class="form-control" placeholder="Enter Email">
                                      </div>
                                      <div class="form-group ">
                                        <label>Card number</label>
                                        <input name="card_no" type="number" class="form-control" placeholder="Enter Card Number">
                                      </div>
                                    </div>
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
                                        <div class="col-md-12 mt-3 text-right">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                  </div>
                                </div>                            
                              </form>
                          </div>
                          <div id="menu1" class="container tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>