<?php $permissionLevel = Session::get("permissionLevel"); ?>

<li class="sidebar__item">
  <a href="<?php echo SITE_URL . "postlist.php" ?>">
    <i class="material-icons left">assessment</i> Posts
  </a>
</li>

<li class="sidebar__item">
  <a href="<?php echo SITE_URL . "catlist.php" ?>">
    <i class="material-icons left">featured_play_list</i> Categories
  </a>
</li>

<li class="sidebar__item">
  <a href="<?php echo SITE_URL . "profile.php" ?>">
    <i class="material-icons left">account_circle</i> Profile
  </a>
</li>

<li class="sidebar__item">
  <a href="<?php echo SITE_URL . "changePass.php" ?>">
    <i class="material-icons left">lock</i> Change Password
  </a>
</li>

<?php if ($permissionLevel >= 3) { ?>
  <li class="sidebar__item">
    <a href="<?php echo SITE_URL . "settings.php" ?>">
      <i class="material-icons left">settings</i> Settings
    </a>
  </li>
<?php } ?>

<li class="sidebar__item">
  <a href="?action=logout">
    <i class="material-icons left">power_settings_new</i> Logout
  </a>
</li>