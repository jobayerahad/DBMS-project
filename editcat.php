<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();

if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
	header("Location: catlist.php");
} else {
	$id = $_GET['catid'];
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (Session::get("permissionLevel") >= 2) {
		$name = mysqli_real_escape_string($db->link, $_POST['name']);
		if (!empty($name)) {
			$query = "UPDATE category SET name = '$name' WHERE id = $id";
			$catUpdate = $db->update($query);
			if ($catUpdate) {
				$msg = "Category Updated";
			} else {
				$msg = "Something Wen't Wrong";
			}
		}
	} else {
		$msg = "You don't have enough permission to perform this operation";
	}
}
?>

<div class="admin flex">
	<?php include('layout/sidenav.php'); ?>

	<main class="admin__main">
		<?php
		$query = "SELECT * FROM category WHERE id = $id";
		$category = $db->select($query);
		if ($category) {
			while ($result = $category->fetch_assoc()) {
		?>
				<form class="card" method="post" action="">
					<div class="card-content">
						<span class="card-title mb-2">Update Category</span>

						<div class="input-field grey-text text-darken-3">
							<i class="material-icons prefix">featured_play_list</i>
							<input id="first_name" type="text" class="validate" name="name" value="<?php echo $result['name'] ?>" required>
							<label for="first_name">Category Name</label>
						</div>

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