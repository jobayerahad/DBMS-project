<?php  
    if (!isset($_GET['search']) || $_GET['search'] == null) {
        header("Location: 404.php");
    }
    $search = $_GET['search'];
?>
<?php include('header.php'); ?>

<?php include('inc/navbar.php'); ?>

<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">

        <div class="row my-5">
            <div class="col-md-9">
            <?php    
                $query = "SELECT * 
                        FROM posts 
                        WHERE title LIKE '%$search%' OR body LIKE '%$search%'
                        ORDER BY created_at DESC ";
                $posts = $db->select($query);
                if ($posts) {
                    while ($result = $posts->fetch_assoc()) {
            ?>
            <!-- Grid row -->
            <div class="row wow fadeIn">

                <!-- Grid column -->
                <div class="col-lg-5">

                    <!-- Featured image -->
                    <div class="view overlay rounded z-depth-2 mb-lg-0 mb-4">
                        <img class="img-fluid" src="admin/<?php echo $result['image']; ?>" 
                            alt="<?php echo $result['title']; ?>">
                        <a href="/blog/post.php?id=<?php echo $result['id']; ?>">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-lg-7">
                    <!-- Category -->
                    <a href="#!" class="green-text">
                        <h6 class="font-weight-bold mb-2"><?php echo $result['cat_id']; ?>asdsa</h6>
                    </a>
                    <!-- Post title -->
                    <h3 class="font-weight-bold mb-3">
                        <a href="/blog/post.php?id=<?php echo $result['id']; ?>" class="blue-grey-text">
                            <strong><?php echo $result['title']; ?></strong>
                        </a>
                    </h3>
                    <!-- Excerpt -->
                    <p>
                        <?php echo $fm->textShorten($result['body'], 150); ?>
                        <!-- Read more button -->
                    <a href="/blog/post.php?id=<?php echo $result['id']; ?>" class="btn btn-success btn-sm">Read more</a>
                    </p>
                    <!-- Post data -->
                    <p>by <a><strong><?php echo $result['auth_id']; ?></strong></a>, 
                        <?php echo $fm->formatDate($result['created_at']); ?>
                    </p>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->
            <hr class="my-3">

            <?php 
                    }
                } else { ?>
                <div class="deep-orange-text text-center font-weight-bold my-5 p-4">
                    <h1 class="display-2">S<i class="far fa-sad-tear"></i>rry !!!</h1>
                    <p class="display-3">No Post found for '<?php echo $search ?>' keyword</p>
                </div>
            <?php }
            ?>    
            </div>
            <div class="col-md-3">
                <?php include('inc/sidebar.php') ?>
            </div>
        </div>

    </div>
</main>
<!--Main layout-->

<?php include('footer.php') ?>