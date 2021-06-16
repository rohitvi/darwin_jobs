<?php include(VIEWPATH.'employer/include/header.php'); ?>

                <div class="content-inner">
                    <div class="container-fluid">
                        <!-- Begin Page Header-->
                        <div class="row">
                            <div class="page-header">
	                            <div class="d-flex align-items-center">
	                                <h2 class="page-header-title">Personal Information</h2>
	                                <div>
			                            <ul class="breadcrumb">
			                                <li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
			                                <li class="breadcrumb-item"><a href="#">Employer</a></li>
			                                <li class="breadcrumb-item active">Personal Information</li>
			                            </ul>
	                                </div>
	                            </div>
                            </div>
                        </div>
                        <!-- End Page Header -->
                        <div class="row flex-row">
                            <div class="col-12">
                                <!-- Form -->
                                <div class="widget has-shadow">
                                    <div class="widget-header bordered no-actions d-flex align-items-center">
                                        <h4>All Elements</h4>
                                    </div>
                                    <div class="widget-body">
                                    <form action="">

                                            <label for=""><b>Profile Picture</b></label>
                                            <input type="file" class='form-control'>

                                            <div class='row'>
                                                <div class='col-md-6'>
                                                    <div class="form-group">
                                                    <label for=""><b>First Name</b></label>
                                                    <input type="text" class="form-control" id="email" name="fname">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>Email</b></label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>Phone Number</b></label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>State  </b></label>
                                                    <select name="country" class="country form-control">
                                                    <option>hi</option>
                                                    </select>
                                                    </div>

                                                </div>

                                                <div class='col-md-6'>
                                                    <div class="form-group">
                                                    <label for=""><b>Last Name</b></label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>Designation </b></label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>Country  </b></label>
                                                    <select name="country" class="country form-control">
                                                    <option>hi</option>
                                                    </select>
                                                    </div>

                                                    <div class="form-group">
                                                    <label for=""><b>City  </b></label>
                                                    <select name="country" class="country form-control">
                                                    <option>hi</option>
                                                    </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <label for=""><b>Address</b></label>
                                            <input type="text" class='form-control'>

                                     </form>
                                    </div>
                                </div>
                                <!-- End Form -->
                                <button type="button" class="btn btn-info btn-square">Update</button>

                            </div>
                        </div>
                        <!-- End Row -->
                    </div>

<?php include(VIEWPATH.'employer/include/footer.php'); ?>