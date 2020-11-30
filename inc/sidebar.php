<aside class="row">
	<div class="col s12">
		<div class="card">
			<ul class="collection with-header">
				<li class="collection-header">
					<h6 class="center">Recent Posts</h6>
				</li>
				<?php
				$query = "SELECT p.id, p.title 
							FROM posts p
							INNER JOIN posts_meta pm ON p.id = pm.post_id
							WHERE p.published = TRUE
							ORDER BY pm.created_at 
							DESC LIMIT 5";
				$recent_posts = $db->select($query);
				if ($recent_posts) {
					while ($result = $recent_posts->fetch_assoc()) {
				?>
						<li class="collection-item">
							<a href="post.php?id=<?php echo $result['id'] ?>" class="blue-grey-text text-darken-4">
								<?php echo $result['title']; ?>
							</a>
						</li>
					<?php }
				} else { ?>
					<li class="collection-item">
						No Posts Found
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="col s12">
		<div class="card">
			<ul class="collection with-header">
				<li class="collection-header">
					<h6 class="center">Categories</h6>
				</li>
				<?php
				$query = "SELECT * FROM category";
				$category = $db->select($query);
				if ($category) {
					while ($result = $category->fetch_assoc()) {
				?>
						<li class="collection-item <?php
																				if (isset($_GET['category']) && $_GET['category'] == $result['id']) {
																					echo "active light-blue lighten-5";
																				}
																				?>">
							<a href="posts.php?category=<?php echo $result['id'] ?>" class="blue-grey-text text-darken-4">
								<?php echo $result['name']; ?>
							</a>
						</li>
					<?php }
				} else { ?>
					<li class="collection-item">
						No Category Found
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</aside>