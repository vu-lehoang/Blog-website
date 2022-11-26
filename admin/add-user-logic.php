<?php
session_start();
require 'config/database.php';

// lấy ra dữ liệu nếu có click vào
if (isset($_POST['submit'])) {
    $firstName = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userName = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createPassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    // Validate input values
    if (!$firstName) {
        $_SESSION['add-user'] = 'Please enter your First Name';
    } elseif (!$lastName) {
        $_SESSION['add-user'] = 'Please enter your First Name';
    } elseif (!$userName) {
        $_SESSION['add-user'] = 'Please enter your User Name';
    } elseif (!$email) {
        $_SESSION['add-user'] = 'Please enter your a valid Email';
    } elseif (strlen($createPassword) < 8 || strlen($confirmPassword) < 8) {
        $_SESSION['add-user'] = 'Password should be 8+ character';
    } elseif (!$confirmPassword) {
        $_SESSION['add-user'] = 'Password not correct';
    } elseif (!$avatar) {
        $_SESSION['add-user'] = 'Please add avatar';
    } else {
        // Kiểm tra mật khẩu nhập lại có chính xác
        if ($createPassword !== $confirmPassword) {
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            // Nếu mật khẩu chính xác, xử lý mã hóa mật khẩu
            $hased_password = password_hash($createPassword, PASSWORD_DEFAULT);
            // kiểm tra username hoặc email có tồn tại trong database 
            // check if usernam or email already exist in database
            $add_user_check_query = "SELECT * FROM users WHERE username ='$userName' OR email = '$email' ";
            $add_user_check_result = mysqli_query($connection, $add_user_check_query);
            if (mysqli_num_rows($add_user_check_result) > 0) {
                $_SESSION['add-user'] = "Username or Email already exist";
            } else {
                // WORK ON AVATAR
                // rename avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);

                if (in_array($extention, $allowed_files)) {
                    // make sure image is not too large 1mb
                    if ($avatar['size'] < 1000000) {
                        // upload avatar
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add-user'] = 'File size too big. Should be less than 1mb';
                    }
                } else {
                    $_SESSION['add-user'] = 'File should be png, jpg, or jpeg';
                }
            }
        }
    }
    // redirect back to add-user page if there was any proble
    if (isset($_SESSION['add-user'])) {
        // pass form data back to add-user page

        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL_ADMIN . 'add-user.php');
        die();
    } else {
        // insert new user into users table database
        $insert_add_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstName','$lastName', '$userName', '$email', '$hased_password','$avatar_name',$is_admin)";
        $insert_add_user_result = mysqli_query($connection, $insert_add_user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['add-user-success'] = 'Registration successful. Please login';
            header('location: ' . ROOT_URL_ADMIN . 'manage-users.php');
            die();
            echo 'insert thành công';
        }
    }
} else {
    // nếu không click thì tự động quay lại trang đăng nhập
    header('location: ' . ROOT_URL_ADMIN . 'add-user.php');
    die();
}
