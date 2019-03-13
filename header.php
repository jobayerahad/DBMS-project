<?php include("config/config.php"); ?>
<?php include("lib/Database.php"); ?>
<?php include("helpers/Format.php"); ?>
<?php
    $db = new Database();
    $fm = new Format();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Neophyte Blog</title>
    <link rel="shortcut icon" href="/blog/admin/upload/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/blog/admin/upload/favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/home-style.css" rel="stylesheet">
    
</head>

<body>
