<?php include(VIEWPATH.'employer/include/header.php'); ?>

<style>
.ccard {
    box-shadow: 0px 2px 4px 4px rgb(0 0 0 / 20%);
    transition: 0.3s;
}
.ccard input,.select {
    border:1px solid #2c304d;
}
</style>

                <!-- End Left Sidebar -->
                <!-- Begin Content -->
                <div class="content-inner profile">
                    <div class="container-fluid">
                        <!-- Begin Page Header-->
                        <div class="row">
                            <div class="page-header">
                                <div class="d-flex align-items-center">
                                    <h2 class="page-header-title">Add Candidates</h2>
                                    <div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url('employer/dashboard') ?>"><i class="ti ti-home"></i></a></li>
                                            <li class="breadcrumb-item active">Add Candidates</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- card start -->
<?php $attributes = array('id' => 'search_job', 'method' => 'post'); echo form_open('employers/search',$attributes);?>
<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow ccard">
            <div class="widget-body">
                   <div class='row'>
                        <div class='col-md-4'>
                        <input type="text" name='job_title' class='form-control' placeholder='what are you looking for?'>
                        </div>
                        <div class='col-md-4'>
                        <select name="category" class="form-control select">
	                        <option value="">Select Category</option>
	                            <?php foreach($categories as $category):?>
	                        <option value="<?= $category['id']; ?>"> <?= $category['name']; ?> </option>
	                            <?php endforeach; ?>
	                      </select>
                        </div>
                        <div class='col-md-4'>
                        <select name="country" class="form-control select">
	                        <option value="">Select Location</option>
	                        <?php foreach($countries as $country):?>
	                            <option value="<?= $country['id']; ?>"> <?= $country['name']; ?> </option>
	                        <?php endforeach; ?>
	                      </select>
                        </div>
                   </div> 

                   <div class='row'>
                        <div class='col-md-4'>
                                <select name="expected_salary" class="form-control select">
									<option value="">Expected Salary</option>
									<?php for($i=500; $i<10000; $i=$i+500){ ?>
											<option value="<?= $i; ?>"> <?= $i; ?> </option>
									<?php } ?>
								</select>
                        </div>
                        <div class='col-md-4'>
                        <select name="education_level" class="form-control select">
	                        <option value="">Select Education</option>
	                        <?php foreach($education as $education):?>
	                            <option value="<?= $education['id']; ?>"> <?= $education['type']; ?> </option>
	                        <?php endforeach; ?>
	                      </select>
                        </div>
                        <div class='col-md-4'>
                                <select name="experience" class="form-control select">
									<option value="">Select Experience</option>
									<option value="0-1">0-1 years</option>
									<option value="1-2">1-2 years</option>
									<option value="2-5">2-5 years</option>
									<option value="5-10">5-10 years</option>
									<option value="10-15">10-15 years</option>
									<option value="15+">15+ years</option>
								</select>
                        </div>
                   </div><br>
                   <div class='row'>
                        <div class='col-md-4'>
                        </div>
                        <div class='col-md-4'>
                        <input type="submit" name="search" class="btn btn-primary btn-block mb-2" value='Search'>
                        </div>
                        <div class='col-md-4'>
                        </div>
                   </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<!-- card end  -->



                    </div>
                </div>
                <script>
$(document).ready(function(){
  $("input").focus(function(){
    $(this).css("background-color", "#eae3e3");
  });
  $("input").blur(function(){
    $(this).css("background-color", "#ffffff");
  });
});
</script>
<?php include(VIEWPATH.'employer/include/footer.php'); ?>