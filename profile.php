<?php
include('layout/header.php');
Session::checkSession();
$msg = "";
$userId = Session::get("userId");
$formValues = NULL;

$profileCompleted = false;
$query = "SELECT COUNT(id) AS existUser FROM author WHERE user_id = $userId";
$result = $db->select($query);
$value = mysqli_fetch_array($result);
if ($value['existUser' > 0]) {
  $profileCompleted = true;
}

// Profile Update Stuff
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $fm->validation($_POST['name']);
  $bio = $fm->validation($_POST['bio']);

  if ($fm->isEmpty($name) || $fm->isEmpty($bio)) {
    $msg = "Some fields are missing!";
  } else {
    $name = mysqli_real_escape_string($db->link, $name);
    $bio = mysqli_real_escape_string($db->link, $bio);

    $permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
    if (!$profileCompleted) {
      if (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // File Upload Stuff
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_temp = $_FILES['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $author_photo = strtolower(preg_replace('/\s+/', '_', $name)) . '.' . $file_ext;
        $author_photo_location = "upload/" . $author_photo;

        if ($file_size > 1024 * 1024) {
          $msg = "Photo Size Shouldn't be Greater Than 1 MegaByte";
        } else if (in_array($file_ext, $permited) === false) {
          $msg = "You can upload only : " . implode(' ', $permited);
        } else {
          move_uploaded_file($file_temp, $author_photo_location);
          $query = "INSERT INTO author(name, bio, photo, user_id) VALUES('$name', '$bio', '$author_photo_location', $userId)";
          $result = $db->insert($query);
          if (!$result) {
            $msg = "Something Went Wrong!";
          } else {
            $msg = "Profile Initiated!";
          }
        }
      } else {
        $msg = "Please upload your photo.";
      }
    } else {
      if (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // File Upload Stuff
        unlink($formValues['photo']);
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_temp = $_FILES['photo']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $author_photo = strtolower(preg_replace('/\s+/', '_', $name)) . '.' . $file_ext;
        $author_photo_location = "upload/" . $author_photo;

        if ($file_size > 1024 * 1024) {
          $msg = "Photo Size Shouldn't be Greater Than 1 MegaByte";
        } else if (in_array($file_ext, $permited) === false) {
          $msg = "You can upload only" . implode(' ', $permited);
        } else {
          move_uploaded_file($file_temp, $author_photo_location);
          $query = "UPDATE author SET name = '$name', bio = '$bio', photo = '$author_photo_location' WHERE user_id = '$userId'";
          $result = $db->update($query);
          if (!$result) {
            $msg = "Something Went Wrong!";
          }
        }
      } else {
        $query = "UPDATE author SET name = '$name', bio = '$bio' WHERE user_id = '$userId'";
        $result = $db->update($query);
        if (!$result) {
          $msg = "Something Went Wrong!";
        }
      }
    }
    header("Location: dashboard.php" );
  }
}
?>

<div class="admin flex">
  <?php
  include('layout/sidenav.php');
  // Checking & fetching profile for logged In user
  $query = "SELECT * FROM author WHERE user_id = '$userId'";
  $result = $db->select($query);
  if ($result) {
    $formValues = mysqli_fetch_array($result);
  } else {
    $profileCompleted = false;
  }
  ?>

  <main class="admin__main">
    <form class="card" action="" method="POST" enctype="multipart/form-data">
      <div class="card-content">
        <span class="card-title mb-2">Profile</span>

        <div class="row mb-0">
          <div class="col s12 m8">
            <div class="input-field grey-text text-darken-3">
              <i class="material-icons prefix">person</i>
              <input id="name" type="text" class="validate" name="name" value="<?php if ($formValues) echo $formValues['name'] ?>" required>
              <label for="name">Author Name</label>
            </div>

            <div class="input-field grey-text text-darken-3">
              <i class="material-icons prefix">subject</i>
              <textarea id="bio" class="materialize-textarea" name="bio" required><?php if ($formValues) echo $formValues['bio'] ?></textarea>
              <label for="bio">Author Bio</label>
            </div>
          </div>

          <div class="col s12 m4">
            <?php
            $img_url;
            if ($formValues) {
              $img_url = SITE_URL . $formValues['photo'];
            } else {
              $img_url = SITE_URL . "/assets/img/user.png";
            }
            ?>
            <img style="width: 100%; height: auto;" src="<?php echo $img_url; ?>" alt="<?php if ($formValues) echo $formValues['name'] ?>" />

            <div class="file-field input-field">
              <div class="btn btn-small blue-grey lighten-5 grey-text text-darken-3">
                <i class="material-icons left">insert_photo</i>
                <span>Change</span>
                <input type="file" name="photo">
              </div>

              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-action">
        <button type="submit" class="waves-effect waves-light btn">
          <i class="material-icons left">save</i>Save
        </button>
      </div>
    </form>
  </main>
</div>

<?php if (!$fm->isEmpty($msg) || !$profileCompleted) { ?>
  <div class="alert card red grey-text text-lighten-5" id="alert_box">
    <?php if (!$fm->isEmpty($msg)) { ?>
      <?php echo $msg ?>
    <?php } else if (!$profileCompleted) { ?>
      <i class="material-icons left">info</i>Please complete your profile
    <?php } ?>
    <i class="material-icons right" id="alert_close">close</i>
  </div>
<?php } ?>

<?php include('layout/footer.php') ?>