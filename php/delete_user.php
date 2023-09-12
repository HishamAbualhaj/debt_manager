<?php 
    include_once "config.php";
    include_once "isSession.php";
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        // make sure this user is still in the system
        $isValid = "SELECT * FROM mainusers WHERE mainUserId = '$userId'";
        $q = mysqli_query($conn,$isValid);

        if(!(mysqli_num_rows($q) > 0)) {
            session_unset();
            session_destroy();
            echo 'deletedUser';
        // there is a user then do something !
        }else {
            $sql = "DELETE FROM users WHERE id = $id";

            $sql2 = "DELETE FROM history where id = $id";
            if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
                echo "success";
        
            } else {
                echo "Error deleting user: " . mysqli_error($conn);
            }
        }
    }else {
        header('Location: ../index.php');
    }
    
  

?>  