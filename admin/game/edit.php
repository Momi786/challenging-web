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
                   <div class="col-md-12">
                        <?php
                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $query = "SELECT * from game_log where id='$id'";
                                $result = mysqli_query($conn,$query);
                                $count = mysqli_num_rows($result);
                                if ($count == 1) { 
                                    $data = mysqli_fetch_assoc($result);
                                    if(isset($_POST["name"])){
                                        extract($_POST);
                                        if (isset($_FILES["filetoupload"]["name"]) && !empty($_FILES["filetoupload"]["name"])) {
                                            $filename = $_FILES["filetoupload"]["name"];
                                            move_uploaded_file($_FILES["filetoupload"]["tmp_name"],"../images/" . $filename);
                                        }else{
                                            $filename = $data['image'];
                                        }
                                        $query1 = "UPDATE game_log set name='$name',console='$console',image='$filename',description='$description' where id=$id";
                                        if (mysqli_query($conn,$query1) >= 1) {
                                        echo "<div class='alert alert-success text-center'>Record Updated Successfully</div>";
                                        }
                                        $result = mysqli_query($conn,$query);
                                        $data = mysqli_fetch_assoc($result);
                                    }
                                }
                            }
                        ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        Game Title
                                    </label>
                                    <input type="text" name="name" value="<?=$data['name'] ?>" class="form-control" required/>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        Game Console    
                                    </label>
                                    <input type="text" name="console" value="<?=$data['console'] ?>" class="form-control" required/>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Upload Game Thumbnail   
                                    </label>
                                    <img src="../images/<?= $data['image']?>" alt="" width="100px" height="100px">
                                    <input type="file" name="filetoupload" class="form-control"/>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Game Rules or Game Description
                                    </label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" required><?=$data['description'] ?></textarea>
                                </div>
                                
                            </div>
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                   </div>
                </div>
            </div>
        </div>

<?php
    include '../inc/footer.php';
?>