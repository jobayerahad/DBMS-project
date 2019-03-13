<?php
    $query = "SELECT * FROM posts";
    $result = $db->select($query);
    $total_rows = mysqli_num_rows($result);
    $total_pages = ceil($total_rows/$per_page);
?>
<!--Pagination-->
<nav class="d-flex justify-content-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
    <ul class="pagination pg-blue">

        <!--Arrow left-->
        <li class="page-item <?php if ($page == 1) echo "disabled"; ?>">
            <a class="page-link waves-effect waves-effect" href="?page=1" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>

        <?php 
        for ($i=1; $i <= $total_pages; $i++) {
        ?>

        <li class="page-item <?php if ($page == $i) echo "active"; ?>">
            <a class="page-link waves-effect waves-effect" 
                href="?page=<?php echo $i ?>">
                <?php echo $i ?>
            </a>
        </li>

        <?php } ?>

        <li class="page-item <?php if ($page == $total_pages) echo "disabled"; ?>">
            <a class="page-link waves-effect waves-effect" 
                href="?page=<?php echo $total_pages ?>" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
<!--Pagination-->
<?php

?>