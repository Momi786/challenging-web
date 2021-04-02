<?php
include("../../php-apis/db-config.php");
    if ($_POST['adminResult']) {
        
    session_start(); 
        $data12 = $_SESSION["onlineusers"];
    
        extract($_POST);
        $query = "UPDATE challenges_log set adminResult='$adminResult' where challenge_id='$challengeId'";
        $result = mysqli_query($conn,$query);
        
        $query1 = "SELECT * from users where id='$adminResult'";
        $result1 = mysqli_query($conn,$query1);
        $data = mysqli_fetch_assoc($result1);
        $oldbalance = $data['balance'];
        $Amount = $oldbalance + $winAmount;

        $query2 = "UPDATE users set balance='$Amount' where id='$adminResult'";
        $result2 = mysqli_query($conn,$query2);

        
        $Amount1 = $data12['balance'] + $adminAmount;

        $query4 = "UPDATE admin set balance='$Amount1' where id='1'";
        $result4 = mysqli_query($conn,$query4);

        header("location:../"); 
    }