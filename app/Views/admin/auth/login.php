<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= get_g_setting_val('application_name') ?> | Admin Log in</title>
  <link rel="shortcut icon" href="<?= get_g_setting_val('favicon') ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/admin/dist/css/adminlte.min.css') ?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('public/admin/plugins/toastr/toastr.min.css') ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <b class="h1"><?= get_g_setting_val('application_name') ?></b>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="<?= base_url('admin/login'); ?>" method="post" id="sign_in">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-7">
              <p class="mb-1">
                <a href="<?= base_url('admin/forgot_password') ?>">I forgot my password</a>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-5">
              <button type="submit" class="btn btn-primary btn-block sign-in">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('public/admin/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('public/admin/dist/js/adminlte.min.js') ?>"></script>
  <!-- Toastr -->
  <script src="<?= base_url('public/admin/plugins/toastr/toastr.min.js') ?>"></script>
  <script type="text/javascript">
    $("#sign_in").on("submit", function() {
      event.preventDefault();
      var fields = $('form').serialize();
      // console.log(fields);
      $.ajax({
        url: "<?= base_url('admin/login') ?>",
        method: "POST",
        data: fields,
        success: function(responses) {
          var response = responses.split('~');
          if ($.trim(response[0]) == 0) {
            $('#sign_in').trigger("reset");
            toastr.error(response[1]);
          }
          if ($.trim(response[0]) == 1) {
            $('#sign_in').trigger("reset");
            setTimeout(function() {
              window.location.href = 'dashboard';
            }, 500);
            toastr.success(response[1]);
          }
          if ($.trim(response[0]) == 2) {
            toastr.error(response[1]);
          }
          $('.sign-in').html("Sign In");
        },
        beforeSend: function() {
          $('.sign-in').html("Validating...");
        },
        error: function(jqXHR, exception) {
          $('.sign-in').html("Sign In");
          console.log(jqXHR);
        }
      });
    });
  </script>
  <script type="text/javascript">
    <?= (session()->getFlashdata('success')) ? "toastr.success('" . session()->getFlashdata('success') . "')" : '' ?>
    <?= (session()->getFlashdata('error')) ? "toastr.error('" . session()->getFlashdata('error') . "')" : '' ?>
  </script>
</body>

</html>