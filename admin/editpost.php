<?php include('inc/header.php') ?>
<?php include('inc/navbar.php') ?>
<?php
	if (!isset($_GET['postid']) || $_GET['postid'] == NULL) {
		header("Location: postlist.php");
	} else {
		$id = $_GET['postid'];
	}
?>
<!--Main layout-->
<main class="pt-5 mx-lg-5">
	<div class="container-fluid mt-5">
	<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$title = mysqli_real_escape_string($db->link, $_POST['title']);
			$body = mysqli_real_escape_string($db->link, $_POST['body']);
			$cat_id = mysqli_real_escape_string($db->link, $_POST['cat_id']);
			$auth_id = Session::get("userId");

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;
			
			if (!empty($file_name) ) {
				if ($file_size > 1048567) { ?>
					<p class="note note-warning"><strong>Warning : </strong> Image Size Shouldn't be Greater Than 1 MegaByte</p>
				<?php } else if (in_array($file_ext, $permited) === false) {
					echo "<p class='note note-warning'><strong>Warning : </strong> You can upload only : ".implode(' ', $permited)."</p>";
				} else {
					move_uploaded_file($file_temp, $uploaded_image);

					$fetchQuery = "SELECT * FROM posts WHERE id = $id";
					$getData = $db->select($fetchQuery);
					if ($getData) {
						while ($delImg = $getData->fetch_assoc()) {
							$delLink = $delImg['image'];
							unlink($delLink);
						}
					}
	
					$query = "UPDATE posts SET title = '$title', body ='$body', image = '$uploaded_image', cat_id = '$cat_id' WHERE id = '$id'";
					$updated_row = $db->update($query);
					if ($updated_row) { ?>
						<p class="note note-info"><strong>Success : </strong> Post Updated</p>
					<?php } else { ?>
						<p class="note note-danger"><strong>Error : </strong> Something went wrong</p>
					<?php }
				} 	
			} else {
				$query = "UPDATE posts SET title = '$title', body ='$body', cat_id = '$cat_id' WHERE id = '$id'";
				$updated_row = $db->update($query);
				if ($updated_row) { ?>
					<p class="note note-info"><strong>Success : </strong> Post Updated</p>
				<?php } else { ?>
					<p class="note note-danger"><strong>Error : </strong> Something went wrong</p>
				<?php }
			}
		}
	?>
		<!-- Material form login -->
		<div class="card">
			<h5 class="card-header blue-gradient white-text text-center py-4">
				<strong>Update Post</strong>
			</h5>
			<!--Card content-->
			<div class="card-body px-lg-5 pt-0">
			<?php
			$query = "SELECT * FROM posts WHERE id='$id'";
			$getPost = $db->select($query);
			if ($getPost) {
					while ($postResult = $getPost->fetch_assoc()) {
			?>
				<!-- Form -->
				<form class="text-center" method="post" action="" enctype="multipart/form-data">

					<!-- Email -->
					<div class="md-form">
						<input type="text" id="materialLoginFormEmail" class="form-control" name="title" value="<?php echo $postResult['title']; ?>" required>
						<label for="materialLoginFormEmail">Blog Title</label>
					</div>

					<div class="md-form">
						<select class="form-control browser-default custom-select" name="cat_id" required>
							<option value="" disabled selected>Choose Blog Category</option>
							<?php
							$query = "SELECT * FROM category";
							$category = $db->select($query);
							if ($category) {
								while ($result = $category->fetch_assoc()) {
							?>
							<option 
								<?php if ($postResult['cat_id'] == $result['id']) { ?>
									selected = "selected"
								<?php } ?> value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
							<?php } } ?>
						</select>
					</div>
					
					<div class="input-default-wrapper mt-3">
						<div class="row">
							<div class="col-sm-9">
								<span class="input-group-text mb-3" id="input1">Upload Image</span>
								<input type="file" id="file-with-current" class="input-default-js" name="image">
								<label class="label-for-default-js rounded-right mb-3" for="file-with-current"><span class="span-choose-file">Choose file</span>
									<div class="float-right span-browse">Browse from local storage</div>
								</label>
							</div>
							<div class="col-sm-3">
								<img src="/blog/admin/<?php echo $postResult['image'] ?>" 
										class="img-fluid img-thumbnail rounded z-depth-1" 
										alt="<?php echo $postResult['title'] ?>">
							</div>
						</div>				
					</div>

					<div class="md-form">
						<textarea id="form7" class="md-textarea form-control" rows="3" name="body" required><?php echo $postResult['body']; ?></textarea>
						<label for="form7">Blog body</label>
					</div>
					<!-- Sign in button -->
					<input type="hidden" name="action" value="add">
					<button class="btn btn-info btn-rounded my-4 waves-effect" type="submit">Update</button>
				</form>
				<!-- Form -->
			<?php } } ?>
			</div>
		</div>
		<!-- Material form login -->
	</div>
</main>

<?php include('inc/footer.php') ?>