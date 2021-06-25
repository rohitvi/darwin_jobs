<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/user/noty/noty.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('public/user/css/custom.css'); ?>">
</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form id="register" action="" method="post">
				<input type="text" name="firstname" placeholder="Firstname" required />
				<input type="text" name="lastname" placeholder="Lastname" required />
				<input type="email" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password" required />
				<input type="password" name="cpassword" placeholder="Confirm Password" required />
				<input type="checkbox" class="check form-control" name="termsncondition" required>
				<span class="checkspan">Terms & Conditions</span>
				<button>Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="#" id="login" method="post">
				<h1>Sign in</h1>
				<div class="social-container">
					<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
					<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				</div>
				<span>or use your account</span>
				<input type="email" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password" required />
				<a href="#">Forgot your password?</a>
				<button>Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Create Account!</h1>
					<p>Enter your personal details and start journey with us</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Hello, Friend!</h1>
					<p>To stay connected with us please login with your personal info</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- Noty Js -->
<script src="<?= base_url('public/user/noty/noty.js')?>"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="<?= base_url(); ?>/public/user/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?= base_url(); ?>/public/user/js/popper.min.js"></script>
<script src="<?= base_url(); ?>/public/user/js/bootstrap.min.js"></script>
<script>
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});

	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
	$('#login').on('submit',function(){
        event.preventDefault();
		var fields = $('#login').serialize();
		$.ajax({
			url: "<?= base_url('login') ?>",
            method: "POST",
            data: fields,
            success: function(responses){
            	console.log(responses);
            	var response = responses.split('~');
            	if ($.trim(response[0]) == 0) {
                $('#login').trigger("reset");
	                new Noty({
	                    type: "error",
	                    layout: "topRight",
	                    text: response[1],
	                    progressBar: true,
	                    timeout: 2500,
	                    animation: {
	                        open: "animated bounceInRight",
	                        close: "animated bounceOutRight"
	                    }
	                }).show();
	              }
	              if ($.trim(responses[0]) == 1) {
	                $('#login').trigger("reset");
	                setTimeout(function() {
	                  window.location.href = 'home';
	                }, 500);
	                new Noty({
	                    type: "success",
	                    layout: "topRight",
	                    text: response[1],
	                    progressBar: true,
	                    timeout: 2500,
	                    animation: {
	                        open: "animated bounceInRight",
	                        close: "animated bounceOutRight"
	                    }
	                }).show();
              }
            }
		});
	});
	$('#register').on('submit',function(){
        event.preventDefault();
		var fields = $('#register').serialize();
		$.ajax({
			url: "<?= base_url('home/register') ?>",
            method: "POST",
            data: fields,
            success: function(responses){
            	console.log(responses);
            	return false;
            	var response = responses.split('~');
            	if ($.trim(response[0]) == 0) {
                $('#register').trigger("reset");
	                new Noty({
	                    type: "error",
	                    layout: "topRight",
	                    text: response[1],
	                    progressBar: true,
	                    timeout: 2500,
	                    animation: {
	                        open: "animated bounceInRight",
	                        close: "animated bounceOutRight"
	                    }
	                }).show();
	              }
	              if ($.trim(responses[0]) == 1) {
	                $('#register').trigger("reset");
	                setTimeout(function() {
	                  window.location.href = 'login';
	                }, 500);
	                new Noty({
	                    type: "success",
	                    layout: "topRight",
	                    text: response[1],
	                    progressBar: true,
	                    timeout: 2500,
	                    animation: {
	                        open: "animated bounceInRight",
	                        close: "animated bounceOutRight"
	                    }
	                }).show();
              }
            }
		});
	});
</script>
</html>