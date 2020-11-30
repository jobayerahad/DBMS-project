<?php
$query = "SELECT * FROM posts WHERE published = TRUE";
$result = $db->select($query);
if ($result) {
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows / $per_page);

	if ($total_pages > 1) {
?>
		<ul class="pagination center mb-2">
			<li class="waves-effect <?php if ($page == 1) echo "disabled"; ?>">
				<a href="?page=1"><i class="material-icons">chevron_left</i></a>
			</li>

			<?php
			for ($i = 1; $i <= $total_pages; $i++) {
			?>
				<li class="waves-effect <?php if ($page == $i) echo "active light-blue darken-1"; ?>">
					<a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
				</li>
			<?php } ?>

			<li class="waves-effect <?php if ($page == $total_pages) echo "disabled"; ?>">
				<a href="?page=<?php echo $total_pages ?>"><i class="material-icons">chevron_right</i></a>
			</li>
		</ul>
<?php }
} ?>