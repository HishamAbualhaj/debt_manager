<?php 
    session_start();
    include_once "config.php";
    if(!isset($_SESSION['user'])){
        header("location: loginAdmin.php");
    }else {
        $current_id = $_SESSION['user'];
        echo $current_id;
    }
?>
