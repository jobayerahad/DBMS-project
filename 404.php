<?php
include('layout/header.php');
include('layout/navbar.php');
?>

<div class="container">
	<div class="not-found">

		<div class="deep-orange-text">
			<h1>404</h1>
			<p>Page Not Found</p>
		</div>

		<a href="<?php echo SITE_URL ?>" class="waves-effect waves-light btn light-blue darken-2">
			<i class="material-icons left">arrow_back</i>Return to Homepage
		</a>

	</div>
</div>

<?php include('layout/footer.php') ?>