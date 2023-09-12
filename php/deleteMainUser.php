<?php 

    include_once "config.php";
    if(isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    }else {
        header('Location: ../index.php');
    }
    
    
    $sql_main = "DELETE FROM mainusers WHERE mainUserId = $userId";
    $sql_users = "DELETE FROM users WHERE mainUserId = $userId";
    $sql_history = "DELETE FROM history WHERE mainUserId = $userId";

    if (mysqli_query($conn, $sql_main)) {
        if(mysqli_query($conn, $sql_users) && mysqli_query($conn, $sql_history)) {
            echo 'success';
        }
    } else {
        echo 'failed';
    }
?>