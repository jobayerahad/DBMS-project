<?php
include("config/config.php");
include("lib/Database.php");
include("lib/Session.php");
include("helpers/Format.php");
include("helpers/Redirects.php");
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo SITE_TITLE ?></title>
	<link rel="shortcut icon" href="<?php echo SITE_URL . "assets/favicon.ico" ?>" type="image/x-icon">
	<link rel="icon" href="<?php echo SITE_URL . "assets/favicon.ico" ?>" type="image/x-icon">
	<!--Import Google Icon Font-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo SITE_URL . "assets/css/owl.carousel.min.css" ?>">
	<link rel="stylesheet" href="<?php echo SITE_URL . "assets/css/owl.theme.default.min.css" ?>">
	<!-- Custom Styling -->
	<link rel="stylesheet" href="<?php echo SITE_URL . "assets/css/main.css" ?>">
</head>

<body>
	<?php include('layout/navbar.php'); ?>