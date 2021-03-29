<?php
include '../header.php';
?>

<link rel="stylesheet" href="./index.css">

<div class="hero bg-dark d-flex align-items-end px-5">
    <h1 class="text-white display-5 fw-bold">Dashboard</h1>
</div>

<div class="container-fluid bg-dark py-2 px-5">
    <div class="row">
        <div class="col">
            <h3 class="text-white fw-bold">Balance:

                <?php

                include_once '../php-apis/db-config.php';
                include_once '../php-apis/clean-input.php';

                $user_id = $_SESSION['id'];

                $sql3 = "SELECT * FROM users WHERE id=$user_id";
                $result3 = mysqli_query($conn, $sql3);

                if (mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        echo '$' . number_format($row3['balance'], 2, '.', '');
                    }
                } else {
                    header("Location: ../php-apis/logout.php");
                    die();
                }

                ?>

            </h3>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h3 class="mb-5"><i class="bi bi-star-fill me-3"></i>Star Playing</h3>
            <a class="btn btn-outline-secondary border-0" href="./find-opponent" role="button">FIND OPPONENT</a>
            <a class="btn btn-outline-secondary border-0" href="./challenges/" role="button">CHALLENGES</a>
            <a class="btn btn-outline-secondary border-0" href="./tournaments/" role="button">TOURNAMENTS</a>
            <hr />
            <a class="btn btn-outline-secondary border-0" href="../help" role="button">HELP</a>
            <a class="btn btn-outline-secondary border-0" href="../ranking" role="button">RANKING</a>
            <a class="btn btn-outline-secondary border-0" href="./disputes/" role="button">DISPUTES</a>
        </div>
        <div class="col">
            <h3 class="mb-5"><i class="bi bi-wallet-fill me-3"></i>Fund Your Account</h3>
            <a class="btn btn-outline-secondary border-0" href="./deposits/" role="button">MAKE DEPOSIT</a>
            <a class="btn btn-outline-secondary border-0" href="./withdrawal/" role="button">WITHDRAWAL</a>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>