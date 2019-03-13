<?php include('inc/header.php') ?>
<?php include('inc/navbar.php') ?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        header("Location: catlist.php");
    } else {
        $id = $_GET['catid'];
    }
?>
<!--Main layout-->
<main class="pt-5 mx-lg-5 xtra">
<div class="container-fluid mt-5">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            if (! empty($name)) {
                $query = "UPDATE category SET name = '$name' WHERE id = $id";
                $catInsert = $db->update($query);
                if ($catInsert) { ?>
    <p class="note note-success"><strong>Message : </strong> Category Updated</p>                
            <?php } else { ?>
    <p class="note note-danger"><strong>Message : </strong> Something Went Wrong</p>
            <?php }
            } 
        }
    ?>
        <!-- Material form login -->
        <div class="card">
            <h5 class="card-header blue-gradient white-text text-center py-4">
                <strong>Update Existing Category</strong>
            </h5>
            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">
                <!-- Form -->
                <?php
                $query = "SELECT * FROM category WHERE id = $id";
                $category = $db->select($query);
                if ($category) {
                    while ($result = $category->fetch_assoc()) {
                ?>
                <form class="text-center" method="post" action="">

                    <!-- Email -->
                    <div class="md-form">
                        <input type="text" id="category" class="form-control" name="name" 
                        value="<?php echo $result['name'] ?>" required>
                        <label for="category">Category Name</label>
                    </div>
                    <!-- Sign in button -->
                    <input type="hidden" name="action" value="add">
                    <button class="btn btn-default btn-rounded my-4 waves-effect" type="submit">Update</button>

                </form>
                <?php } } ?>
                <!-- Form -->
            </div>
        </div>
        <!-- Material form login -->
    </div>
</main>

<?php include('inc/footer.php') ?>