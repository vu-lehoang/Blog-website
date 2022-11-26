<?php include 'partials/header.php';
// fetch post from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $single_post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>
<!-- ===================== Header ===================== -->
<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $single_post['title'] ?></h2>
        <div class="post__author">
            <?php
            //fetch author_id from categories table using category_id of posts
            $author_id = $single_post['author_id'];
            $author_query = "SELECT * FROM users WHERE id=$author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);

            ?>
            <div class="post__author-avatar">
                <img src="/images/<?= $author['avatar'] ?>" alt="">
            </div>
            <div class="post__author-info">
                <h5>By: <?= "{$author['firstname']} {$author['lastname']} " ?></h5>
                <small><?= date("M d, Y - H:i", strtotime($single_post['date_time'])) ?></small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="/images/<?= $single_post['thumbnail'] ?>" alt="">
        </div>
        <h4 style="text-align:center; margin: 20px 0;"><?= $single_post['title'] ?></h4>
        <?= $single_post['body'] ?>
    </div>
</section>
<!-- ===================== Footer ===================== -->
<?php include 'partials/footer.php'; ?>