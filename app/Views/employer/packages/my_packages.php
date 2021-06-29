<?php include(VIEWPATH.'employer/include/header.php'); ?>

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
                                <td><?= ($value['is_active'] == 1) ? "<button class='btn-sm btn-success'>Active</button>" : "<button class='btn-sm btn-secondary'>Deactivated</button>" ?></td>
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
