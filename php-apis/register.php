<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$username = mysqli_real_escape_string($conn, clean_input($_POST["username"]));
$firstname = mysqli_real_escape_string($conn, clean_input($_POST["firstname"]));
$lastname = mysqli_real_escape_string($conn, clean_input($_POST["lastname"]));
$email = mysqli_real_escape_string($conn, clean_input($_POST["email"]));
$user_password = password_hash(mysqli_real_escape_string($conn, clean_input($_POST["password"])), PASSWORD_DEFAULT);

$response_msg = array();

if (!empty($username) && !empty($firstname) && !empty($lastname) && !empty($email) && !empty($user_password)) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response_msg['status'] = 'error';
            $response_msg['description'] = 'Email already registered! Please login.';
        }
    } else {
        $sql3 = "SELECT * FROM meta_data WHERE meta_key = 'player_starting_points'";
        $result3 = mysqli_query($conn, $sql3);

        if (mysqli_num_rows($result3) > 0) {
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $player_starting_points = intval($row3['meta_value'], 10);
            }
        } else {
            $player_starting_points = 0;
        }

        $sql2 = "INSERT INTO users (username, first_name, last_name, email, user_password, skill_points) VALUES ('$username', '$firstname', '$lastname', '$email', '$user_password', $player_starting_points)";

        if (mysqli_query($conn, $sql2)) {
            $response_msg['status'] = 'success';
            $response_msg['description'] = 'New record created successfully!';

            $_SESSION['id'] = mysqli_insert_id($conn);
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] = mysqli_error($conn);
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] = 'All fields required!';
}

mysqli_close($conn);

echo json_encode($response_msg);
