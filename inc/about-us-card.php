<?php 
    $query = "SELECT * FROM author";
    $posts = $db->select($query);
    if ($posts) {
        while ($result = $posts->fetch_assoc()) {
?>
<div class="col-md-3">
	<!-- Card Regular -->
	<div class="card card-cascade">

	<!-- Card image -->
	<div class="view view-cascade overlay">
		<img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/men.jpg" 
		alt="<?php echo $result['name']; ?> ">
		<a>
			<div class="mask rgba-white-slight"></div>
		</a>
	</div>

	<!-- Card content -->
	<div class="card-body card-body-cascade text-center">

		<!-- Title -->
		<h4 class="card-title"><strong><?php echo $result['name']; ?></strong></h4>
		<!-- Text -->
		<p class="card-text"><?php echo $result['bio']; ?></p>

	</div>

	</div>
	<!-- Card Regular -->

</div>
<?php 
        }
    } else {
        header("Location:404.php");
    }
?>