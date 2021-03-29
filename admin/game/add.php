
 

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
                        if(isset($_POST["title"])){
                            extract($_POST);
                            $filename = $_FILES["filetoupload"]["name"];
                            move_uploaded_file($_FILES["filetoupload"]["tmp_name"],"../images/" . $filename);
                            $query = "INSERT into game_log values(null,'$title','$console','$filename','$description',null,null);";
                            if (mysqli_query($conn,$query) >= 1) {
                            echo "<div class='alert alert-success text-center'>Record Inserted Successfully</div>";
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
                                    <input type="text" name="title" class="form-control" required/>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">
                                        Game Console    
                                    </label>
                                    <input type="text" name="console" class="form-control" required/>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Upload Game Thumbnail   
                                    </label>
                                    <input type="file" name="filetoupload" class="form-control" required/>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Game Rules or Game Description
                                    </label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" required></textarea>
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