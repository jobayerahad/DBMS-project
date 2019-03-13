<?php include('inc/header.php') ?>

<?php include('inc/navbar.php') ?>

<!--Main layout-->
<main class="pt-5 mx-lg-5 xtra" >
    <div class="container-fluid mt-5">
        <?php
        if (isset($_GET['delcat'])) {
            $delId = $_GET['delcat'];
            $delQuery = "DELETE FROM category WHERE id = $delId";
            $delData = $db->delete($delQuery);
            if ($delData) { ?>
            <p class="note note-danger"><strong>Message : </strong> Category Deleted</p> 
        <?php } else { ?>
            <p class="note note-info"><strong>Message : </strong> Category didn't deleted</p> 
        <?php }
        }
        ?>
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5">#</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5">Category Name</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM category ORDER BY id";
                    $category = $db->select($query);
                    if ($category) {
                        $i = 0;
                        while ($result = $category->fetch_assoc()) {
                            $i++;
                ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $result['name'] ?></td>
                    <td>
                        <a href="editcat.php?catid=<?php echo $result['id'] ?>" class="indigo-text font-weight-bold">Edit</a> || 
                        <a onclick="return confirm('Are you sure to delete?')" href="?delcat=<?php echo $result['id'] ?>" class="text-danger font-weight-bold">Delete</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('inc/footer.php') ?>
  