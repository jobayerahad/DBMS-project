<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../lib/Session.php';?>
<?php include '../helpers/Format.php';?>
<?php
    $db = new Database();
    $fm = new Format();
    Session::init();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        />
        <link rel="shortcut icon" href="/blog/admin/upload/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/blog/admin/upload/favicon.ico" type="image/x-icon">
        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <!-- Material Design Bootstrap -->
        <link href="../css/mdb.min.css" rel="stylesheet" />
        <!-- Your custom styles (optional) -->
        <link href="../css/admin-style.css" rel="stylesheet" />
        <title>Authentication</title>
    </head>
    <body class="view">
        <img src="upload/background.jpg" class="img-fluid" alt="" />
        <div class="row mask rgba-black-strong w-auto">
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-sm-4 col-xs-12">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $fm->validation($_POST['email']);
                    $password = $fm->validation(md5($_POST['password']));

                    $email = mysqli_real_escape_string($db->link,$email);
                    $password = mysqli_real_escape_string($db->link,$password);

                    $query = "SELECT * FROM author WHERE email = '$email' AND password = '$password'";
                    $result = $db->select($query);
                    if ($result != false) {
                        $value = mysqli_fetch_array($result);
                        $row   = mysqli_num_rows($result);
                        if ($row > 0) {
                            Session::set("login", true);
                            Session::set("email", $value['email']);
                            Session::set("userId", $value['id']);
                            header("Location: index.php");
                        } else { ?>
                            <p class="text-center text-danger">No such user found. Please try again</p>
                    <?php }
                    } else { ?>
                        <p class="text-center text-danger font-weight-bold">email or Password Not Matched</p>
                <?php }
                }
            ?>
                <form action="" class="form-container login-form " method="post">
                    <!-- Material input -->
                    <div class="md-form">
                        <i class="fas fa-envelope prefix"></i>
                        <input
                            type="email"
                            id="inputValidationEx"
                            class="form-control validate text-white"
                            name="email"
                        />
                        <label
                            for="inputValidationEx"
                            data-error="wrong"
                            data-success="right"
                            class="text-white"
                            >Type your email</label
                        >
                    </div>
                    <!-- Material input -->
                    <div class="md-form">
                        <i class="fas fa-lock prefix"></i>
                        <input
                            type="password"
                            id="inputValidationEx"
                            class="form-control validate text-white"
                            name="password"
                        />
                        <label
                            class="text-white"
                            for="inputValidationEx"
                            data-error="wrong"
                            data-success="right"
                            >Type your password</label
                        >
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn blue-gradient ">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="../js/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="../js/mdb.min.js"></script>
        <!-- Initializations -->
        <script type="text/javascript" src="../js/admin.js"></script>
    </body>
</html>
