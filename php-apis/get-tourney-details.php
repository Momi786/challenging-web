<?php

session_start();

include_once './db-config.php';
include_once './clean-input.php';

$response_msg = [];
$error_msgs = [];

if (empty($_SESSION['id']) || is_null($_SESSION['id'])) {
    $response_msg['status'] = 'error';
    $error_msgs[] = 'Error: Session ID empty! Please login again to continue!';
} else {
    if (empty($_POST["tourney-id"]) || is_null($_POST["tourney-id"])) {
        $response_msg['status'] = 'error';
        $error_msgs[] = 'Error: Tournament ID Missing!';
    } else {
        $tourney_id = mysqli_real_escape_string($conn, clean_input($_POST["tourney-id"]));

        $sql = "SELECT * FROM tournaments_log WHERE tournament_id = $tourney_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $tourney_details = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $tourney_details['tournament_id'] = $row['tournament_id'];
                $tourney_details['tournament_by'] = $row['tournament_by'];
                $tourney_details['game'] = $row['game'];
                $tourney_details['console'] = $row['console'];
                $tourney_details['amount'] = $row['amount'];

                $sql2 = "SELECT * FROM tourney_players INNER JOIN users ON tourney_players.player_id = users.id WHERE tourney_players.tourney_id = $tourney_id";
                $result2 = mysqli_query($conn, $sql2);

                if (mysqli_num_rows($result2) > 0) {
                    $tourney_players = [];

                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $skill_points = $row2['skill_points'];

                        $sql3 = "SELECT * FROM skill_levels WHERE $skill_points BETWEEN min_points AND max_points";
                        $result3 = mysqli_query($conn, $sql3);

                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                $skill_level = $row3['level_name'];
                            }
                        } else {
                            $skill_level = 'undefined';
                        }

                        $tourney_player = [];

                        $tourney_player['player_id'] = $row2['player_id'];
                        $tourney_player['enter_timestamp'] = $row2['enter_timestamp'];
                        $tourney_player['username'] = $row2['username'];
                        $tourney_player['skill_points'] = $row2['skill_points'];
                        $tourney_player['skill_level'] = $skill_level;

                        $tourney_players[] = $tourney_player;
                    }

                    $tourney_details['tourney_players'] = $tourney_players;
                } else {
                    $response_msg['status'] = 'error';
                    $error_msgs[] = 'Error: No Players In Tournament!';
                }
            }

            $response_msg['status'] = 'success';
            $response_msg['tourney_details'] = $tourney_details;
        } else {
            $response_msg['status'] = 'error';
            $error_msgs[] = 'Error: Invalid Tournament ID!';
        }
    }
}

$response_msg['error_msgs'] = $error_msgs;

mysqli_close($conn);

echo json_encode($response_msg);
