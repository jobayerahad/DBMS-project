<?php include('header.php'); ?>

<?php include('inc/navbar.php'); ?>

<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">
        
        <?php include('inc/banner.php') ?>

        <div class="row my-5">
            <div class="col-md-9">
                <?php include('inc/home-content.php') ?>    
            </div>
            <div class="col-md-3">
                <?php include('inc/sidebar.php') ?>
            </div>
        </div>

        <?php include('inc/pagination.php') ?>

    </div>
</main>
<!--Main layout-->

<?php include('footer.php') ?>