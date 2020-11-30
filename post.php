<?php
if (!isset($_GET['id']) || $_GET['id'] == null) {
	header("Location: 404.php");
}
$id = $_GET['id'];
include('layout/header.php');

$query = "SELECT p.id, p.title, p.body, p.thumbnail, c.name AS category, pm.created_at, a.id as author_id
					FROM posts p
					INNER JOIN posts_meta pm ON p.id = pm.post_id
					INNER JOIN category c ON c.id = pm.category_id 
					INNER JOIN author a ON a.id = pm.author_id 
					WHERE p.published = TRUE AND p.id=$id";
$post = $db->select($query);
if ($post) {
	while ($result = $post->fetch_assoc()) {
		$authorId = $result['author_id'];
?>
		<div class="container">
			<main class="row">
				<div class="col s12">
					<div class="post__head">
						<img src="<?php echo SITE_URL . $result['thumbnail'] ?>" class="post__thumbnail">

						<div class="post__head__content white-text">
							<h3><?php echo $result['title'] ?></h3>
							<div class="chip"><?php echo $result['category'] ?></div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col l8">
						<div class="card">
							<div class="card-content">
								<p class="grey-text">Created at <?php echo date("jS F Y, h:i A", strtotime($result['created_at'])) ?></p>
								<p class="mt-1 grey-text text-darken-3"><?php echo $result['body'] ?></p>
							</div>
						</div>
					</div>

					<aside class="col l4 aside">
						<?php include("inc/sidebar.php"); ?>
					</aside>
				</div>

				<?php
				$query = "SELECT * from author WHERE id = $authorId";
				$author = $db->select($query);
				if ($author) { ?>
					<div class="row">
						<?php
						while ($result = $author->fetch_assoc()) {
						?>
							<div class="col s12">
								<div class="card horizontal">
									<div class="post__avatar">
										<img src="<?php echo SITE_URL . "/admin/" . $result['photo'] ?>">
									</div>

									<div class="card-stacked">
										<div class="card-content">
											<p class="grey-text">About Author</p>
											<span class="card-title mt-1"><?php echo $result['name'] ?></span>
											<p><?php echo $result['bio'] ?></p>
										</div>
									</div>
								</div>
							</div>
						<?php
						} ?>
					</div>
				<?php
				}  ?>
			</main>
		</div>
		</div>
<?php }
} else {
	header("Location: 404.php");
} ?>

<?php include('layout/footer.php'); ?>