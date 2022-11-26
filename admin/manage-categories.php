<?php include 'partials/header.php';
// fetch categories from databse
$query = "SELECT * FROM categories ORDER BY title ASC";
$categories_result  = mysqli_query($connection, $query);
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
                    <a href="manage-posts.php">
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
                        <a href="manage-categories.php" class="active">
                            <i class="uil uil-bars"></i>
                            <h5>Manage Categories</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if (isset($_SESSION['add-category-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-category-success'];
                        unset($_SESSION['add-category-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['edit-category-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['edit-category-success'];
                        unset($_SESSION['edit-category-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['edit-category'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['edit-category'];
                        unset($_SESSION['edit-category']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['add-category'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['add-category'];
                        unset($_SESSION['add-category']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['delete-category-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['delete-category-success'];
                        unset($_SESSION['delete-category-success']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <?php if (mysqli_num_rows($categories_result) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($categorie_result = mysqli_fetch_assoc($categories_result)) : ?>
                            <tr>
                                <td><?= $categorie_result['title'] ?></td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>edit-category.php?id=<?= $categorie_result['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>delete-category.php?id=<?= $categorie_result['id'] ?>" class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error">Not found category</div>
            <?php endif; ?>
        </main>
    </div>
</section>
<!-- ===================== END ===================== -->
<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>