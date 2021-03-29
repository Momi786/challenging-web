<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (empty($_POST["challenge-game"]) || is_null($_POST["challenge-game"]) || empty($_POST["challenge-console"]) || is_null($_POST["challenge-console"]) || empty($_POST["challenge-amount"]) || is_null($_POST["challenge-amount"]) || empty($_POST["challenge-date"]) || is_null($_POST["challenge-date"]) || empty($_POST["challenge-time"]) || is_null($_POST["challenge-time"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] = 'Required Fields Empty or null!';
    } else {
        $user_id = $_SESSION['id'];
        $challengeAmount = mysqli_real_escape_string($conn, clean_input($_POST["challenge-amount"]));

        $sql4 = "SELECT * FROM meta_data WHERE meta_key = 'min_challenge_amount' OR meta_key = 'max_challenge_amount'";
        $result4 = mysqli_query($conn, $sql4);

        if (mysqli_num_rows($result4) > 0) {
            while ($row4 = mysqli_fetch_assoc($result4)) {
                ($row4['meta_key'] === 'min_challenge_amount') ? ($min_challenge_amount = intval($row4['meta_value'], 10)) : ($max_challenge_amount = intval($row4['meta_value'], 10));
            }
        } else {
            $min_challenge_amount = 0;
            $max_challenge_amount = 0;
        }

        if ($challengeAmount >= $min_challenge_amount && $challengeAmount <= $max_challenge_amount) {
            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['balance'] >= $challengeAmount) {
                        $newBalance = $row['balance'] - $challengeAmount;

                        $sql2 = "UPDATE users SET balance = $newBalance WHERE id = $user_id";

                        if (mysqli_query($conn, $sql2)) {
                            $response_msg['status'] = 'success';
                            $response_msg['description'] = 'Balance Updated Successfully!';

                            $challenge_game = mysqli_real_escape_string($conn, clean_input($_POST["challenge-game"]));
                            $challenge_console = mysqli_real_escape_string($conn, clean_input($_POST["challenge-console"]));
                            $challenge_game_mode = mysqli_real_escape_string($conn, clean_input($_POST["challenge-game-mode"]));
                            $challenge_rules = mysqli_real_escape_string($conn, clean_input($_POST["challenge-rules"]));
                            $challenge_date = mysqli_real_escape_string($conn, clean_input($_POST["challenge-date"]));
                            $challenge_time = mysqli_real_escape_string($conn, clean_input($_POST["challenge-time"]));

                            $sql3 = "INSERT INTO challenges_log (challenge_by, game, console, amount, game_mode, rules, challenge_date, challenge_time) VALUES ($user_id, '$challenge_game', '$challenge_console', '$challengeAmount', '$challenge_game_mode', '$challenge_rules', '$challenge_date', '$challenge_time')";

                            if (mysqli_query($conn, $sql3)) {
                                $response_msg['description'] .= "\nChallenge Created Successfully";
                            } else {
                                $response_msg['description'] .= "\nError: " . mysqli_error($conn);
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] = "Error updating record: " . mysqli_error($conn);
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] = 'Insufficient Balance for Creating Challenge!';
                    }
                }
            } else {
                $response_msg['status'] = 'error';
                $response_msg['description'] = 'Invalid Session ID! Please login again to continue!';
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] = 'Error: Challenge amount should be between $' . $min_challenge_amount . ' and $' . $max_challenge_amount;
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] = 'Session ID missing! Please login again to continue!';
}

mysqli_close($conn);

echo json_encode($response_msg);
