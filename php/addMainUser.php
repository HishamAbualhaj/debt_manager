<?php 
    include_once "config.php";
    if(isset($_POST['personal-name']) || isset($_POST['user-name']) || isset($_POST['user-password']) || isset($_POST['notes'])) {  
        $personal_name = mysqli_real_escape_string($conn,$_POST['personal-name']);
        $user_name = mysqli_real_escape_string($conn,$_POST['user-name']);
        $user_pass = mysqli_real_escape_string($conn,$_POST['user-password']);
        $notes = mysqli_real_escape_string($conn,$_POST['notes']);
    }else {
        header('Location: ../index.php');
    }
    
    if(empty($personal_name) || empty($user_name) || empty($user_pass)) {
        echo "failed";
    }else {
        $sql = mysqli_query($conn,"SELECT * FROM mainusers WHERE username = '{$user_name}'");
        if(mysqli_num_rows($sql) > 0) {
            echo "userFound";
        }else {
            $ran_id = rand(time(), 1000000);
            $insert_query = mysqli_query($conn, "INSERT INTO mainusers (mainUserId, personal_name, username, password, notes)
            VALUES ('{$ran_id}','{$personal_name}','{$user_name}','{$user_pass}','{$notes}')");
            echo "success";
        }
    }

?>