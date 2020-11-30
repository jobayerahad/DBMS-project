<?php
include('layout/header.php');
Session::checkLogin();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $fm->validation($_POST['email']);
	$password = $fm->validation(md5($_POST['password']));

	if ($fm->isEmpty($email) || $fm->isEmpty($password)) {
		$msg = "Some fields are missing!";
	} else {
		$email = mysqli_real_escape_string($db->link, $email);
		$password = mysqli_real_escape_string($db->link, $password);

		$query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
		$result = $db->select($query);
		if ($result != false) {
			$value = mysqli_fetch_array($result);
			$row   = mysqli_num_rows($result);
			if ($row > 0) {
				$userId = $value['id'];
				Session::init();
				Session::set("login", true);
				Session::set("email", $value['email']);
				Session::set("userId", $userId);
				Session::set("permissionLevel", $value['permission_level']);

				$query = "SELECT id FROM author WHERE user_id = '$userId'";
				$result = $db->select($query);
				if ($result) {
					$authorData = mysqli_fetch_array($result);
					Session::set("authorId", $authorData['id']);
				}

				header("Location: dashboard.php");
			}
		} else {
			$msg = "Email or Password Didn't Matched";
		}
	}
}
?>
<div class="auth">
	<div class="row">
		<div class="col s1 m3 l4"></div>

		<div class="col s10 m6 l4 auth__container">
			<div class="auth__card">
				<h5 class="center grey-text text-darken-3">Login to <?php echo SITE_TITLE ?></h5>

				<form action="" class="auth__form" method="post">
					<div class="input-field grey-text text-darken-3">
						<i class="material-icons prefix">email</i>
						<input id="email" type="email" name="email" class="validate">
						<label for="email">Email</label>
					</div>

					<div class="input-field grey-text text-darken-3">
						<i class="material-icons prefix">lock</i>
						<input id="password" type="password" name="password" class="validate">
						<label for="password">Password</label>
					</div>

					<div class="center">
						<button class="btn btn-small waves-effect waves-light" type="submit" name="action">
							<i class="material-icons left">input</i> Login
						</button>
					</div>
				</form>

				<p class="center">Don't Have an account? <a href="signup.php" class="blue-text text-darken-2">Sign Up</a></p>

				<?php if (!$fm->isEmpty($msg)) { ?>
					<div class="alert card red grey-text text-lighten-5" id="alert_box">
						<?php echo $msg; ?> <i class="material-icons right" id="alert_close">close</i>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="col s1 m3 l4"></div>
	</div>
</div>
<?php include('layout/footer.php'); ?>