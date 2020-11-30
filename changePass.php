<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $currentPass = $fm->validation(md5($_POST['currentPass']));
  $newPass = $fm->validation(md5($_POST['newPass']));
  $confirmPass = $fm->validation(md5($_POST['confirmPass']));

  if ($fm->isEmpty($currentPass) || $fm->isEmpty($newPass) || $fm->isEmpty($confirmPass)) {
    $msg = "Some fields are missing!";
  } else if ($newPass != $confirmPass) {
    $msg = "New Password & Confirm Password Don't Match";
  } else {
    $userId = Session::get("userId");
    $selectQuery = "SELECT password FROM user WHERE id = '$userId'";
    $selectResult = $db->select($selectQuery);
    if ($selectResult) {
      $value = mysqli_fetch_array($selectResult);
      $realPass = $value['password'];

      if ($realPass == $currentPass) {
        $updateQuery = "UPDATE user SET password = '$newPass' WHERE id = '$userId'";
        $updateResult = $db->update($updateQuery);

        if ($updateResult) {
          Session::destroy();
        } else {
          $msg = "Something Went Wrong!";
        }
      } else {
        $msg = "Current Password Is Wrong!";
      }
    } else {
      $msg = "Something Went Wrong!";
    }
  }
}
?>
<div class="admin flex">
  <?php include('layout/sidenav.php') ?>

  <main class="admin__main">
    <form class="card" action="" method="POST">
      <div class="card-content">
        <span class="card-title mb-2">Change Password</span>

        <div class="input-field grey-text text-darken-3">
          <i class="material-icons prefix">lock</i>
          <input id="currentPass" type="password" class="validate" name="currentPass" required>
          <label for="currentPass">Current Password</label>
        </div>

        <div class="input-field grey-text text-darken-3">
          <i class="material-icons prefix">lock</i>
          <input id="newPass" type="password" class="validate" name="newPass" required>
          <label for="newPass">New Password</label>
        </div>

        <div class="input-field grey-text text-darken-3">
          <i class="material-icons prefix">lock</i>
          <input id="confirmPass" type="password" class="validate" name="confirmPass" required>
          <label for="confirmPass">Confirm Password</label>
        </div>
      </div>

      <div class="card-action">
        <button type="submit" class="waves-effect waves-light btn">
          <i class="material-icons left">lock_open</i>Update
        </button>
      </div>
    </form>
  </main>
</div>

<?php if (!$fm->isEmpty($msg)) { ?>
	<div class="alert card light-blue darken-2 grey-text text-lighten-5" id="alert_box">
		<i class="material-icons left">info</i><?php echo $msg ?><i class="material-icons right" id="alert_close">close</i>
	</div>
<?php } ?>

<?php include('layout/footer.php') ?>