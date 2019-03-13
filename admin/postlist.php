<?php include('inc/header.php') ?>

<?php include('inc/navbar.php') ?>

<!--Main layout-->
<main class="pt-5 mx-lg-5 xtra" >
    <div class="container-fluid mt-5">
        <?php
        if (isset($_GET['delpost'])) {
            $delId = $_GET['delpost'];

            $fetchQuery = "SELECT * FROM posts WHERE id = $delId";
            $getData = $db->select($fetchQuery);
            if ($getData) {
                while ($delImg = $getData->fetch_assoc()) {
                    $delLink = $delImg['image'];
                    unlink($delLink);
                }
            }
            
            $delQuery = "DELETE FROM posts WHERE id = $delId";
            $delData = $db->delete($delQuery);
            if ($delData) { ?>
            <p class="note note-danger"><strong>Message : </strong> Post Deleted</p> 
        <?php } else { ?>
            <p class="note note-info"><strong>Message : </strong> Post didn't deleted</p> 
        <?php }
        }
        ?>
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="5%">#</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="15%">Title</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="25%">Body</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="15%">Image</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="10%">Category</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="15%">Author</th>
                    <th scope="col" class="font-weight-bold blue-grey-text disabled h5 text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT posts.id, posts.title, posts.body, posts.image, category.name AS cat, author.name AS auth FROM posts INNER JOIN category ON category.id = posts.cat_id INNER JOIN author ON posts.auth_id = author.id ORDER BY created_at DESC";
                    $posts = $db->select($query);
                    if ($posts) {
                        $i = 0;
                        while ($result = $posts->fetch_assoc()) {
                            $i++;
                ?>
                <tr>
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $result['title'] ?></td>
                    <td class="text-justify"><?php echo $fm->textShorten($result['body'], 80) ?></td>
                    <td>
                        <img src="/blog/admin/<?php echo $result['image'] ?>" 
                            class="img-fluid img-thumbnail rounded z-depth-1" alt="<?php echo $result['title'] ?>">
                    </td>
                    <td class="text-center"><?php echo $result['cat'] ?></td>
                    <td class="text-center"><?php echo $result['auth'] ?></td>
                    <td class="text-center">
                        <a href="editpost.php?postid=<?php echo $result['id'] ?>" class="indigo-text font-weight-bold">Edit</a> || 
                        <a onclick="return confirm('Are you sure to delete?')" href="?delpost=<?php echo $result['id'] ?>" class="text-danger font-weight-bold">Delete</a>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('inc/footer.php') ?>
  