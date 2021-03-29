<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

$response_msg['status'] = '';
$response_msg['description'] = '';

if (empty($_SESSION['id']) || is_null($_SESSION['id'])) {
    $response_msg['status'] = 'error';
    $response_msg['description'] .= 'Error: Session ID missing! Please login again to continue!';
} else {
    if (empty($_POST["tourney-game"]) || is_null($_POST["tourney-game"]) || empty($_POST["tourney-console"]) || is_null($_POST["tourney-console"]) || empty($_POST["tourney-players"]) || is_null($_POST["tourney-players"]) || empty($_POST["tourney-amount"]) || is_null($_POST["tourney-amount"]) || empty($_POST["tourney-start-date"]) || is_null($_POST["tourney-start-date"]) || empty($_POST["tourney-start-time"]) || is_null($_POST["tourney-start-time"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] .= 'Error: Required Fields Empty!';
    } else {
        $tourney_game = mysqli_real_escape_string($conn, clean_input($_POST["tourney-game"]));
        $tourney_console = mysqli_real_escape_string($conn, clean_input($_POST["tourney-console"]));
        $tourney_players = mysqli_real_escape_string($conn, clean_input($_POST["tourney-players"]));
        $tourney_amount = mysqli_real_escape_string($conn, clean_input($_POST["tourney-amount"]));
        $tourney_start_date = mysqli_real_escape_string($conn, clean_input($_POST["tourney-start-date"]));
        $tourney_start_time = mysqli_real_escape_string($conn, clean_input($_POST["tourney-start-time"]));
        $tourney_game_mode = mysqli_real_escape_string($conn, clean_input($_POST["tourney-game-mode"]));
        $tourney_rules = mysqli_real_escape_string($conn, clean_input($_POST["tourney-rules"]));

        if ($tourney_game === 'fifa_21' || $tourney_game === 'fortnite' || $tourney_game === 'clash_of_clans') {
            if ($tourney_console === 'ps4' || $tourney_console === 'pc' || $tourney_console === 'xbox' || $tourney_console === 'nintendo') {
                if (is_numeric($tourney_players) && ((intval($tourney_players, 10) % 2) === 0) && (intval($tourney_players, 10) >= 2)) {
                    $sql = "SELECT * FROM meta_data WHERE meta_key = 'min_challenge_amount' OR meta_key = 'max_challenge_amount'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ($row['meta_key'] === 'min_challenge_amount') ? ($min_challenge_amount = intval($row['meta_value'], 10)) : ($max_challenge_amount = intval($row['meta_value'], 10));
                        }
                    } else {
                        $min_challenge_amount = 0;
                        $max_challenge_amount = 0;
                    }

                    if (is_numeric($tourney_amount) && intval($tourney_amount, 10) >= $min_challenge_amount && intval($tourney_amount, 10) <= $max_challenge_amount) {
                        $sql2 = "SELECT CURDATE() AS current_date_alias";
                        $result2 = mysqli_query($conn, $sql2);

                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $current_date = $row2['current_date_alias'];
                            }
                        } else {
                            $current_date = '0000-00-00';
                        }

                        if ($tourney_start_date > $current_date) {
                            $tournament_by_id = $_SESSION['id'];

                            $sql3 = "SELECT * FROM users WHERE id = $tournament_by_id";
                            $result3 = mysqli_query($conn, $sql3);

                            if (mysqli_num_rows($result3) > 0) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    if ($row3['balance'] >= $tourney_amount) {
                                        $sql4 = "UPDATE users SET balance = (balance - $tourney_amount) WHERE id = $tournament_by_id";

                                        if (mysqli_query($conn, $sql4)) {
                                            $response_msg['status'] = 'success';
                                            $response_msg['description'] .= 'Success: Balance Updated Successfully!';

                                            $sql5 = "INSERT INTO tournaments_log (tournament_by, game, console, amount, players, start_date, start_time, game_mode, rules) VALUES ($tournament_by_id, '$tourney_game', '$tourney_console', $tourney_amount, $tourney_players, '$tourney_start_date', '$tourney_start_time', '$tourney_game_mode', '$tourney_rules')";

                                            if (mysqli_query($conn, $sql5)) {
                                                $response_msg['status'] = 'success';
                                                $response_msg['description'] .= 'Success: New tournament created successfully!';

                                                $tourney_id = mysqli_insert_id($conn);

                                                $sql6 = "INSERT INTO tourney_players (tourney_id, player_id) VALUES ($tourney_id, $tournament_by_id)";

                                                if (mysqli_query($conn, $sql6)) {
                                                    $response_msg['status'] = 'success';
                                                    $response_msg['description'] .= 'Success: Tournament entered successfully!';
                                                } else {
                                                    $response_msg['status'] = 'error';
                                                    $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                }
                                            } else {
                                                $response_msg['status'] = 'error';
                                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                            }
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                        }
                                    } else {
                                        $response_msg['status'] = 'error';
                                        $response_msg['description'] .= 'Error: Not enough balance to create tournament!';
                                    }
                                }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: Invalid Session ID! Please login again to continue!';
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] .= 'Error: Tournament date must greater than today!';
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] .= 'Error: Tournament amount must be between $' . $min_challenge_amount . ' and $' . $max_challenge_amount . '!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] .= 'Error: Even Number of Players Required! (Minimum 2)';
                }
            } else {
                $response_msg['status'] = 'error';
                $response_msg['description'] .= 'Error: Invalid tournament console!';
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] .= 'Error: Invalid tournament game!';
        }
    }
}

mysqli_close($conn);

echo json_encode($response_msg);
