<?php include 'partials/header.php';
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id= $id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) === 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL_ADMIN . 'manage-categories.php');
    die();
}

?>
<!-- ===================== Header ===================== -->

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <?php if (isset($_SESSION['edit-category'])) : ?>
            <div class="alert__message success">
                <p>
                    <?= $_SESSION['edit-category-error'];
                    unset($_SESSION['edit-category-error']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL_ADMIN ?>edit-category-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input type="text" name="title" value="<?php echo $category['title'] ?>" placeholder="Title">
            <textarea name="description" id="" placeholder="Description" rows="4"><?= $category['description'] ?></textarea>
            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
</section>

<!-- ===================== FORM  =====================-->

<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>