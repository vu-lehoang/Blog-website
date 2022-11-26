<?php
include 'partials/header.php';
// get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;
unset($_SESSION['add-category-data']);
?>

<!-- ===================== Header ===================== -->

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category']);
                    ?>
                </p>
            </div>
        <?php endif; ?>
        <form action="<?= ROOT_URL_ADMIN ?>add-category-logic.php" method="POST">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <textarea name="description" id="" value="<?= $description ?>" placeholder="<?php echo $description ? $description : 'Description' ?>" rows="4"></textarea>
            <button type="submit" name="submit" class="btn">Add Category</button>
        </form>
    </div>
</section>

<!-- ===================== FORM  =====================-->
<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>