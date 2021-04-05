<?php
include '../header.php';
$sql = "SELECT  * FROM users ORDER BY `skill_points` DESC limit 10";
$result = mysqli_query($conn, $sql);
$i=0;
?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="text-center">Top 10 Rank</h1>
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-6 mx-auto">
            <table class="table table-sm text-center">
                <thead>
                    <tr>
                        <th scope="col">Position</th>
                        <th scope="col">User</th>
                        <th scope="col">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while($row = mysqli_fetch_assoc($result)) {
                            $i++;
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['username']?></td>
                                <td><?= $row['skill_points'] ?></td>
                            </tr>
                        <?php }  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../footer.php';
?>