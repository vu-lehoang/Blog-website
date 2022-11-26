<?php

require 'config/database.php';
session_start();

if (isset($_POST['submit'])) {

    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];



    $is_featured = $is_featured == 1 ?: 0;
    // check and validate input values
    if (!$title) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif (!$category_id) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif (!$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } else {

        if ($thumbnail['name']) {

            $previous_thumbanil_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbanil_path) {
                unlink($previous_thumbanil_path);
            }

            // work on thumbnail
            // rename image
            $time = time();
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);

            $extension = end($extension);

            if (in_array($extension, $allowed_files)) {
                if ($thumbnail['size'] < 2000000) {
                    // upload thumbnail
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['edit-post'] = 'Thumbnail size too big. Should be less than 2mb';
                }
            } else {
                $_SESSION['edit-post'] = 'Thumbnail should be png, jpg or jpeg';
            }
        }
    }

    // redirect back (with form data) to edit-post page if there is any problem
    if (isset($_SESSION['edit-post'])) {

        header('location: ' . ROOT_URL_ADMIN . 'edit-post.php');
        die();
    } else {
        // set is_featured of all posts to if
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
        // UPDATE post into database
        // set thumbnail name if là ảnh mới ngược lại ảnh cũ
        $thumbnail_to_insert =  $thumbnail_name ?? $previous_thumbnail_name;
        $query = "UPDATE posts SET title = '$title', body = '$body', thumbnail='$thumbnail_to_insert', category_id='$category_id',  is_featured='$is_featured' WHERE id = $id LIMIT 1";
        $result_update = mysqli_query($connection, $query);


        if (!mysqli_errno($connection)) {
            $_SESSION['edit-post-success'] = "Post updated successfully";
            header('location: ' . ROOT_URL_ADMIN . 'manage-posts.php');
            die();
        }
    }
}
header('location: ' . ROOT_URL_ADMIN . 'manage-posts.php');
die();
