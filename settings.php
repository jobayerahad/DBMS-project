<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

$msg = "";
$permissionLevel = Session::get("permissionLevel");
if ($permissionLevel < 3) {
  header("Location: dashboard.php");
}

if (isset($_GET['userId']) && isset($_GET['role'])) {
  $userId = $_GET['userId'];
  $role = $_GET['role'];
  $updateQuery = "UPDATE user set permission_level = '$role' WHERE id = $userId";
  $updateResult = $db->delete($updateQuery);
  if ($updateResult) {
    $msg = "User Role Updated";
  } else {
    $msg = "Something Went Wrong";
  }
}
?>

<div class="admin flex">
  <?php include('layout/sidenav.php') ?>

  <main class="admin__main">
    <?php
    $query = "SELECT id, email, permission_level, created_at FROM user";
    $user = $db->select($query);
    if ($user) { ?>
      <div class="card">
        <div class="card-content">
          <span class="card-title">User Role</span>

          <table class="striped responsive-table">
            <thead>
              <tr>
                <th class="blue-grey-text">#</th>
                <th class="blue-grey-text">User's Email</th>
                <th class="blue-grey-text">Joined</th>
                <th class="blue-grey-text">Role</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $i = 0;
              while ($result = $user->fetch_assoc()) {
                $i++;
              ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $result['email'] ?></td>
                  <td><?php echo date("d/m/Y, h:i A", strtotime($result['created_at'])) ?></td>
                  <td>
                    <a href="?userId=<?php echo $result['id'] ?>&role=1">
                      <input name="role<?php echo $result['id'] ?>" type="radio" <?php if ($result['permission_level'] == 1) echo "checked" ?> />
                      <span class="grey-text text-darken-2">Contributor</span>
                    </a>

                    <a href="?userId=<?php echo $result['id'] ?>&role=2">
                      <input name="role<?php echo $result['id'] ?>" type="radio" <?php if ($result['permission_level'] == 2) echo "checked" ?> />
                      <span class="grey-text text-darken-2">Editor</span>
                    </a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php } ?>
  </main>
</div>

<?php if (!$fm->isEmpty($msg)) { ?>
  <div class="alert card light-blue darken-2 grey-text text-lighten-5" id="alert_box">
    <i class="material-icons left">info</i><?php echo $msg ?><i class="material-icons right" id="alert_close">close</i>
  </div>
<?php } ?>

<?php include('layout/footer.php') ?>