<?php
  if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy(); 
  }
?>
<!--Main Navigation-->
<header>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-grey darken-3 scrolling-navbar">
  <div class="container-fluid">

    <!-- Brand -->
    <a class="navbar-brand waves-effect" href="/blog/admin">
      <strong class="text-white">Neophyte</strong>
    </a>

    <!-- Collapse -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link waves-effect" href="/blog/admin">Dashboard
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="../" target="_blank">Visit Site</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto nav-flex-icons">
      
        <li class="nav-item avatar dropdown">
					<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true"
					aria-expanded="false">
						<img src="/blog/img/avatar.jpg" class="rounded-circle z-depth-0 w-25" style="max-width:100px" alt="avatar image">
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
						<a class="dropdown-item p-0 m-0 text-center" href="#"><i class="fas fa-user-alt mr-3"></i>Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item p-0 m-0 text-center" href="?action=logout"><i class="fas fa-sign-out-alt mr-3"></i>Log out</a>
					</div>
        </li>
			</ul>

    </div>

  </div>
</nav>
<!-- Navbar -->

<?php include('sidebar.php') ?>

</header>
<!--Main Navigation-->