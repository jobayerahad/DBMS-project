<?php
include('layout/header.php');
Session::checkSession();
Redirects::checkCompleteProfile();
$msg = "";
if (isset($_GET['delcat'])) {
	if (Session::get("permissionLevel") >= 2) { 
		$delId = $_GET['delcat'];
		$delQuery = "DELETE FROM category WHERE id = $delId";
		$delData = $db->delete($delQuery);
		if ($delData) {
			$msg = "Category Deleted";
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
		$query = "SELECT * FROM category ORDER BY id";
		$category = $db->select($query);
		if ($category) { ?>
			<div class="card">
				<div class="card-content">
					<span class="card-title">Categories</span>

					<table class="highlight striped responsive-table">
						<thead>
							<tr>
								<th class="blue-grey-text">#</th>
								<th class="blue-grey-text">Category Name</th>
								<th class="blue-grey-text">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php
							$i = 0;
							while ($result = $category->fetch_assoc()) {
								$i++;
							?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $result['name'] ?></td>
									<td>
										<a href="editcat.php?catid=<?php echo $result['id'] ?>" class="light-blue-text">Edit</a> ||
										<a onclick="return confirm('Are you sure to delete?')" href="?delcat=<?php echo $result['id'] ?>" class="red-text">Delete</a>
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
				<h4>No Category Created Yet!</h4>
				<p class="valign-wrapper">Please make a new one! by clicking &lpar;<i class="material-icons">add</i>&rpar; icon right bottom corner of the screen.</p>
			</div>
		<?php } ?>
	</main>
</div>

<div class="fixed-action-btn">
	<a class="btn-floating btn-large waves-effect waves-light light-blue darken-3" href="addcat.php">
		<i class="large material-icons">add</i>
	</a>
</div>

<?php if (!$fm->isEmpty($msg)) { ?>
	<div class="alert card light-blue darken-2 grey-text text-lighten-5" id="alert_box">
		<i class="material-icons left">info</i><?php echo $msg ?><i class="material-icons right" id="alert_close">close</i>
	</div>
<?php } ?>

<?php include('layout/footer.php') ?>