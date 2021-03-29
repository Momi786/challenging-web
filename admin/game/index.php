<?php
    include '../inc/header.php';
?>


<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
                    <table id="example" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Console</th>
                                <th>Image</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * from game_log";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_num_rows($result);
                                for ($i=0; $i < $count ; $i++) { 
                                    $data = mysqli_fetch_assoc($result);
                            ?>
                                    <tr>
                                        <td><?= $data['id']?></td>
                                        <td><?= $data['name']?></td>
                                        <td><?= $data['console']?></td>
                                        <td><img src="../images/<?= $data['image']?>" alt="" width="100px" height="100px"></td>
                                        <td>    
                                            <a href="edit.php?id=<?=$data['id']?>"><i class="fa fa-edit text-primary"></i></a>
                                            <a href="delete.php?id=<?=$data['id']?>"><i class="fa fa-trash text-danger"></i></a>
                                        </td>
                                    </tr>

                            <?php
                                    
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


<?php
    include '../inc/footer.php';
?>