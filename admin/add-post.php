<?php
include 'partials/header.php';
$query = " SELECT * FROM categories";

$categories_query = mysqli_query($connection, $query);
var_dump($categories_query);

// get back form data if invalid
$title = $_SESSION['add-post-data']['title'] ?? null;
$body = $_SESSION['add-post-data']['body'] ?? null;
$thumbnail = $_SESSION['add-post-data']['thumbnail'] ?? null;
unset($_SESSION['add-post-data']);
?>
<!-- ===================== Header ===================== -->

<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php if (isset($_SESSION['add-post'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']); ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL_ADMIN ?>add-post-logic.php" method="POST" enctype="multipart/form-data">
            <input type="text" placeholder="Title" name="title" value="<?= $title ?>">
            <select name="category" id="">
                <?php
                while ($category = mysqli_fetch_assoc($categories_query)) : ?>
                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
            </select>
            <textarea name="body" id="" value="body" placeholder="Body" rows="8"><?= $body ?></textarea>
            <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <div class="form__control inline">
                    <input type="checkbox" checked name="is_featured" value="1" id="is_featured">
                    <label for="is_featured">Featured</label>
                </div>
            <?php endif; ?>
            <div class="form__control ">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" value="<?= $thumbnail ?>">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

<!-- ===================== FORM  =====================-->

<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>