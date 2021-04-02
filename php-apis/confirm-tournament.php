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
        $confirming_player_id = $_SESSION['id'];
        $tourney_id = mysqli_real_escape_string($conn, clean_input($_POST["tourney-id"]));

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tourney_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($confirming_player_id === $row['tournament_by']) {
                    if ($row['status'] === 'ready') {
                        $sql1 = "SELECT NOW() AS now_timestamp";
                        $result1 = mysqli_query($conn, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $now_timestamp = $row1['now_timestamp'];
                            }
                        } else {
                            $now_timestamp = '0000-00-00 00:00:00';
                        }
                            $tourneyId = $_POST["tourney-id"];
                        if (($row['start_date'] . ' ' . $row['start_time']) >= $now_timestamp) {
                            // New Code Start
                                $sql2 = "UPDATE tournaments_log SET status = 'confirmed' , confirmed_timestamp = NOW() WHERE tournament_id = $tourneyId";

                                if (mysqli_query($conn, $sql2)) {
                                    $response_msg['status'] = 'success';
                                    $response_msg['description'] .= 'Success: Tournament confirmed successfully!';

                                    $notif_msg = 'Tournament # ' . $row['tournament_id'] . ' has been confirmed by its owner. Your Tournament is set to be played on: ' . $row['start_date'] . ' ' . $row['start_time'];

                                    $query1 = "SELECT * from tourney_players where tourney_id='$tourneyId'";
                                    $result1 = mysqli_query($conn,$query1);
                                    $count1 = mysqli_num_rows($result1);
                                    for ($i=0; $i < $count1 ; $i++) { 
                                        $data12 = mysqli_fetch_assoc($result1);
                                        $notif_for = $data12['player_id'];
                                    
                                        $sql3 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                        if (mysqli_query($conn, $sql3)) {
                                            $response_msg['status'] = 'success';
                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                        }
                                    }
                                } else {
                                    $response_msg['status'] = 'error';
                                    $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                }
                            // New Code End
                        } else {
                          // New Code Start

                            $response_msg['status'] = 'error';
                            $response_msg['description'] .= 'Error: Tournament date time has been exceeded! This Tournament can no longer be Confirmed!';

                            $sql4 = "UPDATE tournaments_log SET status = 'reset', reset_timestamp = NOW(), comments = 'Tournament date time exceeded' WHERE tournament_id = $tourneyId";

                            if (mysqli_query($conn, $sql4)) {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: Tournament Reset! You will have to Re-Open this Tournament.';

                                    $notif_msg = 'Tournament # ' . $row['tournament_id'] . ' has been Exired because no one start the tournament.';

                                    $query1 = "SELECT * from tourney_players where tourney_id='$tourneyId'";
                                    $result1 = mysqli_query($conn,$query1);
                                    $count1 = mysqli_num_rows($result1);
                                    for ($i=0; $i < $count1 ; $i++) { 
                                        $data12 = mysqli_fetch_assoc($result1);
                                        $notif_for = $data12['player_id'];
                                    
                                        $sql8 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                        if (mysqli_query($conn, $sql8)) {
                                            $response_msg['status'] = 'success';
                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                        }
                                    }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                            }
                            // New Code End
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $error_msgs[] = 'Error: Only Ready Tournaments can be Confirmed!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $error_msgs[] = 'Error: You cannot Confirm this Tournament! Only the Tournament owner can Confirm this Tournament.';
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
