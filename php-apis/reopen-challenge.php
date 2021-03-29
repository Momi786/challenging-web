<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

$response_msg['status'] = '';
$response_msg['description'] = '';

if (empty($_SESSION['id']) || is_null($_SESSION['id'])) {
    $response_msg['status'] = 'error';
    $response_msg['description'] .= 'Error: Session ID empty! Please login again to continue!';
} else {
    if (empty($_POST["challenge-id"]) || is_null($_POST["challenge-id"]) || empty($_POST["reopen-challenge-date"]) || is_null($_POST["reopen-challenge-date"]) || empty($_POST["reopen-challenge-time"]) || is_null($_POST["reopen-challenge-time"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] .= 'Error: Required fields missing!';
    } else {
        $reopen_by_id = $_SESSION['id'];
        $challenge_id = mysqli_real_escape_string($conn, clean_input($_POST["challenge-id"]));
        $reopenChallengeDate = mysqli_real_escape_string($conn, clean_input($_POST["reopen-challenge-date"]));
        $reopenChallengeTime = mysqli_real_escape_string($conn, clean_input($_POST["reopen-challenge-time"]));

        $sql = "SELECT * FROM challenges_log WHERE challenge_id = $challenge_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['challenge_by'] === $reopen_by_id) {
                    if ($row['status'] === 'reset') {
                        $sql2 = "UPDATE challenges_log SET status = 'open', challenge_date = '$reopenChallengeDate', challenge_time = '$reopenChallengeTime', reopen_timestamp = NOW() WHERE challenge_id = $challenge_id";

                        if (mysqli_query($conn, $sql2)) {
                            $response_msg['status'] = 'success';
                            $response_msg['description'] .= 'Success: Challenge re-opened successfully!';
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] .= 'Error: Challenge not in Reset state!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] .= 'Error: You cannot re-open this Challenge! Only the Challenge owner can re-open this challenge!';
                }
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] .= 'Error: Invalid Challenge ID!';
        }
    }
}

mysqli_close($conn);

echo json_encode($response_msg);
