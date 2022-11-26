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
    $avatar = $_FILES['avatar'];

    // Validate input values
    if (!$firstName) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (!$lastName) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (!$userName) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (!$email) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (strlen($createPassword) < 8 || strlen($confirmPassword) < 8) {
        $_SESSION['signup'] = 'Password should be 8+ character';
    } elseif (!$confirmPassword) {
        $_SESSION['signup'] = 'Please enter your First Name';
    } elseif (!$avatar) {
        $_SESSION['signup'] = 'Please add avatar';
    } else {
        // Kiểm tra mật khẩu nhập lại có chính xác
        if ($createPassword !== $confirmPassword) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // Nếu mật khẩu chính xác, xử lý mã hóa mật khẩu
            $hased_password = password_hash($createPassword, PASSWORD_DEFAULT);
            // kiểm tra username hoặc email có tồn tại trong database 
            // check if usernam or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username ='$userName' OR email = '$email' ";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or Email already exist";
            } else {
                // WORK ON AVATAR
                // rename avatar
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

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
                        $_SESSION['signup'] = 'File size too big. Should be less than 1mb';
                    }
                } else {
                    $_SESSION['signup'] = 'File should be png, jpg, or jpeg';
                }
            }
        }
    }
    // redirect back to signup page if there was any proble
    if (isset($_SESSION['signup'])) {
        // pass form data back to signup page

        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // insert new user into users table database
        $inser_user_query = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstName','$lastName', '$userName', '$email', '$hased_password','$avatar_name',0)";
        $insert_user_result = mysqli_query($connection, $inser_user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['signup-success'] = 'Registration successful. Please login';
            header('location: ' . ROOT_URL . 'signin.php');
            die();
            echo 'insert thành công';
        }
    }
} else {
    // nếu không click thì tự động quay lại trang đăng nhập
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
