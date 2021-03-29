<?php
include '../../header.php';
?>

<link rel="stylesheet" href="./index.css">

<!-- Modal -->
<div class="modal fade" id="withdrawalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Withdrawal Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <small>Enter the amount and method to withdraw your money.</small>
                <form class="mt-3" id="withdrawal-form" novalidate>
                    <fieldset>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="withdrawal-method" name="withdrawal-method" required>
                                <option value="">Select Withdrawal Method</option>
                                <option value="dummy">Dummy Withdrawal</option>
                                <option value="paypal" disabled>Paypal</option>
                                <option value="neteller" disabled>Neteller</option>
                                <option value="skrill" disabled>Skrill</option>
                            </select>
                            <label for="withdrawal-method" class="text-uppercase">Method</label>
                            <div class="invalid-feedback">Required Field</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" min="20" step="any" class="form-control" id="withdrawal-amount" name="withdrawal-amount" placeholder="Amount" required>
                            <label for="withdrawal-amount" class="text-uppercase">Amount</label>
                            <div class="invalid-feedback">Minimum $20 Required</div>
                        </div>
                        <div class="form-text">Fees: $0.00</div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="withdrawal-form" class="btn btn-light text-uppercase">Withdraw</button>
            </div>
        </div>
    </div>
</div>

<div class="hero bg-dark d-flex align-items-end px-5">
    <h1 class="text-white display-5 fw-bold">Withdrawal</h1>
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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning text-uppercase text-white fw-bold" data-bs-toggle="modal" data-bs-target="#withdrawalModal">
                Request
            </button>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h3>Withdrawals:

                <?php

                $sql = "SELECT SUM(amount) AS withdrawalSum FROM withdrawal_log WHERE withdrawal_by = $user_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '$' . number_format($row['withdrawalSum'], 2, '.', '');
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
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    if (isset($_GET['report-filter']) && !empty($_GET['report-filter'])) {
                        $reportFilter = mysqli_real_escape_string($conn, clean_input($_GET["report-filter"]));

                        switch ($reportFilter) {
                            case "current-month":
                                $sql2 = "SELECT * FROM withdrawal_log WHERE MONTH(server_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(server_timestamp) = YEAR(CURRENT_DATE()) AND withdrawal_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "previous-month":
                                $sql2 = "SELECT * FROM withdrawal_log WHERE YEAR(server_timestamp) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) AND MONTH(server_timestamp) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND withdrawal_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "current-year":
                                $sql2 = "SELECT * FROM withdrawal_log WHERE YEAR(server_timestamp) = YEAR(CURRENT_DATE()) AND withdrawal_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            case "all":
                                $sql2 = "SELECT * FROM withdrawal_log WHERE withdrawal_by = $user_id ORDER BY server_timestamp DESC";
                                break;
                            default:
                                $sql2 = "SELECT * FROM withdrawal_log WHERE withdrawal_by = $user_id ORDER BY server_timestamp DESC";
                        }
                    } else {
                        $sql2 = "SELECT * FROM withdrawal_log WHERE withdrawal_by = $user_id ORDER BY server_timestamp DESC";
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
                                <td><?php echo $row2['withdrawal_status']; ?></td>
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