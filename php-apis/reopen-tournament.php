<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = [];
$success_msgs = [];
$error_msgs = [];

if (empty($_SESSION['id']) || is_null($_SESSION['id'])) {
    $response_msg['status'] = 'error';
    $error_msgs[] = 'Error: Session ID empty! Please login again to continue!';
} else {
    if (empty($_POST["tourney-id"]) || is_null($_POST["tourney-id"]) || empty($_POST["tourney-reopen-start-date"]) || is_null($_POST["tourney-reopen-start-date"]) || empty($_POST["tourney-reopen-start-time"]) || is_null($_POST["tourney-reopen-start-time"])) {
        $response_msg['status'] = 'error';
        $error_msgs[] = 'Error: Required Fields Missing!';
    } else {
        $reopen_player_id = $_SESSION['id'];
        $tourney_id = mysqli_real_escape_string($conn, clean_input($_POST["tourney-id"]));
        $tourneyReopenStartDate = mysqli_real_escape_string($conn, clean_input($_POST["tourney-reopen-start-date"]));
        $tourneyReopenStartTime = mysqli_real_escape_string($conn, clean_input($_POST["tourney-reopen-start-time"]));

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tourney_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($reopen_player_id === $row['tournament_by']) {
                    if ($row['status'] === 'reset') {
                        $sql1 = "SELECT CURDATE() AS current_date_alias";
                        $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $current_date = $row1['current_date_alias'];
                            }
                        } else {
                            $current_date = '0000-00-00';
                        }

                        if ($tourneyReopenStartDate > $current_date) {
                            $sql2 = "UPDATE tournaments_log SET status = 'open', start_date = '$tourneyReopenStartDate', start_time = '$tourneyReopenStartTime', reopen_timestamp = NOW() WHERE tournament_id = $tourney_id";

                            if (mysqli_query($conn, $sql2)) {
                                $response_msg['status'] = 'success';
                                $success_msgs[] = 'Success: Tournament Re-Opened successfully!';
                            } else {
                                $response_msg['status'] = 'error';
                                $error_msgs[] = 'Error: ' . mysqli_error($conn);
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $error_msgs[] = 'Error: Tournament start date must greater than today!';
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $error_msgs[] = 'Error: Only Reset Tournaments can be re-opened!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $error_msgs[] = 'Error: You cannot re-open this Tournament! Only the Tournament owner can re-open this Tournament.';
                }
            }
        } else {
            $response_msg['status'] = 'error';
            $error_msgs[] = 'Error: Invalid Tournament ID!';
        }
    }
}

$response_msg['success_msgs'] = $success_msgs;
$response_msg['error_msgs'] = $error_msgs;

mysqli_close($conn);

echo json_encode($response_msg);
