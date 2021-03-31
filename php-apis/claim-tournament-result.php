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
    if (empty($_POST["challenge-id"]) || is_null($_POST["challenge-id"]) || empty($_POST["claimed-result"]) || is_null($_POST["claimed-result"])) {
        $response_msg['status'] = 'error';
        $response_msg['description'] .= 'Error: Required fields missing!';
    } else {
        $claim_by_id = $_SESSION['id'];
        $challenge_id = $_POST["challenge-id"];
        $claimed_result = $_POST["claimed-result"];

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id  = $challenge_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $sql21 = "SELECT * FROM tourney_players WHERE player_id  = $claim_by_id";
            $result21 = mysqli_query($conn, $sql21);
            $row21 = mysqli_fetch_assoc($result21);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row21['player_id'] === $claim_by_id) {
                    if ($row['status'] === 'confirmed') {
                        // if ($claim_by_id === $row['challenge_by']) {
                        //     $claim_by_claimed_result = $row['challenge_by_claimed_result'];
                        //     $claim_by_claim_timestamp = $row['challenge_by_claim_timestamp'];
                        // } else {
                        //     $claim_by_claimed_result = $row['accepted_by_claimed_result'];
                        //     $claim_by_claim_timestamp = $row['accepted_by_claim_timestamp'];
                        // }

                        if (2==2) {
                            $sql1 = "SELECT NOW() AS now_timestamp";
                            $result1 = mysqli_query($conn, $sql1);

                            if (mysqli_num_rows($result1) > 0) {
                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                    $now_timestamp = $row1['now_timestamp'];
                                }
                            } else {
                                $now_timestamp = '0000-00-00 00:00:00';
                            }
                            $tablePlayId = $row21['serial_number'];
                            if($tablePlayId%2 == 0){
                                $findTableId = $tablePlayId-1;
                                $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                            }else{
                                $findTableId = $tablePlayId+1;
                                $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                            }
                            $result4 = mysqli_query($conn, $sql4);
                            
                                $row4 = mysqli_fetch_assoc($result4);
                                $sql24 = "SELECT * FROM tourney_players WHERE serial_number  = $tablePlayId";
                                $result24 = mysqli_query($conn, $sql24);
                                $row24 = mysqli_fetch_assoc($result24);
                            if ($now_timestamp >= ($row['start_date'] . ' ' . $row['start_time'])) {
                                $challenge_date = new DateTime($row['start_date'] . ' ' . $row['start_time']);
                                $challenge_datetime_plus_1_hour = $challenge_date->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s');

                                if ($now_timestamp <= $challenge_datetime_plus_1_hour) {
                                    if ($claim_by_id === $row21['player_id']) {
                                        $sql2 = "UPDATE tourney_players SET result = '$claimed_result', claim_timestamp = NOW() WHERE player_id = $claim_by_id";
                                    } else {
                                        $sql2 = "UPDATE tourney_players SET result = '$claimed_result', claim_timestamp = NOW() WHERE challenge_id = $challenge_id";
                                    }

                                    if (mysqli_query($conn, $sql2)) {
                                        $response_msg['status'] = 'success';
                                        $response_msg['description'] .= 'Success: Tournament match result claimed successfully!';

                                        //Send Notification to Opponent----------------------------------------------------------------------------------------------------------

                                        $notif_for = $claim_by_id;
                                        $notif_msg = 'Your Opponent have claimed their result for Tournament # ' . $row['tournament_id'] . '.';

                                        $sql3 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                        if (mysqli_query($conn, $sql3)) {
                                            $response_msg['status'] = 'success';
                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                        }

                                        //Determine Challenge Result-------------------------------------------------------------------------------------------------------------
                                        $tablePlayId = $row21['serial_number'];
                                        if($tablePlayId%2 == 0){
                                            $findTableId = $tablePlayId-1;
                                            $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                                        }else{
                                            $findTableId = $tablePlayId+1;
                                            $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                                        }
                                        $result4 = mysqli_query($conn, $sql4);
                                        
                                        if (mysqli_num_rows($result4) > 0) {
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql24 = "SELECT * FROM tourney_players WHERE serial_number  = $tablePlayId";
                                            $result24 = mysqli_query($conn, $sql24);
                                            $row24 = mysqli_fetch_assoc($result24);
                                                if (empty($row24['result']) || is_null($row24['result']) || empty($row4['result']) || is_null($row4['result']) ) {
                                                } else {
                                                    if (($row4['result'] === 'win' && $row24['result'] === 'loss') || ($row4['result'] === 'loss' && $row24['result'] === 'win')) {
                                                        $challenge_result = 'completed';
                                                    } elseif ($row4['result'] === 'tie' && $row24['result'] === 'tie') {
                                                        $challenge_result = 'tie';
                                                    } else {
                                                        $challenge_result = 'disputed';
                                                    }

                                                    $sql5 = "UPDATE tourney_players SET result = '$challenge_result', end_timestamp = NOW() WHERE serial_number  = $findTableId";
                                                    $sql25 = "UPDATE tourney_players SET result = '$challenge_result', end_timestamp = NOW() WHERE serial_number   = $tablePlayId";
                                                    mysqli_query($conn, $sql25);
                                                    if (mysqli_query($conn, $sql5)) {
                                                        $response_msg['status'] = 'success';
                                                        $response_msg['description'] .= 'Success: Tournament match ended successfully!';

                                                        //Send Notification to Opponent------------------------------------------------------------------------------------------

                                                        $notif_for = $claim_by_id;
                                                        $notif_msg = 'Tournament # ' . $row4['tourney_id'] . ' has ended.';

                                                        $sql3 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                                        if (mysqli_query($conn, $sql3)) {
                                                            $response_msg['status'] = 'success';
                                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                                        } else {
                                                            $response_msg['status'] = 'error';
                                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                        }

                                                        //Prize Distribution-----------------------------------------------------------------------------------------------------

                                                        // if ($challenge_result === 'completed' || $challenge_result === 'tie') {
                                                        //     $total_challenge_amount = ($row4['amount'] * 2);

                                                        //     $sql6 = "SELECT * FROM service_fees WHERE $total_challenge_amount BETWEEN min_amount AND max_amount";
                                                        //     $result6 = mysqli_query($conn, $sql6);

                                                        //     if (mysqli_num_rows($result6) > 0) {
                                                        //         while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        //             $service_fee = $row6['service_fee'];
                                                        //             $service_fee_type = $row6['service_fee_type'];
                                                        //         }
                                                        //     } else {
                                                        //         $service_fee = 0;
                                                        //         $service_fee_type = 'dollar';
                                                        //     }

                                                        //     if ($challenge_result === 'completed') {
                                                        //         if ($service_fee_type === 'dollar') {
                                                        //             $prize_amount = $total_challenge_amount - $service_fee;
                                                        //         } else {
                                                        //             $prize_amount = $total_challenge_amount - ($total_challenge_amount * ($service_fee / 100));
                                                        //         }

                                                        //         $winner_id = ($row4['challenge_by_claimed_result'] === 'win') ? ($row4['challenge_by']) : ($row4['accepted_by']);

                                                        //         $sql7 = "UPDATE users SET balance = (balance + $prize_amount) WHERE id = $winner_id";
                                                        //     } else {
                                                        //         if ($service_fee_type === 'dollar') {
                                                        //             $prize_amount = $total_challenge_amount - $service_fee;
                                                        //         } else {
                                                        //             $prize_amount = $total_challenge_amount - ($total_challenge_amount * ($service_fee / 100));
                                                        //         }
                                                        //         $prize_amount = ($prize_amount / 2);

                                                        //         $challenge_by = $row4['challenge_by'];
                                                        //         $accepted_by = $row4['accepted_by'];

                                                        //         $sql7 = "UPDATE users SET balance = (balance + $prize_amount) WHERE id = $challenge_by OR id = $accepted_by";
                                                        //     }

                                                        //     if (mysqli_query($conn, $sql7)) {
                                                        //         $response_msg['status'] = 'success';
                                                        //         $response_msg['description'] .= 'Success: Challenge Prize Distributed Successfully!';
                                                        //     } else {
                                                        //         $response_msg['status'] = 'error';
                                                        //         $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                        //     }
                                                        // } else {
                                                        // }

                                                        //Player Skill Points Calculation----------------------------------------------------------------------------------------

                                                        if ($challenge_result === 'completed') {
                                                            $sql8 = "SELECT * FROM meta_data WHERE meta_key = 'win_loss_points_difference'";
                                                            $result8 = mysqli_query($conn, $sql8);

                                                            if (mysqli_num_rows($result8) > 0) {
                                                                while ($row8 = mysqli_fetch_assoc($result8)) {
                                                                    $win_loss_points_difference = intval($row8['meta_value'], 10);
                                                                }
                                                            } else {
                                                                $win_loss_points_difference = 0;
                                                            }

                                                            if ($row4['result'] === 'win') {
                                                                $won_by = $row4['player_id'];
                                                                $lost_by = $row24['player_id'];
                                                            } else {
                                                                $won_by = $row24['player_id'];
                                                                $lost_by = $row4['player_id'];
                                                            }

                                                            $sql9 = "UPDATE users SET skill_points = (skill_points + $win_loss_points_difference) WHERE id = $won_by";

                                                            if (mysqli_query($conn, $sql9)) {
                                                                $response_msg['status'] = 'success';
                                                                $response_msg['description'] .= 'Success: ' . $win_loss_points_difference . ' Skill Points Added to the winner!';
                                                            } else {
                                                                $response_msg['status'] = 'error';
                                                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                            }

                                                            $sql10 = "UPDATE users SET skill_points = (skill_points - $win_loss_points_difference) WHERE id = $lost_by";

                                                            if (mysqli_query($conn, $sql10)) {
                                                                $response_msg['status'] = 'success';
                                                                $response_msg['description'] .= 'Success: ' . $win_loss_points_difference . ' Skill Points Subtracted from the loser!';
                                                            } else {
                                                                $response_msg['status'] = 'error';
                                                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                            }
                                                        } else {
                                                        }
                                                    } else {
                                                        $response_msg['status'] = 'error';
                                                        $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                    }
                                                }
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: Invalid Challenge ID!';
                                        }
                                    } else {
                                        $response_msg['status'] = 'error';
                                        $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                    }
                                } else {
                                    $response_msg['status'] = 'error';
                                    $response_msg['description'] .= 'Error: You have failed to declare your Challenge result within one (1) hour of the set Challenge date and time!';

                                    if ($claim_by_id === $row4['player_id']) {
                                        $iddd = $row4['serial_number'];
                                        $sql2 = "UPDATE tourney_players SET result = 'loss', claim_timestamp = NOW() WHERE serial_number  = $iddd";
                                    } else {
                                        $iddd = $row24['serial_number'];
                                        $sql2 = "UPDATE tourney_players SET result = 'loss', claim_timestamp = NOW() WHERE serial_number  = $iddd";
                                    }

                                    if (mysqli_query($conn, $sql2)) {
                                        $response_msg['status'] = 'error';
                                        $response_msg['description'] .= 'Error: A loss has been declared for You!';

                                        //Send Notification to Opponent----------------------------------------------------------------------------------------------------------

                                        $notif_for = $claim_by_id;
                                        $notif_msg = 'Your Opponent have claimed their result for Tournament # ' . $row['tournament_id'] . '.';

                                        $sql3 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                        if (mysqli_query($conn, $sql3)) {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                        }

                                        //Determine Challenge Result-------------------------------------------------------------------------------------------------------------
                                        $tablePlayId = $row21['serial_number'];
                                        if($tablePlayId%2 == 0){
                                            $findTableId = $tablePlayId-1;
                                            $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                                        }else{
                                            $findTableId = $tablePlayId+1;
                                            $sql4 = "SELECT * FROM tourney_players WHERE serial_number = $findTableId";
                                        }
                                        $result4 = mysqli_query($conn, $sql4);
                                        
                                        if (mysqli_num_rows($result4) > 0) {
                                            $row4 = mysqli_fetch_assoc($result4);
                                            $sql24 = "SELECT * FROM tourney_players WHERE serial_number  = $tablePlayId";
                                            $result24 = mysqli_query($conn, $sql24);
                                            $row24 = mysqli_fetch_assoc($result24);
                                                if (empty($row24['result']) || is_null($row24['result']) || empty($row4['result']) || is_null($row4['result']) ) {
                                                } else {
                                                    if (($row4['result'] === 'win' && $row24['result'] === 'loss') || ($row4['result'] === 'loss' && $row24['result'] === 'win')) {
                                                        $challenge_result = 'completed';
                                                    } elseif ($row4['result'] === 'tie' && $row24['result'] === 'tie') {
                                                        $challenge_result = 'tie';
                                                    } else {
                                                        $challenge_result = 'disputed';
                                                    }

                                                    $sql5 = "UPDATE tourney_players SET result = '$challenge_result', end_timestamp = NOW() WHERE serial_number  = $findTableId";
                                                    $sql25 = "UPDATE tourney_players SET result = '$challenge_result', end_timestamp = NOW() WHERE serial_number   = $tablePlayId";
                                                    mysqli_query($conn, $sql25);
                                                    if (mysqli_query($conn, $sql5)) {
                                                        $response_msg['status'] = 'success';
                                                        $response_msg['description'] .= 'Success: Tournament match ended successfully!';

                                                        //Send Notification to Opponent------------------------------------------------------------------------------------------

                                                        $notif_for = $claim_by_id;
                                                        $notif_msg = 'Tournament # ' . $row4['tourney_id'] . ' has ended.';

                                                        $sql3 = "INSERT INTO notifications (notif_for, notif_msg) VALUES ($notif_for, '$notif_msg')";

                                                        if (mysqli_query($conn, $sql3)) {
                                                            $response_msg['status'] = 'success';
                                                            $response_msg['description'] .= 'Success: Notification sent successfully!';
                                                        } else {
                                                            $response_msg['status'] = 'error';
                                                            $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                        }

                                                        //Prize Distribution-----------------------------------------------------------------------------------------------------

                                                        // if ($challenge_result === 'completed' || $challenge_result === 'tie') {
                                                        //     $total_challenge_amount = ($row4['amount'] * 2);

                                                        //     $sql6 = "SELECT * FROM service_fees WHERE $total_challenge_amount BETWEEN min_amount AND max_amount";
                                                        //     $result6 = mysqli_query($conn, $sql6);

                                                        //     if (mysqli_num_rows($result6) > 0) {
                                                        //         while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        //             $service_fee = $row6['service_fee'];
                                                        //             $service_fee_type = $row6['service_fee_type'];
                                                        //         }
                                                        //     } else {
                                                        //         $service_fee = 0;
                                                        //         $service_fee_type = 'dollar';
                                                        //     }

                                                        //     if ($challenge_result === 'completed') {
                                                        //         if ($service_fee_type === 'dollar') {
                                                        //             $prize_amount = $total_challenge_amount - $service_fee;
                                                        //         } else {
                                                        //             $prize_amount = $total_challenge_amount - ($total_challenge_amount * ($service_fee / 100));
                                                        //         }

                                                        //         $winner_id = ($row4['challenge_by_claimed_result'] === 'win') ? ($row4['challenge_by']) : ($row4['accepted_by']);

                                                        //         $sql7 = "UPDATE users SET balance = (balance + $prize_amount) WHERE id = $winner_id";
                                                        //     } else {
                                                        //         if ($service_fee_type === 'dollar') {
                                                        //             $prize_amount = $total_challenge_amount - $service_fee;
                                                        //         } else {
                                                        //             $prize_amount = $total_challenge_amount - ($total_challenge_amount * ($service_fee / 100));
                                                        //         }
                                                        //         $prize_amount = ($prize_amount / 2);

                                                        //         $challenge_by = $row4['challenge_by'];
                                                        //         $accepted_by = $row4['accepted_by'];

                                                        //         $sql7 = "UPDATE users SET balance = (balance + $prize_amount) WHERE id = $challenge_by OR id = $accepted_by";
                                                        //     }

                                                        //     if (mysqli_query($conn, $sql7)) {
                                                        //         $response_msg['status'] = 'success';
                                                        //         $response_msg['description'] .= 'Success: Challenge Prize Distributed Successfully!';
                                                        //     } else {
                                                        //         $response_msg['status'] = 'error';
                                                        //         $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                        //     }
                                                        // } else {
                                                        // }

                                                        //Player Skill Points Calculation----------------------------------------------------------------------------------------

                                                        if ($challenge_result === 'completed') {
                                                            $sql8 = "SELECT * FROM meta_data WHERE meta_key = 'win_loss_points_difference'";
                                                            $result8 = mysqli_query($conn, $sql8);

                                                            if (mysqli_num_rows($result8) > 0) {
                                                                while ($row8 = mysqli_fetch_assoc($result8)) {
                                                                    $win_loss_points_difference = intval($row8['meta_value'], 10);
                                                                }
                                                            } else {
                                                                $win_loss_points_difference = 0;
                                                            }

                                                            if ($row4['result'] === 'win') {
                                                                $won_by = $row4['player_id'];
                                                                $lost_by = $row24['player_id'];
                                                            } else {
                                                                $won_by = $row24['player_id'];
                                                                $lost_by = $row4['player_id'];
                                                            }

                                                            $sql9 = "UPDATE users SET skill_points = (skill_points + $win_loss_points_difference) WHERE id = $won_by";

                                                            if (mysqli_query($conn, $sql9)) {
                                                                $response_msg['status'] = 'success';
                                                                $response_msg['description'] .= 'Success: ' . $win_loss_points_difference . ' Skill Points Added to the winner!';
                                                            } else {
                                                                $response_msg['status'] = 'error';
                                                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                            }

                                                            $sql10 = "UPDATE users SET skill_points = (skill_points - $win_loss_points_difference) WHERE id = $lost_by";

                                                            if (mysqli_query($conn, $sql10)) {
                                                                $response_msg['status'] = 'success';
                                                                $response_msg['description'] .= 'Success: ' . $win_loss_points_difference . ' Skill Points Subtracted from the loser!';
                                                            } else {
                                                                $response_msg['status'] = 'error';
                                                                $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                            }
                                                        } else {
                                                        }
                                                    } else {
                                                        $response_msg['status'] = 'error';
                                                        $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                                    }
                                                }
                                        } else {
                                            $response_msg['status'] = 'error';
                                            $response_msg['description'] .= 'Error: Invalid Challenge ID!';
                                        }
                                    } else {
                                        $response_msg['status'] = 'error';
                                        $response_msg['description'] .= 'Error: ' . mysqli_error($conn);
                                    }
                                }
                            } else {
                                $response_msg['status'] = 'error';
                                $response_msg['description'] .= 'Error: Challenge has not been started yet!';
                            }
                        } else {
                            $response_msg['status'] = 'error';
                            $response_msg['description'] .= 'Error: You have already claimed your result! It cannot be changed.';
                        }
                    } else {
                        $response_msg['status'] = 'error';
                        $response_msg['description'] .= 'Error: Challenge not in Confirmed state!';
                    }
                } else {
                    $response_msg['status'] = 'error';
                    $response_msg['description'] .= 'Error: You are not a part of this challenge!';
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
