<?php include(VIEWPATH . 'users/include/header.php'); ?>
<style>
 .tags li {
   font-size: 17px;
}
</style>
<div class="header_inner">
  <div class="header_btm">
    <h2>Jobs by Category</h2>
  </div>
</div>
</header>
<main>
    <div class="section status_section">
        <div class="container">
            <div class="row justify-content-center">
				<div class="col-md-12 single_job_main">
   <div class="row two_col featured_box_outer">
      <?php foreach ($categories as $category) : ?>
      <div class="col-sm-4">
	     <a href="<?= base_url('search?category=' . $category['category_id']); ?>">
         <div class="featured_box ">
            <div class="fb_image fn_45">
                <i class="<?= get_category_icon($category['category_id']) ?> mt_10"></i>
            </div>
            <div class="fb_content">
               <h4 class="fn_16"><?= get_category_name($category['category_id']); ?></h4>
               <ul class="tags">
                  <li><?= $category['total_jobs'] ?></li>
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
    </div>
</main>
<?php include(VIEWPATH . 'users/include/footer.php'); ?>