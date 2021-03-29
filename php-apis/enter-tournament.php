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
    if (empty($_POST["tourney-id"]) || is_null($_POST["tourney-id"])) {
        $response_msg['status'] = 'error';
        $error_msgs[] = 'Error: Tournament ID Missing!';
    } else {
        $entering_player_id = $_SESSION['id'];
        $tourney_id = mysqli_real_escape_string($conn, clean_input($_POST["tourney-id"]));

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tourney_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['status'] === 'open') {
                    $sql1 = "SELECT NOW() AS now_timestamp";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $now_timestamp = $row1['now_timestamp'];
                        }
                    } else {
                        $now_timestamp = '0000-00-00 00:00:00';
                    }

                    if (($row['start_date'] . ' ' . $row['start_time']) >= $now_timestamp) {
                        $sql4 = "SELECT COUNT(*) AS entered_players FROM tourney_players WHERE tourney_id = $tourney_id";
                        $result4 = mysqli_query($conn, $sql4);

                        if (mysqli_num_rows($result4) > 0) {
                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                if ($row['players'] > $row4['entered_players']) {
                                    $sql2 = "SELECT * FROM tourney_players WHERE tourney_id = $tourney_id AND player_id = $entering_player_id";
                                    $result2 = mysqli_query($conn, $sql2);

                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $response_msg['status'] = 'error';
                                            $error_msgs[] = 'Error: You have already entered in this Tournament!';
                                        }
                                    } else {
                                        $sql3 = "SELECT * FROM users WHERE id = $entering_player_id";
                                        $result3 = mysqli_query($conn, $sql3);

                                        if (mysqli_num_rows($result3) > 0) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                if ($row3['balance'] >= $row['amount']) {
                                                    $tourney_amount = $row['amount'];

                                                    $sql5 = "UPDATE users SET balance = (balance - $tourney_amount) WHERE id = $entering_player_id";

                                                    if (mysqli_query($conn, $sql5)) {
                                                        $response_msg['status'] = 'success';
                                                        $success_msgs[] = 'Success: Balance updated successfully!';

                                                        $sql6 = "INSERT INTO tourney_players (tourney_id, player_id) VALUES ($tourney_id, $entering_player_id)";

                                                        if (mysqli_query($conn, $sql6)) {
                                                            $response_msg['status'] = 'success';
                                                            $success_msgs[] = 'Success: Tournament entered successfully!';

                                                            $sql7 = "SELECT COUNT(*) AS entered_players FROM tourney_players WHERE tourney_id = $tourney_id";
                                                            $result7 = mysqli_query($conn, $sql7);

                                                            if (mysqli_num_rows($result7) > 0) {
                                                                while ($row7 = mysqli_fetch_assoc($result7)) {
                                                                    if ($row7['entered_players'] >= $row['players']) {
                                                                        $sql8 = "UPDATE tournaments_log SET status = 'ready', ready_timestamp = NOW() WHERE tournament_id = $tourney_id";

                                                                        if (mysqli_query($conn, $sql8)) {
                                                                            $response_msg['status'] = 'success';
                                                                            $success_msgs[] = 'Success: Tournament ready to be confirmed by its Owner!';

                                                                            $notif_for = $row['tournament_by'];
                                                                            $notif_msg = 'The number of players in your Tournament are full. Go to your Tournaments page to confirm the Tournament. Tournament # ' . $tourney_id;

                                                                            $sql8 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                                                            if (mysqli_query($conn, $sql8)) {
                                                                                $response_msg['status'] = 'success';
                                                                                $success_msgs[] = 'Success: Confirmation notification sent to the Tournament Owner!';
                                                                            } else {
                                                                                $response_msg['status'] = 'error';
                                                                                $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                                                            }
                                                                        } else {
                                                                            $response_msg['status'] = 'error';
                                                                            $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                                                        }
                                                                    } else {
                                                                    }
                                                                }
                                                            } else {
                                                                $response_msg['status'] = 'error';
                                                                $error_msgs[] = 'Error: Invalid Tournament ID!';
                                                            }
                                                        } else {
                                                            $response_msg['status'] = 'error';
                                                            $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                                        }
                                                    } else {
                                                        $response_msg['status'] = 'error';
                                                        $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                                    }
                                                } else {
                                                    $response_msg['status'] = 'error';
                                                    $error_msgs[] = 'Error: You dont have enough Balance to enter in this Tournament!';
                                                }
                                            }
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $error_msgs[] = 'Error: Invalid Session ID! Please login again to continue.';
                                        }
                                    }
                                } else {
                                    $response_msg['status'] = 'error';
                                    $error_msgs[] = 'Error: Tournament players limit reached!';
                                }
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $error_msgs[] = 'Error: Invalid Tournament ID!';
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $error_msgs[] = 'Error: Tournament start date and time exceeded!';

                        $sql4 = "UPDATE tournaments_log SET status = 'reset', reset_timestamp = NOW() WHERE tournament_id = $tourney_id";

                        if (mysqli_query($conn, $sql4)) {
                            $response_msg['status'] = 'error';
                            $error_msgs[] = 'Error: Tournament has been reset!';

                            $notif_for = $row['tournament_by'];
                            $notif_msg = 'Your Tournament has been Reset! You can Re-Open your Tournament from your Tournaments page. Tournament # ' . $tourney_id;

                            $sql10 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                            if (mysqli_query($conn, $sql10)) {
                                //echo "New record created successfully";
                            } else {
                                // $response_msg['status'] = 'error';
                                // $error_msgs[] = 'Error: ' . mysqli_error($conn);
                            }

                            $tournament_by = $row['tournament_by'];

                            $sql5 = "SELECT * FROM tourney_players WHERE tourney_id = $tourney_id AND player_id <> $tournament_by";
                            $result5 = mysqli_query($conn, $sql5);

                            if (mysqli_num_rows($result5) > 0) {
                                $tourney_amount = $row['amount'];

                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                    $tourney_player = $row5['player_id'];

                                    $sql6 = "DELETE FROM tourney_players WHERE tourney_id = $tourney_id AND player_id = $tourney_player";

                                    if (mysqli_query($conn, $sql6)) {
                                        $notif_for = $tourney_player;
                                        $notif_msg = 'Tournament # ' . $tourney_id . ' has been Reset. You have been removed from the Tournament.';

                                        $sql7 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                        if (mysqli_query($conn, $sql7)) {
                                            //echo "New record created successfully";
                                        } else {
                                            // $response_msg['status'] = 'error';
                                            // $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                        }

                                        $sql8 = "UPDATE users SET balance = (balance + $tourney_amount) WHERE id = $tourney_player";

                                        if (mysqli_query($conn, $sql8)) {
                                            $notif_for = $tourney_player;
                                            $notif_msg = 'Tournament # ' . $tourney_id . ' amount ($' . $tourney_amount . ') has been refunded back into your Balance!';

                                            $sql9 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                            if (mysqli_query($conn, $sql9)) {
                                                //echo "New record created successfully";
                                            } else {
                                                // $response_msg['status'] = 'error';
                                                // $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                            }
                                        } else {
                                            //echo "Error updating record: " . mysqli_error($conn);
                                        }
                                    } else {
                                        // $response_msg['status'] = 'error';
                                        // $error_msgs[] = 'Error: ' . mysqli_error($conn);
                                    }
                                }
                            } else {
                                // $response_msg['status'] = 'error';
                                // $error_msgs[] = 'Error: Invalid Tournament ID or player ID!';
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $error_msgs[] = 'Error: ' . mysqli_error($conn);
                        }
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $error_msgs[] = 'Error: Tournament not in Open state!';
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
