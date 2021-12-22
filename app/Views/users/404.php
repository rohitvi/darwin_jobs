<?php
if (session('employer_logged_in')) {
    include(VIEWPATH . 'employer/include/header.php');
} else {
    include(VIEWPATH.'users/include/header.php');
}
?>
</header>
<main>
	<div class="fzf_page header_btm">
		<div class="container">
			<div class="d-flexd align-items-centerd fzf_cont ">
				<div>
					<h1>404</h1>
					<p>We've noticed you're lost your way, not to worry though,<br>
					<b>we can help you find your next opportunity</b></p>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
if (session('employer_logged_in')) {
    include(VIEWPATH . 'employer/include/footer.php');
} else {
    include(VIEWPATH.'users/include/footer.php');
}
?>