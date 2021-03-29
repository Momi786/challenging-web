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
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Points</th>
                                <!-- <th>Status</th> -->
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * from users";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_num_rows($result);
                                for ($i=0; $i < $count ; $i++) { 
                                    $data = mysqli_fetch_assoc($result);
                            ?>
                                <tr>
                                    <td><?= $data['id']?></td>
                                    <td><?= $data['first_name']?></td>
                                    <td><?= $data['email']?></td>
                                    <td><?= $data['skill_points']?></td>
                                    <!-- <td>
                                        <?php  
                                            if ($data['status'] == 1) {
                                                $active ="danger";
                                                $active1 ="block";
                                            }else{
                                                $active ="success";
                                                $active1 ="active";
                                            }
                                        ?>
                                        <div class="badge badge-<?=$active?>"><?=$active1?></div>
                                    </td> -->
                                    <td>    
                                        <a href=""><i class="fa fa-lock text-danger"></i></a>
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