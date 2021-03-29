<?php

include("../../php-apis/db-config.php");
    $id = $_GET["id"];
    $query = "DELETE from game_log where id = $id";
    mysqli_query($conn,$query);
    header("location:../game");