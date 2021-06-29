<?php include(VIEWPATH.'employer/include/header.php'); ?>

        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
                <div class="jm_headings">
                  <h6>Your listings are shown in the table below.</h6>
                </div>
              <div class="table-cont">
                <?php foreach($data as $value) : ?>
                <div class="staffBox">
                  <div class="staff_detail">
                    <h3>Package Name: <?= $value['title']; ?></h3>
                    <p><?= $value['detail']; ?></p>
                    <ul>
                      <li>
                        <h6>Number of Posts</h6>
                        <i class="fas fa-comment"></i>
                        <span><?= $value['no_of_posts'] ?> Posts</span>
                      </li>
                      <li>
                        <h6>Number of Days</h6>
                        <i class="fas fa-calendar-check"></i>
                        <span><?= $value['no_of_days'] ?> Days</span>
                      </li>
                      <li>
                        <h6>Price</h6>
                        <i class="fas fa-rupee-sign"></i>
                        <span><?= ($value['price'] == 0) ? 'Free' : '' ?></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <?php endforeach ; ?>
              </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>
