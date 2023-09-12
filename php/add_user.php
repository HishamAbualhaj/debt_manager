<?php
   include_once "config.php";
   include_once "isSession.php"; 
   // users may try to go directly into url , then redirect them to default page (login / panel);
   if(isset($_POST['name']) || isset($_POST['date']) || isset($_POST['type']) || isset($_POST['amount'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);   

        // make sure this user is still in the system
        $isValid = "SELECT * FROM mainusers WHERE mainUserId = '$userId'";
        $q = mysqli_query($conn,$isValid);

        if(!(mysqli_num_rows($q) > 0)) {
            session_unset();
            session_destroy();
            echo 'deletedUser';
        // there is a user then do something !   
        } else {
            if(!empty($name) && !empty($date) && !empty($type) && !empty($amount)){
        
                $insert_query = mysqli_query($conn, "INSERT INTO users (mainUserId,name, type, date, amount)
                                VALUES ('{$userId}','{$name}','{$type}', '{$date}', '{$amount}')");
                if($insert_query) {
                    echo 'success';
                }
            }else {
                echo " ";
            }
        }

   }else {
        header('Location: ../index.php');
   }
 


  
  
?>