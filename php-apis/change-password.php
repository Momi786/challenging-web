<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (empty($_POST["currentPassword"]) || empty($_POST["newPassword"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] = 'All fields required!';
    } else {
        $user_id = $_SESSION['id'];

        $sql = "SELECT * FROM users WHERE id=$user_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $currentPassword = mysqli_real_escape_string($conn, clean_input($_POST["currentPassword"]));

                if (password_verify($currentPassword, $row['user_password'])) {
                    $newPassword = password_hash(mysqli_real_escape_string($conn, clean_input($_POST["newPassword"])), PASSWORD_DEFAULT);

                    $sql = "UPDATE users SET user_password='$newPassword' WHERE id=$user_id";

                    if (mysqli_query($conn, $sql)) {
                        $response_msg['status'] = 'success';
                        $response_msg['description'] = 'Password Updated Successfully!';
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] = "Error updating record: " . mysqli_error($conn);
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] = 'Invalid Curent Password!';
                }
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] = 'Invalid Session ID! Please login again to continue!';
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] = 'Session ID missing! Please login again to continue!';
}

mysqli_close($conn);

echo json_encode($response_msg);
