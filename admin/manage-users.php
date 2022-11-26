<?php

include 'partials/header.php';
// fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);

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
                        <a href="manage-users.php" class="active">
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
            <h2>Manage Categories</h2>
            <?php
            // show notification if add user was successful
            if (isset($_SESSION['add-user-success'])) :
            ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['add-user-success'];
                        unset($_SESSION['add-user-success']);
                        ?>
                    </p>
                </div>
            <?php
            // show notification if edit user was successful
            elseif (isset($_SESSION['edit-user-success'])) :
            ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['edit-user-success'];
                        unset($_SESSION['edit-user-success']);
                        ?>
                    </p>
                </div>
            <?php   // show notification if delete user was successful
            elseif (isset($_SESSION['delete-user-success'])) :
            ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['delete-user-success'];
                        unset($_SESSION['delete-user-success']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <?php if (mysqli_num_rows($users) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?php echo "{$user['firstname']} {$user['lastname']}"; ?></td>
                                <td><?php echo $user['username']; ?> </td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                                <td><a href="<?= ROOT_URL_ADMIN ?>delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                                <td><?= $user['is_admin'] ? 'Yes' : 'No'; ?></td>
                            </tr>

                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert__message error">
                    <?= "Not found user" ?>
                </div>
            <?php endif ?>
        </main>
    </div>
</section>
<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>