<?php include '../../header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1 class="text-center"><i class="bi bi-bell-fill me-2 fs-3"></i>Notifications</h1>
            <hr />

            <?php

            include_once '../../php-apis/db-config.php';

            $user_id = $_SESSION['id'];

            $sql = "SELECT * FROM notifications WHERE notif_for = $user_id ORDER BY notif_create_timestamp DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

            ?>

                    <div class="card my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><?php echo $row['notif_msg']; ?></p>
                                <button type="button" class="btn btn-light notif_button" data-notif_id="<?php echo $row['notif_id']; ?>">
                                    <?php echo ($row['notif_status'] === 'unread') ? ('<i class="bi bi-envelope"></i>') : ('<i class="bi bi-envelope-open"></i>'); ?>
                                </button>
                            </div>
                        </div>
                        <div class="card-footer text-muted"><?php echo $row['notif_create_timestamp']; ?></div>
                    </div>

            <?php

                }
            } else {
                echo "<p class='text-center'>No Notifications</p>";
            }

            ?>

        </div>
    </div>
</div>

<script src="./index1.js"></script>

<?php include '../../footer.php'; ?>