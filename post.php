<?php  
    if (!isset($_GET['id']) || $_GET['id'] == null) {
        header("Location: 404.php");
    }
    $id = $_GET['id'];
?>
<?php include('header.php'); ?>

<?php include('inc/navbar.php'); ?>

    <!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container">

            <div class="row mb-4">
                <div class="col-md-9">
                    <?php include('inc/post-content.php') ?>
                </div>
                <div class="col-md-3">
                    <?php include("inc/sidebar.php"); ?>
                </div>
            </div>

            <!-- Card -->
            <div class="card">

            <div class="card-header h5 text-center">About Author</div>

            <!-- Card content -->
            <div class="card-body">

                <div class="row">
                <?php
                    $query = "SELECT author.name AS name, author.bio AS bio, author.photo AS photo FROM `author`, `posts` WHERE posts.id = $id AND posts.auth_id = author.id";
                    $post = $db->select($query);
                    if ($post) {
                        while($result = $post->fetch_assoc()) {
                ?>
                    <div class="col-2">
                        <!-- Card image -->
                        <img class="card-img-top rounded-circle" src="img/avatar.jpg" alt="Card image cap">
                    </div>
                    <div class="col-10">
                        <!-- Title -->
                        <h4 class="card-title"><a><?php echo $result['name'] ?></a></h4>
                        <!-- Text -->
                        <p class="card-text"><?php echo $result['bio'] ?></p>
                    </div>
                <?php } } else { header("Location: 404.php"); }?>
                </div>

            </div>

            </div>
            <!-- Card -->

        </div>
    </main>
    <!--Main layout-->

<?php include('footer.php'); ?>