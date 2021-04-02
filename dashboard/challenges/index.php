<?php include '../../header.php'; ?>

<link rel="stylesheet" href="./index.css">

<!-- Modal -->
<div class="modal fade" id="createChallengeModal" tabindex="-1" aria-labelledby="createChallengeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createChallengeModalLabel">Create Challenge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-challenge-form" novalidate>
                    <fieldset>
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-select" aria-label="Default select example" id="challenge-game" name="challenge-game" required>
                                    <option value="">Select Game</option>
                                    <option value="fifa_21">FIFA 21</option>
                                    <option value="fortnite">Fortnite</option>
                                    <option value="clash_of_clans">Clash of Clans</option>
                                </select>
                                <div class="invalid-feedback">Required Field</div>
                            </div>
                            <div class="col">
                                <select class="form-select" aria-label="Default select example" name="challenge-console" required>
                                    <option value="">Select Console</option>
                                    <option value="ps4">PS4</option>
                                    <option value="pc">PC</option>
                                    <option value="xbox">Xbox</option>
                                    <option value="nintendo">Nintendo</option>
                                </select>
                                <div class="invalid-feedback">Required Field</div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" min="1" step="any" class="form-control" id="challenge-amount" name="challenge-amount" placeholder="Amount" required>
                            <div class="invalid-feedback">Minimum $1 Required</div>
                            <label class="text-uppercase" for="challenge-amount">Amount</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="challenge-date" name="challenge-date" placeholder="Challenge Date" required>
                                    <label for="challenge-date">Challenge Date</label>
                                    <div class="form-text">Date Should Be Greater Than Today</div>
                                    <div class="invalid-feedback">Required Field</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="time" class="form-control" id="challenge-time" name="challenge-time" placeholder="Challenge Time" required>
                                    <label for="challenge-time">Challenge Time</label>
                                    <div class="invalid-feedback">Required Field</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="challenge-game-mode" name="challenge-game-mode" placeholder="SPECIFY GAME MODE (OPTIONAL)">
                            <label class="text-uppercase" for="challenge-game-mode">SPECIFY GAME MODE (OPTIONAL)</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Rules" id="challenge-rules" name="challenge-rules"></textarea>
                            <label class="text-uppercase" for="challenge-rules">Rules</label>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="create-challenge-form" class="btn btn-light text-uppercase">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="hero d-flex align-items-end">
    <h1 class="ms-5 text-white display-5 fw-bold">My Challenges</h1>
</div>

<div class="container-fluid bg-dark py-2">
    <div class="row">
        <div class="col d-flex mx-4">
            <a class="btn btn-dark text-uppercase" href="../find-opponent" role="button">Find Opponent</a>
            <a class="btn btn-dark text-uppercase" href="./history/" role="button">History</a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-light text-uppercase ms-auto" data-bs-toggle="modal" data-bs-target="#createChallengeModal">Create</button>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1 class="text-center">

                <?php

                include_once '../../php-apis/db-config.php';
                include_once '../../php-apis/clean-input.php';

                $user_id = $_SESSION['id'];

                $sql = "SELECT COUNT(*) AS open_count FROM challenges_log WHERE challenge_by = $user_id AND (status = 'open' OR status = 'reset')";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row['open_count'];
                    }
                } else {
                    echo '0';
                }

                ?>

                Open / Reset
            </h1>

            <?php

            $sql4 = "SELECT * FROM challenges_log WHERE challenge_by = $user_id AND (status = 'open' OR status = 'reset') ORDER BY GREATEST(COALESCE(created_timestamp, 0), COALESCE(reopen_timestamp, 0)) DESC";
            $result4 = mysqli_query($conn, $sql4);

            if (mysqli_num_rows($result4) > 0) {
                while ($row4 = mysqli_fetch_assoc($result4)) {

            ?>

                    <div class="card my-3">
                        <div class="card-header">
                            Challenge # <?php echo $row4['challenge_id']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo (($row4['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row4['game']))) : (ucwords(str_replace("_", " ", $row4['game'])))) . ' - ' . (($row4['console'] === 'ps4' || $row4['console'] === 'pc') ? (strtoupper($row4['console'])) : (ucwords($row4['console']))); ?>
                            </h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Amount</th>
                                        <td><?php echo '$' . $row4['amount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Game Mode</th>
                                        <td><?php echo $row4['game_mode']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rules</th>
                                        <td><?php echo $row4['rules']; ?></td>
                                    </tr>

                                    <?php if ($row4['status'] === 'open') { ?>
                                        <tr>
                                            <th scope="row">Challenge Date</th>
                                            <td><?php echo $row4['challenge_date']; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Challenge Time</th>
                                            <td><?php echo $row4['challenge_time']; ?></td>
                                        </tr>
                                </tbody>
                            </table>
                            <p class="card-text">Waiting For Someone To Accept Your Challenge...</p>
                            <button type="button" class="cancel-challenge btn btn-secondary" data-challenge-id="<?php echo $row4['challenge_id']; ?>">Cancel</button>

                        <?php } else { ?>

                            <tr>
                                <th scope="row">Comments</th>
                                <td><?php echo $row4['comments']; ?></td>
                            </tr>
                            </tbody>
                            </table>

                            <form class="reopen-challenge-form">
                                <fieldset>
                                    <input type="hidden" name="challenge-id" value="<?php echo $row4['challenge_id']; ?>">

                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control" id="reopen-challenge-date" name="reopen-challenge-date" placeholder="Re Open Challenge Date" required>
                                        <label for="reopen-challenge-date">Re Open Challenge Date</label>
                                        <div class="form-text">Challenge Date Must be Greater than Today</div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" id="reopen-challenge-time" name="reopen-challenge-time" placeholder="Re Open Challenge Time" required>
                                        <label for="reopen-challenge-time">Re Open Challenge Time</label>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Re Open</button>
                                    <button type="button" class="cancel-challenge btn btn-secondary" data-challenge-id="<?php echo $row4['challenge_id']; ?>">Cancel</button>
                                </fieldset>
                            </form>

                        <?php } ?>

                        </div>
                        <div class="card-footer text-muted">
                            Date Created: <?php echo $row4['created_timestamp']; ?>
                            <br />

                            <?php if (!empty($row4['reset_timestamp']) && !is_null($row4['reset_timestamp'])) { ?>

                                Reset Date: <?php echo $row4['reset_timestamp']; ?>
                                <br />

                            <?php } ?>

                            <?php if (!empty($row4['reopen_timestamp']) && !is_null($row4['reopen_timestamp'])) { ?>

                                Re-Open Date: <?php echo $row4['reopen_timestamp']; ?>

                            <?php } ?>

                        </div>
                    </div>

            <?php

                }
            } else {
                echo "<h2 class='text-center my-3'>No Open Challenges!</h2>";
            }

            ?>

        </div>

        <div class="col">
            <h1 class="text-center">

                <?php

                $user_id = $_SESSION['id'];

                $sql2 = "SELECT COUNT(*) AS accepted_count FROM challenges_log WHERE (challenge_by = $user_id OR accepted_by = $user_id) AND status = 'accepted'";
                $result2 = mysqli_query($conn, $sql2);

                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo $row2['accepted_count'];
                    }
                } else {
                    echo '0';
                }

                ?>

                Accepted
            </h1>

            <?php

            $sql5 = "SELECT * FROM challenges_log WHERE (challenge_by = $user_id OR accepted_by = $user_id) AND status = 'accepted' ORDER BY accepted_timestamp DESC";
            $result5 = mysqli_query($conn, $sql5);

            if (mysqli_num_rows($result5) > 0) {
                while ($row5 = mysqli_fetch_assoc($result5)) {

            ?>

                    <div class="card my-3">
                        <div class="card-header">
                            Challenge # <?php echo $row5['challenge_id']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo (($row5['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row5['game']))) : (ucwords(str_replace("_", " ", $row5['game'])))) . ' - ' . (($row5['console'] === 'ps4' || $row5['console'] === 'pc') ? (strtoupper($row5['console'])) : (ucwords($row5['console']))); ?>
                            </h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Created By</th>
                                        <td>
                                            <?php

                                            $challenge_by = $row5['challenge_by'];

                                            $sql6 = "SELECT * FROM users WHERE id = $challenge_by";
                                            $result6 = mysqli_query($conn, $sql6);

                                            if (mysqli_num_rows($result6) > 0) {
                                                while ($row6 = mysqli_fetch_assoc($result6)) {
                                                    echo $row6['username'];
                                                }
                                            } else {
                                                echo "<p class='text-danger'>User Not Found!</p>";
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Accepted By</th>
                                        <td>
                                            <?php

                                            $accepted_by = $row5['accepted_by'];

                                            $sql7 = "SELECT * FROM users WHERE id = $accepted_by";
                                            $result7 = mysqli_query($conn, $sql7);

                                            if (mysqli_num_rows($result7) > 0) {
                                                while ($row7 = mysqli_fetch_assoc($result7)) {
                                                    echo $row7['username'];
                                                }
                                            } else {
                                                echo "<p class='text-danger'>User Not Found!</p>";
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount</th>
                                        <td><?php echo '$' . $row5['amount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Game Mode</th>
                                        <td><?php echo $row5['game_mode']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rules</th>
                                        <td><?php echo $row5['rules']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Challenge Date</th>
                                        <td><?php echo $row5['challenge_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Challenge Time</th>
                                        <td><?php echo $row5['challenge_time']; ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php if ($row5['challenge_by'] === $user_id) { ?>

                                <button type="button" class="confirm-challenge btn btn-primary" data-challenge-id="<?php echo $row5['challenge_id']; ?>">Confirm</button>
                                <button type="button" class="cancel-challenge btn btn-secondary" data-challenge-id="<?php echo $row5['challenge_id']; ?>">Cancel</button>

                            <?php } else { ?>

                                <p class="card-text">Waiting for the Challenge owner to confirm this Challenge...</p>

                            <?php } ?>

                        </div>
                        <div class="card-footer text-muted">
                            Date Created: <?php echo $row5['created_timestamp']; ?>
                            <br />
                            <?php if (!empty($row5['reset_timestamp']) && !is_null($row5['reset_timestamp'])) { ?>
                                Reset Date: <?php echo $row5['reset_timestamp']; ?>
                                <br />
                            <?php } ?>
                            <?php if (!empty($row5['reopen_timestamp']) && !is_null($row5['reopen_timestamp'])) { ?>
                                Re-Open Date: <?php echo $row5['reopen_timestamp']; ?>
                                <br />
                            <?php } ?>
                            Date Accepted: <?php echo $row5['accepted_timestamp']; ?>
                        </div>
                    </div>

            <?php

                }
            } else {
                echo "<h2 class='text-center my-3'>No Accepted Challenges!</h2>";
            }

            ?>

        </div>

        <div class="col">
            <h1 class="text-center">

                <?php

                include_once '../../php-apis/db-config.php';

                $user_id = $_SESSION['id'];

                $sql3 = "SELECT COUNT(*) AS confirmed_count FROM challenges_log WHERE (challenge_by = $user_id OR accepted_by = $user_id) AND status = 'confirmed'";
                $result3 = mysqli_query($conn, $sql3);

                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo $row3['confirmed_count'];
                    }
                } else {
                    echo '0';
                }

                ?>

                Confirmed
            </h1>

            <?php

            $sql5 = "SELECT * FROM challenges_log WHERE (challenge_by = $user_id OR accepted_by = $user_id) AND status = 'confirmed' ORDER BY confirmed_timestamp DESC";
            $result5 = mysqli_query($conn, $sql5);

            if (mysqli_num_rows($result5) > 0) {
                while ($row5 = mysqli_fetch_assoc($result5)) {

            ?>

                    <div class="card my-3">
                        <div class="card-header">
                            Challenge # <?php echo $row5['challenge_id']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo (($row5['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row5['game']))) : (ucwords(str_replace("_", " ", $row5['game'])))) . ' - ' . (($row5['console'] === 'ps4' || $row5['console'] === 'pc') ? (strtoupper($row5['console'])) : (ucwords($row5['console']))); ?>
                            </h5>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Created By</th>
                                        <td>
                                            <?php

                                            $challenge_by = $row5['challenge_by'];

                                            $sql6 = "SELECT * FROM users WHERE id = $challenge_by";
                                            $result6 = mysqli_query($conn, $sql6);

                                            if (mysqli_num_rows($result6) > 0) {
                                                while ($row6 = mysqli_fetch_assoc($result6)) {
                                                    echo $row6['username'];
                                                }
                                            } else {
                                                echo "<p class='text-danger'>User Not Found!</p>";
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Accepted By</th>
                                        <td>
                                            <?php

                                            $accepted_by = $row5['accepted_by'];

                                            $sql7 = "SELECT * FROM users WHERE id = $accepted_by";
                                            $result7 = mysqli_query($conn, $sql7);

                                            if (mysqli_num_rows($result7) > 0) {
                                                while ($row7 = mysqli_fetch_assoc($result7)) {
                                                    echo $row7['username'];
                                                }
                                            } else {
                                                echo "<p class='text-danger'>User Not Found!</p>";
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount</th>
                                        <td><?php echo '$' . $row5['amount']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Game Mode</th>
                                        <td><?php echo $row5['game_mode']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Rules</th>
                                        <td><?php echo $row5['rules']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Challenge Date</th>
                                        <td><?php echo $row5['challenge_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Challenge Time</th>
                                        <td><?php echo $row5['challenge_time']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="./challenge/?challenge-id=<?php echo $row5['challenge_id']; ?>" class="btn btn-primary">Go to Challenge...</a>
                        </div>
                        <div class="card-footer text-muted">
                            Date Created: <?php echo $row5['created_timestamp']; ?>
                            <br />
                            <?php if (!empty($row5['reset_timestamp']) && !is_null($row5['reset_timestamp'])) { ?>
                                Reset Date: <?php echo $row5['reset_timestamp']; ?>
                                <br />
                            <?php } ?>
                            <?php if (!empty($row5['reopen_timestamp']) && !is_null($row5['reopen_timestamp'])) { ?>
                                Re-Open Date: <?php echo $row5['reopen_timestamp']; ?>
                                <br />
                            <?php } ?>
                            Date Accepted: <?php echo $row5['accepted_timestamp']; ?>
                            <br />
                            Date Confirmed: <?php echo $row5['confirmed_timestamp']; ?>
                        </div>
                    </div>

            <?php

                }
            } else {
                echo "<h2 class='text-center my-3'>No Confirmed Challenges!</h2>";
            }

            ?>

        </div>
    </div>
</div>

<script src="./index1.js"></script>

<?php include '../../footer.php'; ?>