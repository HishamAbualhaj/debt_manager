<?php 
    include_once "config.php";
    if(isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$userId}' ");
        if(mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_array($sql);
            echo $row['amount'];
        }
    }else {
        header('Location: ../index.php');
    }
  
?>