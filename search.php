<?php include 'partials/header.php';
if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC ";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<?php if (mysqli_num_rows($posts) > 0) : ?>
    <section class="posts section__extra-margin">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="/images/<?= $post['thumbnail'] ?>" alt="">
                    </div>
                    <div class="post__info">
                        <?php
                        //fetch category from categories table using category_id of posts
                        $category_id = $post['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id=$category_id";
                        $category_result = mysqli_query($connection, $category_query);
                        $category = mysqli_fetch_assoc($category_result);

                        ?>
                        <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
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
                                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                                <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error lg section__extra-margin">
        <h3 class="align-center">
            Not posts found for this search
        </h3>
    </div>
<?php endif ?>
<!-- ===================== END of POTs ===================== -->
<?php include 'partials/category.php'; ?>
<!-- ===================== END of CATEGORY BUTTONS ===================== -->

<!-- ===================== Footer ===================== -->
<?php include 'partials/footer.php'; ?>