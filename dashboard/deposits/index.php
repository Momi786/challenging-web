<?php
include '../../header.php';
?>

<link rel="stylesheet" href="./index.css">

<!-- Modal -->
<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="depositModalLabel">Dummy Deposit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deposit-form" novalidate>
                    <fieldset>
                        <legend>Deposit Amount</legend>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" min="10" step="any" class="form-control" id="deposit-amount" name="deposit-amount" aria-label="Amount (to the nearest dollar)" required>
                            <span class="input-group-text">.00</span>
                            <div class="invalid-feedback">Minimum $10 Required</div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="deposit-form" class="btn btn-primary">Deposit</button>
            </div>
        </div>
    </div>
</div>

<div class="hero bg-dark d-flex align-items-end px-5">
    <h1 class="text-white display-5 fw-bold">Deposits</h1>
</div>

<div class="container-fluid bg-dark py-2 px-5">
    <div class="row">
        <div class="col d-flex justify-content-between">
            <h3 class="text-white fw-bold">Balance:

                <?php

                include_once '../../php-apis/db-config.php';
                include_once '../../php-apis/clean-input.php';

                $user_id = $_SESSION['id'];

                $sql3 = "SELECT * FROM users WHERE id=$user_id";
                $result3 = mysqli_query($conn, $sql3);

                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo '$' . number_format($row3['balance'], 2, '.', '');
                    }
                } else {
                    header("Location: ../../php-apis/logout.php");
                    die();
                }

                ?>

            </h3>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Deposit
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <!-- Button trigger modal -->
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#depositModal">Dummy Deposit</button>
                    </li>
                    <li><a class="dropdown-item" href="./paypal">Paypal</a></li>
                    <li><a class="dropdown-item" href="#">Neteller</a></li>
                    <li><a class="dropdown-item" href="#">Skrill</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h3>Deposits:

                <?php

                $sql = "SELECT SUM(amount) AS depositSum FROM deposit_log WHERE deposit_by = $user_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '$' . number_format($row['depositSum'], 2, '.', '');
                    }
                } else {
                    echo "$0.00";
                }

                ?>

            </h3>
        </div>
        <div class="col d-flex">
            <div class="dropdown shadow ms-auto">
                <button class="btn btn-light dropdown-toggle text-uppercase" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Report
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./?report-filter=current-month">This Month</a></li>
                    <li><a class="dropdown-item" href="./?report-filter=previous-month">Last Month</a></li>
                    <li><a class="dropdown-item" href="./?report-filter=current-year">This Year</a></li>
                    <li><a class="dropdown-item" href="./?report-filter=all">All</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h2 class="text-capitalize"><?php echo (isset($_GET['report-filter']) && !empty($_GET['report-filter'])) ? (str_replace("-", " ", mysqli_real_escape_string($conn, clean_input($_GET['report-filter'])))) : ("All") ?> Records</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Method</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (isset($_GET['report-filter']) && !empty($_GET['report-filter'])) {
                        $reportFilter = mysqli_real_escape_string($conn, clean_input($_GET["report-filter"]));

                        switch ($reportFilter) {
                            case "current-month":
                                $sql2 = "SELECT * FROM deposit_log WHERE MONTH(server_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(server_timestamp) = YEAR(CURRENT_DATE()) AND deposit_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "previous-month":
                                $sql2 = "SELECT * FROM deposit_log WHERE YEAR(server_timestamp) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND MONTH(server_timestamp) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND deposit_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "current-year":
                                $sql2 = "SELECT * FROM deposit_log WHERE YEAR(server_timestamp) = YEAR(CURRENT_DATE()) AND deposit_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "all":
                                $sql2 = "SELECT * FROM deposit_log WHERE deposit_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            default:
                                $sql2 = "SELECT * FROM deposit_log WHERE deposit_by = $user_id ORDER BY server_timestamp DESC";
                        }
                    } else {
                        $sql2 = "SELECT * FROM deposit_log WHERE deposit_by = $user_id ORDER BY server_timestamp DESC";
                    }

                    $result2 = mysqli_query($conn, $sql2);

                    if (mysqli_num_rows($result2) > 0) {
                        $count = 1;

                        while ($row2 = mysqli_fetch_assoc($result2)) {

                    ?>

                            <tr>
                                <th scope="row"><?php echo $count; ?></th>
                                <td><?php echo $row2['method']; ?></td>
                                <td><?php echo '$' . number_format($row2['amount'], 2, '.', ''); ?></td>
                                <td><?php echo $row2['client_date']; ?></td>
                            </tr>

                        <?php

                            $count++;
                        }
                    } else {

                        ?>

                        <tr>
                            <td colspan="4" class="text-center text-danger">No Records Found!</td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="./index1.js"></script>

<?php
include '../../footer.php';
?>