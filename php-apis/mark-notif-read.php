<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

$response_msg['status'] = '';
$response_msg['description'] = '';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (empty($_POST["notif_id"]) || is_null($_POST["notif_id"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] .= 'Error: Notification ID Missing!';
    } else {
        $accept_by_id = $_SESSION['id'];
        $notif_id = mysqli_real_escape_string($conn, clean_input($_POST["notif_id"]));

        $sql = "SELECT * FROM notifications WHERE notif_id = $notif_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['notif_status'] === 'unread') {
                    $sql2 = "UPDATE notifications SET notif_status = 'read', notif_read_timestamp = NOW() WHERE notif_id = $notif_id";

                    if (mysqli_query($conn, $sql2)) {
                        $response_msg['status'] = 'success';
                        $response_msg['description'] .= 'Success: Notification Marked Read Successfully!';
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] .= 'Error: Notification already read!';
                }
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] .= 'Error: Invalid Notification ID!';
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] .= 'Error: Session ID missing! Please login again to continue!';
}

mysqli_close($conn);

echo json_encode($response_msg);
