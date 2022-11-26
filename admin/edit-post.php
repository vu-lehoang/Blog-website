<?php include 'partials/header.php';

// fetch categories from database
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);


// fetch post data form database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL_ADMIN . 'manage-posts.php');
    die();
}
?>
<!-- ===================== Header ===================== -->

<section class="form__section">

    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <?php if (isset($_SESSION['edit-post'])) : ?>
            <div class="alert__message error">
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL_ADMIN . 'edit-post-logic.php' ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <select id="" name="category">
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <option value="<?= $category['id']; ?>" <?php $abc = $category['id'];
                                                            echo ($abc == $post['category_id']) ? 'selected' : ''; ?>>
                        <?= $category['title'] ?>
                    </option>
                <?php endwhile ?>


            </select>

            <textarea name="body" id="" placeholder="Body" rows="8"><?= $post['body'] ?></textarea>
            <div class="form__control inline">
                <input type="checkbox" checked value="1" name="is_featured" id="is_featured">
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control ">
                <label for="thumbnail">Edit Thumbnail</label>
                <input type="file" name="thumbnail">
            </div>

            <button type=" submit" name="submit" class="btn">Edit Post</button>
        </form>
    </div>
</section>

<!-- ===================== FORM  =====================-->

<!-- ===================== FOOTER ===================== -->
<?php include '../partials/footer.php'; ?>