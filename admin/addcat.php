<?php include('inc/header.php') ?>
<?php include('inc/navbar.php') ?>
<!--Main layout-->
<main class="pt-5 mx-lg-5 xtra">
<div class="container-fluid mt-5">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            if (! empty($name)) {
                $query = "INSERT INTO category(name) VALUES('$name')";
                $catInsert = $db->insert($query);
                if ($catInsert) { ?>
    <p class="note note-info"><strong>Message : </strong> Category Added</p>                
            <?php } else { ?>
    <p class="note note-danger"><strong>Message : </strong> Category Couldn't Add</p>
            <?php }
            } 
        }
    ?>
        <!-- Material form login -->
        <div class="card">
            <h5 class="card-header blue-gradient white-text text-center py-4">
                <strong>Create New Category</strong>
            </h5>
            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">
                <!-- Form -->
                <form class="text-center" method="post" action="">

                    <!-- Email -->
                    <div class="md-form">
                        <input type="text" id="category" class="form-control" name="name" required>
                        <label for="category">Category Name</label>
                    </div>
                    <!-- Sign in button -->
                    <input type="hidden" name="action" value="add">
                    <button class="btn btn-default btn-rounded my-4 waves-effect" type="submit">Add</button>

                </form>
                <!-- Form -->
            </div>
        </div>
        <!-- Material form login -->
    </div>
</main>

<?php include('inc/footer.php') ?>