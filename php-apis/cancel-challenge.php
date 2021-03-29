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
    if (empty($_POST["challenge-id"]) || is_null($_POST["challenge-id"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] .= 'Error: Challenge ID missing!';
    } else {
        $cancel_by_id = $_SESSION['id'];
        $challenge_id = mysqli_real_escape_string($conn, clean_input($_POST["challenge-id"]));

        $sql = "SELECT * FROM challenges_log WHERE challenge_id = $challenge_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['challenge_by'] === $cancel_by_id) {
                    if ($row['status'] === 'open' || $row['status'] === 'reset' || $row['status'] === 'accepted') {
                        $sql2 = "UPDATE challenges_log SET status = 'cancelled', cancelled_timestamp = NOW(), comments = 'Challenge cancelled by owner' WHERE challenge_id = $challenge_id";

                        if (mysqli_query($conn, $sql2)) {
                            $response_msg['status'] = 'success';
                            $response_msg['description'] .= 'Success: Challenge cancelled successfully!';

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
                            $accepted_by = $row['accepted_by'];

                            if ($service_fee_type === 'dollar') {
                                $refund_amount = $challenge_amount - $service_fee;
                                $refund_msg = 'The Challenge amount MINUS the service fee has been refunded. ($' . $challenge_amount . ' - $' . $service_fee . ') = $' . $refund_amount;
                            } else {
                                $refund_amount = $challenge_amount - ($challenge_amount * ($service_fee / 100));
                                $refund_msg = 'The Challenge amount MINUS the service fee has been refunded. ($' . $challenge_amount . ' - ' . $service_fee . '%) = $' . $refund_amount;
                            }

                            if ($row['status'] === 'open' || $row['status'] === 'reset') {
                                $sql6 = "UPDATE users SET balance = (balance + $refund_amount) WHERE id = $challenge_by";
                            } else {
                                $sql6 = "UPDATE users SET balance = (balance + $refund_amount) WHERE id = $challenge_by OR id = $accepted_by";
                            }

                            if (mysqli_query($conn, $sql6)) {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= $refund_msg;

                                if ($row['status'] === 'accepted') {
                                    $notif_for = $accepted_by;
                                    $notif_msg = 'Challenge # ' . $row['challenge_id'] . ' has been Cancelled by its owner. The Challenge amount MINUS the service fee has been refunded back into your Balance.';

                                    $sql7 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                    if (mysqli_query($conn, $sql7)) {
                                        //$response_msg['status'] = 'success';
                                        //$response_msg['description'] .= 'Success: Notification sent successfully!';
                                    } else {
                                        //$response_msg['status'] = 'error';
                                        //$response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                    }
                                } else {
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
                        $response_msg['description'] .= 'Error: Only Open, Reset or Accepted Challenges can be cancelled!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] .= 'Error: You cannot cancel this Challenge! Only the Challenge owner can cancel this Challenge!';
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
