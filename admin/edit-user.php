<?php include 'partials/header.php';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    // trả về kết quả truy vấn
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL_ADMIN . 'manage-users.php');
    die();
}

?>
<!-- ===================== Header ===================== -->
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <!-- <div class="alert__message success">
            <p>This is an error message</p>
        </div> -->
        <form action="<?= ROOT_URL_ADMIN ?>edit-user-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $user['id'] ?>" name="id">
            <input type="text" value="<?= $user['firstname'] ?>" name="firstname" placeholder="First Name">
            <input type="text" value="<?= $user['lastname'] ?>" name="lastname" placeholder="Last Name">

            <select name="userrole" id="">
                <?php if ($user['is_admin'] == 0) : ?>
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                <?php elseif ($user['is_admin'] == 1) : ?>
                    <option value="1">Admin</option>
                    <option value="0">Author</option>
                <?php endif ?>
            </select>
            <button type="submit" name="submit" class="btn">Update User</button>
        </form>
    </div>
</section>

<!-- ===================== FORM  =====================-->

<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>