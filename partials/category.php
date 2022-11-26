<!-- ===================== END of POTs ===================== -->
<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_cate_query = "SELECT * FROM categories ";
        $all_categories = mysqli_query($connection, $all_cate_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)) : ?>
            <a href="<?= ROOT_URL ?>category-post.php?id=<?= $category['id']; ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!-- ===================== END of CATEGORY BUTTONS ===================== -->