<?php
    session_start();
    if(isset($_SESSION['user'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);

        if(isset($logout_id)){
            session_unset();
            session_destroy();
            setcookie('log_id',"",time() + (10 * 365 * 24 * 60 * 60) ,'/');
            header("location: ../index.php");

        }else{
            header("location: ../index.php");
        }

    }else{  
        header("location: ../index.php");
    }
    
?>