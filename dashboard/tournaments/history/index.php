<?php
include '../../../header.php';
?>

<link rel="stylesheet" href="./index.css">

<div class="hero d-flex align-items-end">
    <h1 class="ms-5 text-white display-5 fw-bold">Tournament History</h1>
</div>

<div class="container-fluid bg-dark py-2">
    <div class="row">
        <div class="col mx-4">
            <a class="btn btn-dark text-uppercase" href="../../find-opponent" role="button">Find Opponent</a>
            <a class="btn btn-dark text-uppercase" href="../" role="button">My Tournaments</a>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Game</th>
                        <th scope="col">Console</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Game Mode</th>
                        <th scope="col">Rules</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Created</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    include_once '../../../php-apis/db-config.php';

                    $user_id = $_SESSION['id'];

                    $sql = "SELECT * FROM tournaments_log WHERE tournament_by = $user_id ORDER BY created_timestamp DESC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;

                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>

                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo (($row['game'] === 'fifa_21') ? (strtoupper(str_replace("_", " ", $row['game']))) : (ucwords(str_replace("_", " ", $row['game'])))); ?></td>
                                <td><?php echo (($row['console'] === 'ps4' || $row['console'] === 'pc') ? (strtoupper($row['console'])) : (ucwords($row['console']))); ?></td>
                                <td><?php echo '$' . $row['amount']; ?></td>
                                <td class="text-capitalize"><?php echo $row['game_mode']; ?></td>
                                <td><?php echo $row['rules']; ?></td>
                                <td class="text-capitalize"><?php echo $row['status']; ?></td>
                                <td><?php echo $row['created_timestamp']; ?></td>
                            </tr>

                        <?php

                            $count++;
                        }
                    } else {

                        ?>

                        <tr>
                            <td colspan="8" class="text-center text-danger">No Tournaments Found</td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>