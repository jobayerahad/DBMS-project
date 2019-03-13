<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/admin-style.css" rel="stylesheet">
</head>

<body class="grey lighten-3">

	<?php include('inc/header.php') ?>

	<!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
			<!-- Material form login -->
			<div class="card">
				<h5 class="card-header info-color white-text text-center py-4">
					<strong>Create New Post</strong>
				</h5>
				<!--Card content-->
				<div class="card-body px-lg-5 pt-0">
					<!-- Form -->
					<form class="text-center" method="post" action="../lib/process-post.php">

						<!-- Email -->
						<div class="md-form">
							<input type="text" id="materialLoginFormEmail" class="form-control" name="title" required>
							<label for="materialLoginFormEmail">Blog Title</label>
						</div>

						<div class="md-form">
							<select class="form-control browser-default custom-select" required>
								<option value="" disabled selected>Choose Blog Category</option>
								<option value="1">Option 1</option>
								<option value="2">Option 2</option>
								<option value="3">Option 3</option>
							</select>
						</div>
						
						<div class="input-default-wrapper mt-3">
							<span class="input-group-text mb-3" id="input1">Upload Image</span>
							<input type="file" id="file-with-current" class="input-default-js" required>
							<label class="label-for-default-js rounded-right mb-3" for="file-with-current"><span class="span-choose-file">Choose file</span>
								<div class="float-right span-browse">Browse from local storage</div>
							</label>
						</div>

						<div class="md-form">
							<textarea id="form7" class="md-textarea form-control" rows="3" required></textarea>
							<label for="form7">Blog body</label>
						</div>
						<!-- Sign in button -->
						<input type="hidden" name="id" value="1">
						<input type="hidden" name="action" value="edit">
						<button class="btn btn-info btn-rounded my-4 waves-effect" type="submit">Update</button>

					</form>
					<!-- Form -->
				</div>
			</div>
			<!-- Material form login -->
    	</div>
	</main>

	<?php include('inc/footer.php') ?>
  
</body>

</html>
