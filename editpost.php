<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
	header("Location: postlist.php");
} else {
	$id = $_GET['postid'];
}

$msg = "";
$permissionLevel = Session::get("permissionLevel");
$authorId = Session::get("authorId");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$query = "SELECT p.id FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE pm.author_id = '$authorId'";
	$result = $db->select($query);
	if ($permissionLevel < 2 || !$result) {
		$msg = "You're not authorized to perform this operation";
	} else {
		$title = mysqli_real_escape_string($db->link, $_POST['title']);
		$body = $fm->validation(mysqli_real_escape_string($db->link, $_POST['body']));
		$excerpt = $fm->validation(mysqli_real_escape_string($db->link, $_POST['excerpt']));
		$categoryId = $_POST['category_id'];
		$featured = $_POST['featured'];
		$published = $_POST['published'];

		if (!$fm->isEmpty($title) || !$fm->isEmpty($body) || !$fm->isEmpty($categoryId)) {
			if (file_exists($_FILES['thumbnail']['tmp_name']) || is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
				$permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
				$file_name = $_FILES['thumbnail']['name'];
				$file_size = $_FILES['thumbnail']['size'];
				$file_temp = $_FILES['thumbnail']['tmp_name'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_image = $id . '.' . $file_ext;
				$uploaded_image = "upload/" . $unique_image;

				if ($file_size > 1024 * 1024) {
					$msg = "Photo Size Shouldn't be Greater Than 1 MegaByte";
				} else if (in_array($file_ext, $permited) === false) {
					$msg = "You can upload only : " . implode(' ', $permited);
				} else {
					move_uploaded_file($file_temp, $uploaded_image);
					$postQuery = "UPDATE posts SET title = '$title', body = '$body', excerpt = '$excerpt', thumbnail = '$uploaded_image', featured = '$featured', published = '$published' WHERE id = '$id'";
					$postInsert = $db->insert($postQuery);

					$postMetaQuery = "UPDATE posts_meta SET category_id = '$categoryId' WHERE post_id = '$id'";
					$postMetaInsert = $db->insert($postMetaQuery);
					if ($postInsert && $postMetaInsert) {
						$msg = "Post Updated";
					} else {
						$msg = "Something Wen't Wrong";
					}
				}
			} else {
				$postQuery = "UPDATE posts SET title = '$title', body = '$body', excerpt = '$excerpt', featured = '$featured', published = '$published' WHERE id = '$id'";
				$postInsert = $db->insert($postQuery);

				$postMetaQuery = "UPDATE posts_meta SET category_id = '$categoryId' WHERE post_id = '$id'";
				$postMetaInsert = $db->insert($postMetaQuery);
				if ($postInsert && $postMetaInsert) {
					$msg = "Post Updated";
				} else {
					$msg = "Something Wen't Wrong";
				}
			}
		} else {
			$msg = "Some required field's are missing!";
		}
	}
	$query = "SELECT p.id FROM posts p INNER JOIN posts_meta pm ON p.id = pm.post_id WHERE pm.author_id = '$authorId'";
	$result = $db->select($query);
	if ($permissionLevel < 2 || !$result) {
		$msg = "You're not authorized to perform this operation";
	} else {
		$title = mysqli_real_escape_string($db->link, $_POST['title']);
		$body = $fm->validation(mysqli_real_escape_string($db->link, $_POST['body']));
		$excerpt = $fm->validation(mysqli_real_escape_string($db->link, $_POST['excerpt']));
		$categoryId = $_POST['category_id'];
		$featured = $_POST['featured'];
		$published = $_POST['published'];

		if (!$fm->isEmpty($title) || !$fm->isEmpty($body) || !$fm->isEmpty($categoryId)) {
			if (file_exists($_FILES['thumbnail']['tmp_name']) || is_uploaded_file($_FILES['thumbnail']['tmp_name'])) {
				$permited  = array('jpg', 'jpeg', 'png', 'gif', 'webp');
				$file_name = $_FILES['thumbnail']['name'];
				$file_size = $_FILES['thumbnail']['size'];
				$file_temp = $_FILES['thumbnail']['tmp_name'];

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_image = $id . '.' . $file_ext;
				$uploaded_image = "upload/" . $unique_image;

				if ($file_size > 1024 * 1024) {
					$msg = "Photo Size Shouldn't be Greater Than 1 MegaByte";
				} else if (in_array($file_ext, $permited) === false) {
					$msg = "You can upload only : " . implode(' ', $permited);
				} else {
					move_uploaded_file($file_temp, $uploaded_image);
					$postQuery = "UPDATE posts SET title = '$title', body = '$body', excerpt = '$excerpt', thumbnail = '$uploaded_image', featured = '$featured', published = '$published' WHERE id = '$id'";
					$postInsert = $db->insert($postQuery);

					$postMetaQuery = "UPDATE posts_meta SET category_id = '$categoryId' WHERE post_id = '$id'";
					$postMetaInsert = $db->insert($postMetaQuery);
					if ($postInsert && $postMetaInsert) {
						$msg = "Post Updated";
					} else {
						$msg = "Something Wen't Wrong";
					}
				}
			} else {
				$postQuery = "UPDATE posts SET title = '$title', body = '$body', excerpt = '$excerpt', featured = '$featured', published = '$published' WHERE id = '$id'";
				$postInsert = $db->insert($postQuery);

				$postMetaQuery = "UPDATE posts_meta SET category_id = '$categoryId' WHERE post_id = '$id'";
				$postMetaInsert = $db->insert($postMetaQuery);
				if ($postInsert && $postMetaInsert) {
					$msg = "Post Updated";
				} else {
					$msg = "Something Wen't Wrong";
				}
			}
		} else {
			$msg = "Some required field's are missing!";
		}
	}
}
?>

<div class="admin flex">
	<?php include('layout/sidenav.php') ?>

	<main class="admin__main">
		<?php
		$postSelectQuery = "SELECT p.id, p.title, p.body, p.thumbnail, p.excerpt, p.featured, p.published, c.id AS categoryId, c.name AS categoryName 
							FROM posts p
							INNER JOIN posts_meta pm ON p.id = pm.post_id
							INNER JOIN category c ON c.id = pm.category_id 
							INNER JOIN author a ON a.id = pm.author_id 
							WHERE p.id=$id";
		$post = $db->select($postSelectQuery);
		if ($post) {
			while ($postResult = $post->fetch_assoc()) {
		?>
				<form class="card" action="" method="POST" enctype="multipart/form-data">
					<div class="card-content">
						<span class="card-title mb-2">Update Post</span>

						<div class="row mb-0">
							<div class="col s12 m8">
								<div class="input-field grey-text text-darken-3">
									<i class="material-icons prefix">title</i>
									<input id="title" type="text" class="validate" name="title" value="<?php echo $postResult['title'] ?>" required>
									<label for="title">Post Title</label>
								</div>

								<div class="input-field grey-text text-darken-3">
									<i class="material-icons prefix">featured_play_list</i>
									<select name="category_id">
										<?php
										$categorySelectQuery = "SELECT * FROM category";
										$category = $db->select($categorySelectQuery);
										if ($category) {
											while ($categoryResult = $category->fetch_assoc()) {
										?>
												<option value="<?php echo $categoryResult['id']; ?>" <?php if ($categoryResult['id'] === $postResult['categoryId']) echo "selected" ?>><?php echo $categoryResult['name']; ?></option>
										<?php }
										} ?>
									</select>
									<label>Post Category</label>
								</div>

								<div class="input-field grey-text text-darken-3">
									<i class="material-icons prefix">subject</i>
									<textarea id="body" class="materialize-textarea" name="body" required><?php echo $postResult['body'] ?></textarea>
									<label for="body">Post Body</label>
								</div>
							</div>

							<div class="col s12 m4">
								<label for="thumbnail">Post thumbnail</label>
								<img id="thumbnail" src="<?php echo SITE_URL . $postResult['thumbnail'] ?>" style="width: 100%; height: auto;" alt="<?php echo $postResult['title'] ?>">

								<div class="file-field input-field">
									<div class="btn btn-small blue-grey lighten-5 grey-text text-darken-3">
										<i class="material-icons left">insert_photo</i>
										<span>Change</span>
										<input type="file" name="thumbnail">
									</div>

									<div class="file-path-wrapper">
										<input class="file-path validate" type="text">
									</div>
								</div>

								<div class="input-field grey-text text-darken-3">
									<i class="material-icons prefix">subtitles</i>
									<textarea id="excerpt" class="materialize-textarea" name="excerpt"><?php echo $postResult['excerpt'] ?></textarea>
									<label for="excerpt">Post Excerpt</label>
								</div>
							</div>

							<div class="col s12 m12">
								<p>
									<label>
										<input type="checkbox" name="featured" value="1" <?php if ($postResult['featured']) echo "checked"; ?> />
										<span>Featured Post</span>
									</label>
								</p>
							</div>

							<div class="col s12 m12 flex mt-1">
								<p class="mr-1">
									<label>
										<input name="published" value="1" type="radio" <?php if ($postResult['published']) echo "checked"; ?> />
										<span>Published</span>
									</label>
								</p>

								<p>
									<label>
										<input name="published" value="0" type="radio" <?php if (!$postResult['published']) echo "checked"; ?> />
										<span>Drafted</span>
									</label>
								</p>
							</div>
						</div>
					</div>

					<div class="card-action">
						<button type="submit" class="waves-effect waves-light btn">
							<i class="material-icons left">update</i>Update
						</button>
					</div>
				</form>
			<?php }
		} else { ?>
			<h4 class="center red-text">Something is wrong!</h4>
		<?php }
		?>
	</main>
</div>

<?php if (!$fm->isEmpty($msg)) { ?>
	<div class="alert card light-blue darken-2 grey-text text-lighten-5" id="alert_box">
		<i class="material-icons left">info</i><?php echo $msg ?><i class="material-icons right" id="alert_close">close</i>
	</div>
<?php } ?>

<?php include('layout/footer.php') ?>