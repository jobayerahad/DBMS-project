<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

$msg = "";
$permissionLevel = Session::get("permissionLevel");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($permissionLevel >= 1) {
		$id = date('Ymdhis');
		$authorId = Session::get("authorId");
		$title = mysqli_real_escape_string($db->link, $_POST['title']);
		$body = $fm->validation(mysqli_real_escape_string($db->link, $_POST['body']));
		$excerpt = $fm->validation(mysqli_real_escape_string($db->link, $_POST['excerpt']));
		$categoryId = $_POST['category_id'];
		$featured = 0;
		if (array_key_exists("featured", $_POST)) {
			$featured = $_POST['featured'];
		}
		$published = $_POST['published'];

		if (!$fm->isEmpty($title) || !$fm->isEmpty($body) || !$fm->isEmpty($_FILES) || !$fm->isEmpty($categoryId)) {
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
				$postQuery = "INSERT INTO posts(id, title, body, excerpt, thumbnail, featured, published) VALUES($id, '$title','$body', '$excerpt', '$uploaded_image', '$featured', '$published')";
				$postInsert = $db->insert($postQuery);

				$postMetaQuery = "INSERT INTO posts_meta(post_id, category_id, author_id) VALUES($id, $categoryId, $authorId)";
				$postMetaInsert = $db->insert($postMetaQuery);
				if ($postInsert && $postMetaInsert) {
					$msg = "New Post Created";
				} else {
					$msg = "Something Wen't Wrong";
				}
			}
		} else {
			$msg = "Some required field's are missing!";
		}
	} else {
		$msg = "You don't have enough permission to perform this operation";
	}
}
?>

<div class="admin flex">
	<?php include('layout/sidenav.php') ?>

	<main class="admin__main">
		<form class="card" action="" method="POST" enctype="multipart/form-data">
			<div class="card-content">
				<span class="card-title mb-2">Create New Post</span>

				<div class="row mb-0">
					<div class="col s12 m8">
						<div class="input-field grey-text text-darken-3">
							<i class="material-icons prefix">title</i>
							<input id="title" type="text" class="validate" name="title" required>
							<label for="title">Post Title</label>
						</div>

						<div class="input-field grey-text text-darken-3">
							<i class="material-icons prefix">featured_play_list</i>
							<select name="category_id">
								<?php
								$query = "SELECT * FROM category";
								$category = $db->select($query);
								if ($category) {
									while ($result = $category->fetch_assoc()) {
								?>
										<option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
								<?php }
								} ?>
							</select>
							<label>Post Category</label>
						</div>

						<div class="input-field grey-text text-darken-3">
							<i class="material-icons prefix">subject</i>
							<textarea id="body" class="materialize-textarea" name="body" required></textarea>
							<label for="body">Post Body</label>
						</div>
					</div>

					<div class="col s12 m4">
						<div class="file-field input-field">
							<div class="btn btn-small blue-grey lighten-5 grey-text text-darken-3">
								<i class="material-icons left">insert_photo</i>
								<span>Thumbnail</span>
								<input type="file" name="thumbnail" required>
							</div>

							<div class="file-path-wrapper">
								<input class="file-path validate" type="text">
							</div>
						</div>

						<div class="input-field grey-text text-darken-3">
							<i class="material-icons prefix">subtitles</i>
							<textarea id="excerpt" class="materialize-textarea" name="excerpt"></textarea>
							<label for="excerpt">Post Excerpt</label>
						</div>
					</div>

					<div class="col s12 m12">
						<p>
							<label>
								<input type="checkbox" name="featured" value="1" />
								<span>Featured Post</span>
							</label>
						</p>
					</div>

					<div class="col s12 m12 flex mt-1">
						<?php if ($permissionLevel >= 2) { ?>
							<p class="mr-1">
								<label>
									<input name="published" value="1" type="radio" checked />
									<span>Publish</span>
								</label>
							</p>

							<p>
								<label>
									<input name="published" value="0" type="radio" />
									<span>Draft</span>
								</label>
							</p>
						<?php } else { ?>
							<p class="grey-text">&ast; In order to publish a post, you must have editor role or higher. Now you can only draft post.</p>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="card-action">
				<button type="submit" class="waves-effect waves-light btn">
					<?php if ($permissionLevel >= 2) { ?>
						<i class="material-icons left">create</i>Create
					<?php } else { ?>
						<i class="material-icons left">drafts</i>Draft
					<?php } ?>
				</button>
			</div>
		</form>
	</main>
</div>

<?php include('layout/footer.php') ?>