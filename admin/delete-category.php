<?php
require 'config/database.php';
session_start();

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    // update category_id of post delete belong uncategoried
    $update_query = "UPDATE posts SET category_id= 8 WHERE category_id=$id ";
    $update_result = mysqli_query($connection, $update_query);

    if (!mysqli_error($connection)) {
        // delete category
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-category-success'] = "Category deleted successfully";
    }
}
header('location: ' . ROOT_URL_ADMIN . 'manage-categories.php');
die();
