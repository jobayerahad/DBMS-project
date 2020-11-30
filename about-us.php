<?php include('layout/header.php');?>

<div class="container">
	<div class="row">
		<?php
		$query = "SELECT * FROM author";
		$authors = $db->select($query);
		if ($authors) { ?>
			<h4 class="center">Our Authors</h4>
			<div class="row">
				<?php
				while ($result = $authors->fetch_assoc()) {
				?>
					<div class="col s12 m6 l4 xl3">
						<div class="card hoverable">
							<div class="card-image">
								<img src="<?php echo SITE_URL . $result['photo'] ?>">
								<span class="card-title"><?php echo $result['name'] ?></span>
							</div>

							<div class="card-content">
								<p><?php echo $result['bio'] ?></p>
							</div>
						</div>
					</div>
				<?php
				} ?>
			</div>
		<?php
		} else { ?>
			<h3 class="center">No Author Found!</h3>
		<?php }
		?>
	</div>

</div>

<?php include('layout/footer.php') ?>