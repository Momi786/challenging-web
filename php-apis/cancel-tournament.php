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
        $cancelling_player_id = $_SESSION['id'];
        $tourney_id = mysqli_real_escape_string($conn, clean_input($_POST["tourney-id"]));

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tourney_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($cancelling_player_id === $row['tournament_by']) {
                    if ($row['status'] === 'open' || $row['status'] === 'reset' || $row['status'] === 'ready') {
                        $sql2 = "UPDATE tournaments_log SET status = 'cancelled', cancelled_timestamp = NOW() WHERE tournament_id = $tourney_id";

                        if (mysqli_query($conn, $sql2)) {
                            $response_msg['status'] = 'success';
                            $success_msgs[] = 'Success: Tournament cancelled successfully!';

                            $sql3 = "SELECT * FROM tourney_players WHERE tourney_id = $tourney_id AND player_id <> $cancelling_player_id";
                            $result3 = mysqli_query($conn, $sql3);

                            if (mysqli_num_rows($result3) > 0) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $player_id = $row3['player_id'];

                                    $sql4 = "DELETE FROM tourney_players WHERE tourney_id = $tourney_id AND player_id = $player_id";

                                    if (mysqli_query($conn, $sql4)) {
                                        $tourney_amount = $row['amount'];

                                        $sql5 = "UPDATE users SET balance = (balance + $tourney_amount) WHERE id = $player_id";

                                        if (mysqli_query($conn, $sql5)) {
                                            $notif_msg = 'Tournament # ' . $tourney_id . ' was cancelled by its owner. The Tournament amount ($' . $tourney_amount . ') has been refunded back into your Balance.';

                                            $sql6 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($player_id, '$notif_msg')";

                                            if (mysqli_query($conn, $sql6)) {
                                                //echo "New record created successfully";
                                            } else {
                                                //echo "Error: " . $sql6 . "<br>" . mysqli_error($conn);
                                            }
                                        } else {
                                            //$response_msg['status'] = 'error';
                                            //$error_msgs[] = 'Error: ' . mysqli_error($conn);
                                        }
                                    } else {
                                        //$response_msg['status'] = 'error';
                                        //$error_msgs[] = 'Error: ' . mysqli_error($conn);
                                    }
                                }

                                $response_msg['status'] = 'success';
                                $success_msgs[] = 'Success: Tournament players removed successfully!';
                            } else {
                                $response_msg['status'] = 'success';
                                $success_msgs[] = 'Success: No Tournament players to remove!';
                            }

                            $sql7 = "DELETE FROM tourney_players WHERE tourney_id = $tourney_id AND player_id = $cancelling_player_id";

                            if (mysqli_query($conn, $sql7)) {
                                $tourney_amount = $row['amount'];

                                $sql8 = "SELECT * FROM service_fees WHERE $tourney_amount BETWEEN min_amount AND max_amount";
                                $result8 = mysqli_query($conn, $sql8);

                                if (mysqli_num_rows($result8) > 0) {
                                    while ($row8 = mysqli_fetch_assoc($result8)) {
                                        $service_fee = $row8['service_fee'];
                                        $service_fee_type = $row8['service_fee_type'];
                                    }
                                } else {
                                    $service_fee = 0;
                                    $service_fee_type = 'dollar';
                                }

                                if ($service_fee_type === 'dollar') {
                                    $refund_amount = $tourney_amount - $service_fee;
                                } else {
                                    $refund_amount = $tourney_amount - ($tourney_amount * ($service_fee / 100));
                                }

                                $sql9 = "UPDATE users SET balance = (balance + $refund_amount) WHERE id = $cancelling_player_id";

                                if (mysqli_query($conn, $sql9)) {
                                    $response_msg['status'] = 'success';
                                    $success_msgs[] = 'Success: The Tournament amount MINUS the Service Fee has been refunded back into your Balance! ($' . $tourney_amount . ' - $' . ($tourney_amount * ($service_fee / 100)) . ' = $' . $refund_amount . ')';
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
                            $error_msgs[] = 'Error: Unable to cancel Tournament! ' . mysqli_error($conn);
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $error_msgs[] = 'Error: Only Open, Reset or Ready Tournaments can be cancelled!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $error_msgs[] = 'Error: You cannot cancel this Tournament! Only the Tournament owner can cancel this Tournament.';
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
