<?php
session_start();
// muốn show notification thì phải bật session_start()
require 'config/database.php';
// phải lấy ra id cần xóa
if (isset($_GET['id'])) {

    // get update form
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
    // lấy ra dữ liệu cần xóa từ sql

    if (mysqli_num_rows($result) == 1) {
        // xóa link ảnh trong thư viện
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    // FOR LATER
    // fetch all thumbnails of users's posts and delete them
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if (mysqli_num_rows($thumbnails_result) > 0) {
        while ($thumbnail =  mysqli_fetch_assoc($thumbnails_result)) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }


    // delete users from database
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete-user'] = "Couldn't {$user['fistname']} {$user['lastname']} ";
    } else {
        $_SESSION['delete-user-success'] = "User '{$user['fistname']} {$user['lastname']} ' deleted successfully";
    }
}
header('location: ' . ROOT_URL_ADMIN . 'manage-users.php');
die();
