<div class="card mb-4">
    <div class="card-header h5 text-center">Recent Posts</div>		
    <div class="list-group">
    <?php
        $query = "SELECT id, title FROM posts ORDER BY created_at DESC LIMIT 5";
        $recent_posts = $db->select($query);
        if ($recent_posts) {
            while($result = $recent_posts->fetch_assoc()) {
    ?>
        <a href="post.php?id=<?php echo $result['id'] ?>" 
            class="list-group-item list-group-item-action flex-column align-items-start">
            <p class="m-0"><?php echo $result['title']; ?></p>
        </a>
    <?php } } else { ?>
        <a class="list-group-item list-group-item-action flex-column align-items-start disabled">
            <h5 class="mb-2 h5">No Posts Found</h5>
        </a>
    <?php }?>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header h5 text-center">Category</div>		
    <div class="list-group">
    <?php
        $query = "SELECT * FROM category";
        $category = $db->select($query);
        if ($category) {
            while($result = $category->fetch_assoc()) {
    ?>
        <a href="posts.php?category=<?php echo $result['id'] ?>" 
            class="list-group-item list-group-item-action flex-column align-items-start 
            <?php
            if (isset($_GET['category']) && $_GET['category'] == $result['id']) {
                echo "active";
            }
            ?>">
            <p class="m-0"><?php echo $result['name']; ?></p>
        </a>
    <?php } } else { ?>
        <a class="list-group-item list-group-item-action flex-column align-items-start disabled">
            <h5 class="mb-2 h5">No Category Found</h5>
        </a>
    <?php }?>
    </div>
</div>