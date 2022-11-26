<?php include 'partials/header.php';
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts_result = mysqli_query($connection, $query);
?>
<!-- ===================== Header ===================== -->
<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle">
            <i class="uil uil-angle-right-b"></i>
        </button>
        <button id="hide__sidebar-btn" class="sidebar__toggle">
            <i class="uil uil-angle-left-b"></i>
        </button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php">
                        <i class="uil uil-pen"></i>
                        <h5>Add post</h5>
                    </a>
                </li>
                <li>
                    <a href="manage-posts.php" class="active">
                        <i class="uil uil-postcard"></i>
                        <h5>Manage post</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php">
                            <i class="uil uil-user-plus"></i>
                            <h5>Add user</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php">
                            <i class="uil uil-users-alt"></i>
                            <h5>Manage User</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php">
                            <i class="uil uil-edit-alt"></i>
                            <h5>Add category</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php">
                            <i class="uil uil-bars"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Posts</h2>
            <?php if (isset($_SESSION['add-post-success'])) : ?>
                <div class="alert__message success">
                    <?= $_SESSION['add-post-success'];
                    unset($_SESSION['add-post-success']);
                    ?>
                </div>
            <?php endif ?>
            <table>
                <?php if (mysqli_num_rows($posts_result) > 0) : ?>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post_result = mysqli_fetch_assoc($posts_result)) : ?>
                            <?php
                            $category_id = $post_result['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <tr>
                                <td><?= $post_result['title']; ?></td>
                                <td><a href=""><?= $category['title'] ?></a></td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>edit-post.php?id=<?= $post_result['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>delete-post.php?id=<?= $post_result['id'] ?>" class="btn sm danger">Delete</a></td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                <?php else : ?>
                    <div class="alert__message error">
                        <?= "Not found post" ?>
                    </div>
                <?php endif ?>
            </table>

        </main>

    </div>
</section>

<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>