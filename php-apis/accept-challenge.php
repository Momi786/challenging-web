<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

$response_msg['status'] = '';
$response_msg['description'] = '';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (empty($_POST["challenge-id"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] = 'Challenge ID missing!';
    } else {
        $accept_by_id = $_SESSION['id'];
        $challenge_id = mysqli_real_escape_string($conn, clean_input($_POST["challenge-id"]));

        $sql = "SELECT * FROM challenges_log WHERE challenge_id = $challenge_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($accept_by_id === $row['challenge_by']) {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] = 'Error: You Cannot Accept Your Own Challenge!';
                } else {
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

                        if (($row['challenge_date'] . ' ' . $row['challenge_time']) >= $now_timestamp) {
                            $sql2 = "SELECT * FROM users WHERE id = $accept_by_id";
                            $result2 = mysqli_query($conn, $sql2);

                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    if ($row2['balance'] >= $row['amount']) {
                                        $challenge_amount = $row['amount'];

                                        $sql3 = "UPDATE users SET balance = (balance - $challenge_amount) WHERE id = $accept_by_id";

                                        if (mysqli_query($conn, $sql3)) {
                                            $response_msg['status'] = 'success';
                                            $response_msg['description'] = 'Success: Balance Updated Successfully!';

                                            $sql4 = "UPDATE challenges_log SET status = 'accepted', accepted_by = $accept_by_id, accepted_timestamp = NOW() WHERE challenge_id = $challenge_id";

                                            if (mysqli_query($conn, $sql4)) {
                                                $response_msg['description'] .= ' Success: Challenge Accepted Successfully! Waiting for Challenge owners\'s confirmation!';

                                                $notif_for = $row['challenge_by'];
                                                $notif_msg = strtoupper($row2['username']) . ' has accepted your Challenge! Waiting for your confirmation. Challenge ID: ' . $challenge_id . '.';

                                                $sql5 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                                if (mysqli_query($conn, $sql5)) {
                                                    //echo "New record created successfully";
                                                } else {
                                                    //echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
                                                }
                                            } else {
                                                $response_msg['status'] = 'error';
                                                $response_msg['description'] = 'Error: ' . mysqli_error($conn);
                                            }
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] = 'Error: ' . mysqli_error($conn);
                                        }
                                    } else {
                                        $response_msg['status'] = 'error';
                                        $response_msg['description'] = 'Error: Insufficient Balance for Accepting Challenge!';
                                    }
                                }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] = 'Error: Invalid User ID! Please login again to continue!';
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] .= 'Error: Challenge date time has been exceeded! This Challenge can no longer be Accepted!';

                            $sql4 = "UPDATE challenges_log SET status = 'reset', reset_timestamp = NOW(), comments = 'Challenge date time exceeded' WHERE challenge_id = $challenge_id";

                            if (mysqli_query($conn, $sql4)) {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: Challenge Reset! The Challenge owner will have to Re-Open the Challenge.';

                                $challenge_amount = $row['amount'];

                                $sql5 = "SELECT * FROM service_fees WHERE $challenge_amount BETWEEN min_amount AND max_amount";
                                $result5 = mysqli_query($conn, $sql5);

                                if (mysqli_num_rows($result5) > 0) {
                                    while ($row5 = mysqli_fetch_assoc($result5)) {
                                        $service_fee = $row5['service_fee'];
                                        $service_fee_type = $row5['service_fee_type'];
                                    }
                                } else {
                                    $service_fee = 0;
                                    $service_fee_type = 'dollar';
                                }

                                $challenge_by = $row['challenge_by'];

                                if ($service_fee_type === 'dollar') {
                                    $refund_amount = $challenge_amount - $service_fee;
                                    //$refund_msg = 'The Challenge amount MINUS the service fee has been refunded to the Challenge owner. ($' . $challenge_amount . ' - $' . $service_fee . ') = $' . $refund_amount;
                                } else {
                                    $refund_amount = $challenge_amount - ($challenge_amount * ($service_fee / 100));
                                    //$refund_msg = 'The Challenge amount MINUS the service fee has been refunded to the Challenge owner. ($' . $challenge_amount . ' - ' . $service_fee . '%) = $' . $refund_amount;
                                }

                                $sql6 = "UPDATE users SET balance = (balance + $refund_amount) WHERE id = $challenge_by";

                                if (mysqli_query($conn, $sql6)) {
                                    //$response_msg['status'] = 'error';
                                    //$response_msg['description'] .= $refund_msg;

                                    $notif_for = $challenge_by;
                                    $notif_msg = 'Challenge # ' . $row['challenge_id'] . ' has been Reset because a player Accepted your Challenge after the set Challenge date and time. You can re-open the Challenge from your Challenges page. The Challenge amount MINUS the service fee has been refunded back into your Balance.';

                                    $sql7 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                    if (mysqli_query($conn, $sql7)) {
                                        //$response_msg['status'] = 'success';
                                        //$response_msg['description'] .= 'Success: Notification sent successfully!';
                                    } else {
                                        //$response_msg['status'] = 'error';
                                        //$response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                    }
                                } else {
                                    $response_msg['status'] = 'error';
                                    $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                            }
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] = 'Error: Challenge Is No Longer Open!';
                    }
                }
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] = 'Error: Invalid Challenge ID!';
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] = 'Error: Session ID missing! Please login again to continue!';
}

mysqli_close($conn);

echo json_encode($response_msg);
