<?php include(VIEWPATH.'employer/include/header.php'); ?>
<div class='header_inner '>
  <div class="header_btm">
    <h2>My Packages</h2>
  </div>
</div>
</header>

<main>
  <div class="job_container">
    <div class="container">
    <?php include(VIEWPATH . 'employer/include/profile_info.php'); ?>
      <div class="row job_main">
      <?php include(VIEWPATH . 'employer/include/sidebar.php'); ?>
        <div class=" job_main_right">
          <div class="row job_section">
            <div class="col-sm-12">
                <div class="jm_headings">
                  <h6>Your listings are shown in the table below.</h6>
                </div>
              <div class="table-cont">
              
                 <table class="table text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $value) : ?>
                            <tr>
                                <td><?= $value['id']; ?></td>
                                <td><?= $value['title']; ?></td>
                                <td><?= ($value['is_active'] == 1) ? "Active" : "Expired" ?></td>
                                <td><a type="button" href="<?= base_url('employer/my_package_details/'.$value['package_id']) ?>" class="btn-sm btn-primary">View</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
              </div>
            </div>
          </div>    
           
                    
        </div>
      </div>
    </div>
  </div>
</main>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>
