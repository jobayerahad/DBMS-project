<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
  Session::destroy();
}
$userId = Session::get("userId");
$permissionLevel = Session::get("permissionLevel");
$query = "SELECT name, photo FROM author WHERE user_id = '$userId'";
$result = $db->select($query);
if ($result) {
  $formValues = mysqli_fetch_array($result);
}
?>
<div class="sidebar hide-on-med-and-down">
  <div class="sidebar__user">
    <?php
    $img_url;
    if ($formValues) {
      $img_url = SITE_URL . $formValues['photo'];
    } else {
      $img_url = SITE_URL . "/assets/img/user.png";
    }
    ?>
    <img src="<?php echo $img_url; ?>" alt="<?php if ($formValues) echo $formValues['name'] ?>" />
    <h6 class="white-text center"><?php if ($formValues) echo $fm->nameShorten($formValues['name']) ?></h6>
  </div>

  <ul class="sidebar__list">
    <?php include("inc/navItems.php") ?>
  </ul>
</div>
