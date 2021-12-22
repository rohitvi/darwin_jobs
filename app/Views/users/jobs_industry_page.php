<?php include(VIEWPATH . 'users/include/header.php'); ?>
<div class='header_inner'>
  <div class="header_btm">
    <h2>Jobs by Industry</h2>
  </div>
</div>
</header>
<main>
    <div class="section status_section">
        <div class="container">

			<div class="col-md-12 single_job_main">
   <div class="row two_col featured_box_outer">
      <?php foreach ($industries as $industry) : ?>
      <div class="col-sm-4">
         <a href="<?= base_url('search?industry=' . $industry['industry_id']); ?>">
            <div class="featured_box ">
               <div class="fb_image">
                  <img class="mt_10" alt="brand logo" src="<?= base_url(); ?>/public/users/images/i-company.png">
               </div>
               <div class="fb_content">
                  <h4><?= get_industry_name($industry['industry_id']); ?></h4>
                  <ul class="tags">
                     <li><?= $industry['total_jobs'] ?></li>
                  </ul>
               </div>
            </div>
         </a>
      </div>
      <?php endforeach; ?>						
   </div>
</div>
        </div>
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>