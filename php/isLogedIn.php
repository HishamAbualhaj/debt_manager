<?php 
    session_start();
     if(!isset($_SESSION['user'])) {
        // getting cookie value 
        if(isset($_COOKIE['log_id'])) {
            $_SESSION['user'] = $_COOKIE['log_id'];
            header('Location: ../index.php');
        } else {
            // no cookie value found 
        }
     } else {
      // no session is set 
      
     }
     // then go to login page !
?>