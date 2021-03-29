<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = array();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    if (empty($_POST["withdrawal-method"]) || empty($_POST["withdrawal-amount"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] = 'All fields required!';
    } else {
        $user_id = $_SESSION['id'];
        $withdrawalMethod = mysqli_real_escape_string($conn, clean_input($_POST["withdrawal-method"]));

        if (isset($withdrawalMethod) && $withdrawalMethod === 'dummy') {
            $sql = "SELECT * FROM users WHERE id=$user_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $withdrawalAmount = mysqli_real_escape_string($conn, clean_input($_POST["withdrawal-amount"]));

                    if ($withdrawalAmount >= 20) {
                        if ($row['balance'] >= $withdrawalAmount) {
                            $newAmount = $row['balance'] - $withdrawalAmount;

                            $sql2 = "UPDATE users SET balance=$newAmount WHERE id=$user_id";

                            if (mysqli_query($conn, $sql2)) {
                                $response_msg['status'] = 'success';
                                $response_msg['description'] = 'Withdrawal Successfull!';

                                $method = 'Dummy Withdrawal';
                                $clientTime = mysqli_real_escape_string($conn, clean_input($_POST["client-time"]));

                                $sql3 = "INSERT INTO withdrawal_log (withdrawal_by, method, amount, withdrawal_status, client_date) VALUES ($user_id, '$method', $withdrawalAmount, 'Success', '$clientTime')";

                                if (mysqli_query($conn, $sql3)) {
                                    //echo "Log created successfully";
                                } else {
                                    //echo "Error: " . mysqli_error($conn);
                                }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] = "Error updating record: " . mysqli_error($conn);
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] = 'Withdrawal Amount Greater than Balance!';
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] = 'Minimum $20 Withdrawal Required!';
                    }
                }
            } else {
                $response_msg['status'] = 'error';
                $response_msg['description'] = 'Invalid Session ID! Please login again to continue!';
            }
        } else {
            $response_msg['status'] = 'error';
            $response_msg['description'] = 'Invalid Withdrawal Method!';
        }
    }
} else {
    $response_msg['status'] = 'error';
    $response_msg['description'] = 'Session ID missing! Please login again to continue!';
}

mysqli_close($conn);

echo json_encode($response_msg);
