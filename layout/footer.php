		<?php $isLoggedIn = Session::get("login"); ?>

		<div id="slide-out" class="sidebar sidenav">
			<?php
			if ($isLoggedIn) {
				$userId = Session::get("userId");
				$permissionLevel = Session::get("permissionLevel");
				$query = "SELECT name, photo FROM author WHERE user_id = '$userId'";
				$result = $db->select($query);
				if ($result) {
					$formValues = mysqli_fetch_array($result);
				}
				$img_url;
				if ($formValues) {
					$img_url = SITE_URL . $formValues['photo'];
				} else {
					$img_url = SITE_URL . "/assets/img/user.png";
				}
			?>
				<div class="sidebar__user">
					<img src="<?php echo $img_url; ?>" alt="<?php if ($formValues) echo $formValues['name'] ?>" />
					<h6 class="white-text center"><?php if ($formValues) echo $fm->nameShorten($formValues['name']) ?></h6>
				</div>
			<?php } ?>

			<ul class="sidebar__list">
				<li class="sidebar__item">
					<a href="<?php echo SITE_URL . "dashboard.php" ?>">
						<i class="material-icons left">view_module</i>Dashboard
					</a>
				</li>

				<li class="sidebar__item">
					<a href="<?php echo SITE_URL . "about-us.php" ?>">
						<i class="material-icons left">people</i>Authors
					</a>
				</li>

				<?php if ($isLoggedIn) {
					include("inc/navItems.php");
				} ?>
			</ul>
		</div>

		<footer class="page-footer blue-grey darken-3">
			<div class="footer-copyright">
				<div class="center container">
					&copy; Copyright <?php echo date("Y") ?>
					<a href="<?php echo SITE_URL ?>"><?php echo SITE_TITLE ?></a>
				</div>
			</div>

			<!-- jQuery CDN -->
			<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
			<!-- Compiled and minified JavaScript -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
			<!-- Owl Carousel -->
			<script src="<?php echo SITE_URL . "assets/js/owl.carousel.min.js" ?>"></script>
			<!-- Materialize Config JS -->
			<script src="<?php echo SITE_URL . "assets/js/config.js" ?>"></script>
		</footer>
		</body>

		</html>