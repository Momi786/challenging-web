<?php
    session_start();
    if (isset($_SESSION["onlineusers"])) {
        header ("location:../home/");
    }
    include("../../php-apis/db-config.php");
?>

<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Challenge Site | Admin</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="#"><h4 class="text-white">Challenge Site | Admin</h4></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
    <?php
        if (isset($_POST["username"])) {
            extract($_POST);
            $query = "SELECT * from admin where username='$username' and password='$password';";
            $result = mysqli_query($conn,$query);
            $count = mysqli_num_rows($result);
            if($count>=1){
                $userInfo = mysqli_fetch_assoc($result);
                    $_SESSION["onlineusers"] = $userInfo;
                    header("location:../home/"); 
               
            }else{
                echo "<br/><div class='container alert alert-danger'>Sorry!the username or password not matched</div>";
            }
        }
        
    ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Username</strong></label>
                                            <input type="text" name="username" value="admin" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" name="password" value="abc123" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-white text-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
	<script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/deznav-init.js"></script>

</body>


</html>