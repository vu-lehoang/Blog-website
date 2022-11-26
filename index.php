<?php include 'partials/header.php';

//fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

// fecth 9 posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 3";
$posts = mysqli_query($connection, $query);
?>
<!-- ===================== Header ===================== -->
<?php if (mysqli_num_rows($featured_result) == 1) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="/images/<?= $featured['thumbnail'] ?>" alt="">
            </div>
            <div class="post__info">
                <?php
                //fetch category from categories table using category_id of posts
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);

                ?>
                <a href="category-post.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title']; ?></a>
                <h2 class="post__title"><a href="post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body"><?= substr($featured['body'], 0, 500) ?>... </p>
                <div class="post__author">
                    <?php
                    //fetch author_id from categories table using category_id of posts
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);

                    ?>
                    <div class="post__author-avatar">
                        <img src="/images/<?= $author['avatar'] ?>" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>By: <?= "{$author['lastname']} {$author['firstname']}" ?></h5>
                        <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================== END of FEATURED ===================== -->
<?php endif ?>
<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
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

<!-- ===================== END of POTs ===================== -->
<?php include 'partials/category.php'; ?>
<!-- ===================== END of CATEGORY BUTTONS ===================== -->

<!-- ===================== Footer ===================== -->
<?php include 'partials/footer.php'; ?>