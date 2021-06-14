<?php include(VIEWPATH.'admin/include/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-6 py-2 my-2 px-2 div">
                <h3>Update Admin</h3>
            </div>
            <div class="col-6 text-right py-2 px-2 my-2 div">
                <button class="btn btn-light">Change Password</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3 div">
                <form action="<?= base_url('admin/account'); ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="mobileno" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include(VIEWPATH.'admin/include/footer.php'); ?>