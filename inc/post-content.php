<?php
    $query = "SELECT * FROM posts WHERE id=$id";
    $post = $db->select($query);
    if ($post) {
        while($result = $post->fetch_assoc()) {
?>
    <!-- Card -->
    <div class="card card-cascade wider reverse">

        <!-- Card image -->
        <div class="view view-cascade overlay">
            <img class="card-img-top" src="admin/<?php echo $result['image']; ?>" 
                alt="<?php echo $result['title']; ?>"/>
            <a href="#!">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>

        <!-- Card content -->
        <div class="card-body card-body-cascade text-center">

            <!-- Title -->
            <h4 class="card-title"><strong><?php echo $result['title']; ?></strong></h4>
            <!-- Text -->
            <p class="card-text"><?php echo $result['body']; ?></p>

        </div>

    </div>
    <!-- Card -->

<?php } } else { header("Location: 404.php"); }?>
