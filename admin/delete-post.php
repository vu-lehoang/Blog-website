<?php
session_start();
// muốn show notification thì phải bật session_start()
require 'config/database.php';
// phải lấy ra id cần xóa
if (isset($_GET['id'])) {

    // get update form
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);

    // lấy ra dữ liệu cần xóa từ sql

    if (mysqli_num_rows($result) == 1) {
        $post = mysqli_fetch_assoc($result);
        // xóa link ảnh trong thư viện
        $thumbnail = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail;
        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // FOR LATER
    // fetch all thumbnails of posts's posts and delete them

    // delete posts from database
    $delete_post_query = "DELETE FROM posts WHERE id = $id";
    $delete_post_result = mysqli_query($connection, $delete_post_query);
    if (!mysqli_errno($connection)) {
        $_SESSION['delete-post-success'] = "post deleted successfully";
    }
}
header('location: ' . ROOT_URL_ADMIN . 'manage-posts.php');
die();
