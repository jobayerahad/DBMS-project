<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

$authorId = Session::get("authorId")
?>
<div class="admin flex">
  <?php include('layout/sidenav.php') ?>

  <main class="admin__main">
    <div class="row">
      <h5>At a glace</h5>

      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <span class="card-title">Website Stats</span>

            <?php
            $query = "SELECT COUNT(id) AS NumberOfPosts FROM posts";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Total Posts : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(id) AS NumberOfPosts FROM posts WHERE published = TRUE";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Published : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(id) AS NumberOfPosts FROM posts WHERE published = FALSE";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Drafted : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(id) AS NumberOfPosts FROM posts WHERE featured = TRUE";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Featured : <?php echo $value['NumberOfPosts'] ?></p>
          </div>
        </div>
      </div>

      <div class="col s12 m6">
        <div class="card">
          <div class="card-content">
            <span class="card-title">My Stats</span>

            <?php
            $query = "SELECT COUNT(p.id) AS NumberOfPosts FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE pm.author_id = '$authorId'";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Total Posts : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(p.id) AS NumberOfPosts FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE p.published = TRUE AND pm.author_id = '$authorId'";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Published : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(p.id) AS NumberOfPosts FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE p.published = FALSE AND pm.author_id = '$authorId'";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Drafted : <?php echo $value['NumberOfPosts'] ?></p>

            <?php
            $query = "SELECT COUNT(p.id) AS NumberOfPosts FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE p.featured = TRUE AND pm.author_id = '$authorId'";
            $result = $db->select($query);
            $value = mysqli_fetch_array($result);
            ?>
            <p>Featured : <?php echo $value['NumberOfPosts'] ?></p>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<?php include('layout/footer.php') ?>