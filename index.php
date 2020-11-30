<?php
include('layout/header.php');
include('inc/carousel.php')
?>

<div class="container">
	<div class="row">
		<div class="col l8">
			<?php
			$per_page = 5;
			if (isset($_GET["page"])) {
				$page = $_GET["page"];
			} else {
				$page = 1;
			}
			$start_from = ($page - 1) * $per_page;

			$query = "SELECT posts.id, posts.title, posts.body, posts.excerpt, posts.thumbnail
								FROM posts 
								INNER JOIN posts_meta ON posts.id = posts_meta.post_id
								WHERE posts.published = TRUE
								ORDER BY posts_meta.created_at DESC 
								LIMIT $start_from, $per_page";
			$posts = $db->select($query);
			if ($posts) { ?>
				<div class="row">
					<?php
					while ($result = $posts->fetch_assoc()) {
					?>
						<div class="col s12">
							<div class="card horizontal hoverable">
								<div class="card-image">
									<img src="<?php echo SITE_URL . $result['thumbnail'] ?>">
								</div>

								<div class="card-stacked">
									<div class="card-content">
										<span class="card-title"><?php echo $result['title'] ?></span>
										<p>
											<?php
											if ($fm->isEmpty($result['excerpt'])) {
												echo $fm->textShorten($result['body'], 100);
											} else {
												echo $fm->textShorten($result['excerpt'], 100);
											}
											?>
										</p>
									</div>
									<div class="card-action">
										<a href="<?php echo SITE_URL . "post.php?id=" . $result['id'] ?>" class="light-blue-text text-darken-3">Read Full Post</a>
									</div>
								</div>
							</div>
						</div>
					<?php
					} ?>
				</div>
			<?php
			} else { ?>
				<h3 class="cyan-text text-darken-1 center">No Blog Found!</h3>
			<?php
			}
			?>
		</div>

		<aside class="col l4 aside">
			<?php include('inc/sidebar.php') ?>
		</aside>
	</div>
</div>

<?php
include('inc/pagination.php');
include('layout/footer.php');
?>