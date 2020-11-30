<?php
include('layout/header.php');
Session::checkLogin();

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $fm->validation($_POST['email']);
  $password = $fm->validation(md5($_POST['password']));
  $confirmPassword = $fm->validation(md5($_POST['confirm_password']));

  if ($fm->isEmpty($email) || $fm->isEmpty($password) || $fm->isEmpty($confirmPassword)) {
    $msg = "Some fields are missing!";
  } else {
    $email = mysqli_real_escape_string($db->link, $email);
    $password = mysqli_real_escape_string($db->link, $password);
    $confirmPassword = mysqli_real_escape_string($db->link, $confirmPassword);

    $slQuery = "SELECT 1 FROM user WHERE email = '$email'";
    $selectresult = $db->select($slQuery);

    if ($selectresult) {
      $msg = 'Email already exists';
    } elseif ($password != $confirmPassword) {
      $msg = "Passwords doesn't match";
    } else {
      $query = "INSERT INTO user(email, password, permission_level) VALUES ('$email', '$password', 1)";
      $result = $db->insert($query);
      if ($result) {
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = $db->select($query);
        if ($result != false) {
          $value = mysqli_fetch_array($result);
          $row   = mysqli_num_rows($result);
          if ($row > 0) {
            Session::init();
            Session::set("login", true);
            Session::set("email", $value['email']);
            Session::set("userId", $value['id']);
            Session::set("permissionLevel", $value['permission_level']);
            header("Location: dashboard.php");
          }
        }
      }
    }
  }
}
?>

<div class="auth">
  <div class="row">
    <div class="col s1 m3 l4"></div>

    <div class="col s10 m6 l4 auth__container">
      <div class="auth__card">
        <h5 class="center grey-text text-darken-3">Sign Up to <?php echo SITE_TITLE ?></h5>

        <form action="" class="auth__form" method="post">
          <div class="input-field grey-text text-darken-3">
            <i class="material-icons prefix">email</i>
            <input id="email" type="email" name="email" class="validate">
            <label for="email">Your Email</label>
          </div>

          <div class="input-field grey-text text-darken-3">
            <i class="material-icons prefix">lock</i>
            <input id="password" type="password" name="password" class="validate">
            <label for="password">New Password</label>
          </div>

          <div class="input-field grey-text text-darken-3">
            <i class="material-icons prefix">lock</i>
            <input id="confirm-password" type="password" name="confirm_password" class="validate">
            <label for="confirm-password">Confirm Password</label>
          </div>

          <div class="center">
            <button class="btn btn-small waves-effect waves-light" type="submit" name="action">
              <i class="material-icons left">input</i> Sign Up
            </button>
          </div>
        </form>

        <p class="center">Already have an account? <a href="login.php" class="blue-text text-darken-2">Login</a></p>
        <p class="grey-text center">*We welcome new user as contributor.</p>

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