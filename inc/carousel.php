<?php
$query = "SELECT posts.id, posts.title, posts.thumbnail, category.name AS category, category.id AS categoryId
FROM posts 
INNER JOIN posts_meta ON posts.id = posts_meta.post_id
INNER JOIN category ON category.id = posts_meta.category_id 
WHERE posts.published = TRUE AND posts.featured = TRUE
ORDER BY posts_meta.created_at DESC";
$posts = $db->select($query);
if ($posts) { ?>
	<div class="owl-carousel owl-theme">
		<?php
		while ($result = $posts->fetch_assoc()) {
		?>
			<div class="carousel__item item hoverable">
				<img src="<?php echo SITE_URL . "/" . $result['thumbnail'] ?>" class="carousel__thumbnail">

				<div class="carousel__content">
					<a href="posts.php?category=<?php echo $result['categoryId'] ?>">
						<h5 class="blue-grey-text text-lighten-4 valign-wrapper"><i class="material-icons left">tag</i><?php echo $result['category'] ?></h5>
					</a>

					<a href="<?php echo SITE_URL . "/post.php?id=" . $result['id'] ?>">
						<h6 class="blue-grey-text text-lighten-5"><?php echo $result['title'] ?></h6>
					</a>
				</div>
			</div>
		<?php
		} ?>
	</div>
<?php
}
?>