<?php 
    $per_page = 3;
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $per_page;
?>
<?php    
    $query = "SELECT posts.id, posts.title, posts.body, posts.image, posts.created_at, category.name AS cat, author.name AS auth FROM posts INNER JOIN category ON category.id = posts.cat_id INNER JOIN author ON posts.auth_id = author.id
    ORDER BY created_at DESC 
    LIMIT $start_from, $per_page";
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
            <h6 class="font-weight-bold mb-2"><?php echo $result['cat']; ?></h6>
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
        <p>by <a><strong><?php echo $result['auth']; ?></strong></a>, 
            <?php echo $fm->formatDate($result['created_at']); ?>
        </p>

    </div>
    <!-- Grid column -->

</div>
<!-- Grid row -->
<hr class="my-3">

<?php 
        }
    } else {
        header("Location:404.php");
    }
?>