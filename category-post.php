<?php include 'partials/header.php';

//fetch posts if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>
<!-- ===================== Header ===================== -->
<header class="category__title">
    <?php
    if ($id) {
        $category_id = $id;
        $cate_query = "SELECT * FROM categories WHERE id = $id";
        $cate_result = mysqli_query($connection, $cate_query);
        $cate = mysqli_fetch_assoc($cate_result);
        if ($cate) {
            echo "<h1>{$cate['title']}</h1>";
        } else {
            echo "<h1>Category doesn't exist</h1>";
            die();
        }
    } else {
        echo "<h1>Category doesn't exist</h1>";
        die();
    }
    ?>
    <?php
    ?>
</header>
<!-- ===================== END of CATEGORY TITLE ===================== -->

<?php if (mysqli_num_rows($posts) > 0) : ?>
    <section class="posts">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="/images/<?= $post['thumbnail'] ?>" alt="">
                    </div>
                    <div class=" post__info">
                        <a href="<?= ROOT_URL ?>category-post.php?id=<?= $cate['id'] ?>" class="category__button"><?= ($cate) ? $cate['title'] : null ?></a>
                        <h3 class="post__title">
                            <a href="post.php"><?= $post['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($post['body'], 0, 150) ?>...
                        </p>
                        <div class="post__author">
                            <?php
                            //fetch author_id from categories table using category_id of posts
                            $author_id = $post['author_id'];
                            $author_query = "SELECT * FROM users WHERE id=$author_id";
                            $author_result = mysqli_query($connection, $author_query);
                            $author = mysqli_fetch_assoc($author_result);

                            ?>

                            <div class="post__author-avatar">
                                <img src="/images/<?= $author['avatar'] ?>" alt="">
                            </div>
                            <div class="post__author-info">
                                <h5>By: <?= "{$author['lastname']} {$author['firstname']}" ?></h5>
                                <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error lg">
        <p class="align-center">No posts found for this category</p>
    </div>
<?php endif ?>
<!-- ===================== END of POTs ===================== -->
<?php include 'partials/category.php'; ?>
<!-- ===================== END of CATEGORY BUTTONS ===================== -->
<!-- ===================== Footer ===================== -->
<?php include 'partials/footer.php'; ?>