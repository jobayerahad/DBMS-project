<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

$msg = "";
$permissionLevel = Session::get("permissionLevel");

if (isset($_GET['delpost'])) {
	if ($permissionLevel >= 2) {
		$delId = $_GET['delpost'];

		$fetchQuery = "SELECT thumbnail FROM posts WHERE id = $delId";
		$getData = $db->select($fetchQuery);
		if ($getData) {
			while ($blogData = $getData->fetch_assoc()) {
				unlink($blogData['thumbnail']);
			}
		}

		$delPostQuery = "DELETE FROM posts WHERE id = $delId";
		$delPost = $db->delete($delPostQuery);

		$delPostMetaQuery = "DELETE FROM posts_meta WHERE post_id = $delId";
		$delPostMeta = $db->delete($delPostMetaQuery);

		if ($delPost && $delPostMeta) {
			$msg = "Blog Deleted";
		} else {
			$msg = "Something Went Wrong";
		}
	} else {
		$msg = "You don't have enough permission to perform this operation";
	}
}
?>

<div class="admin flex">
	<?php include('layout/sidenav.php') ?>

	<main class="admin__main">
		<?php
		$query = "SELECT posts.id, posts.title, posts.excerpt, posts.published, category.name AS category, author.name AS author
		FROM posts 
		INNER JOIN posts_meta ON posts.id = posts_meta.post_id
		INNER JOIN category ON category.id = posts_meta.category_id 
		INNER JOIN author ON author.id = posts_meta.author_id
		ORDER BY posts_meta.created_at DESC";
		$blogs = $db->select($query);
		if ($blogs) { ?>
			<div class="card">
				<div class="card-content">
					<span class="card-title">Post List</span>

					<table class="highlight striped responsive-table">
						<thead>
							<tr>
								<th class="blue-grey-text">#</th>
								<th class="blue-grey-text">Title</th>
								<th class="blue-grey-text">Excerpt</th>
								<th class="blue-grey-text">Category</th>
								<th class="blue-grey-text">Author</th>
								<th class="blue-grey-text">Status</th>
								<th class="blue-grey-text">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$i = 0;
							while ($result = $blogs->fetch_assoc()) {
								$i++;
							?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $result['title'] ?></td>
									<td>
										<?php echo $fm->textShorten($result['excerpt'], 75) ?>
									</td>
									<td><?php echo $result['category'] ?></td>
									<td><?php echo $fm->nameShorten($result['author']) ?></td>
									<td>
										<?php if ($result['published'] != 0) echo "Published";
										else echo "Drafted" ?>
									</td>
									<td>
										<a href="editpost.php?postid=<?php echo $result['id'] ?>" class="light-blue-text">Edit</a> ||
										<a onclick="return confirm('Are you sure to delete?')" href="?delpost=<?php echo $result['id'] ?>" class="red-text">Delete</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		} else { ?>
			<div class="blue-grey-text text-darken-4">
				<h4>No Blog Posted Yet!</h4>
				<p class="valign-wrapper">Please make a new one! by clicking &lpar;<i class="material-icons">add</i>&rpar; icon right bottom corner of the screen.</p>
			</div>
		<?php } ?>
	</main>
</div>

<div class="fixed-action-btn">
	<a class="btn-floating btn-large waves-effect waves-light light-blue darken-3" href="createPost.php">
		<i class="large material-icons">add</i>
	</a>
</div>

<?php if (!$fm->isEmpty($msg)) { ?>
	<div class="alert card light-blue darken-2 grey-text text-lighten-5" id="alert_box">
		<i class="material-icons left">info</i><?php echo $msg ?><i class="material-icons right" id="alert_close">close</i>
	</div>
<?php } ?>

<?php include('layout/footer.php') ?>