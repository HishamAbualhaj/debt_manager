<?php 
    // for preventing direct url from going to any server pages ! like add , delete , edit ... etc
    session_start();
    if(isset($_SESSION['user'])) {
        if($_SESSION['user'] == "13733695") {
            header('Location: ../index.php');
        }else {
            $userId = $_SESSION['user'];
        }
    }else {
        header('Location: ../index.php');
    }
?>