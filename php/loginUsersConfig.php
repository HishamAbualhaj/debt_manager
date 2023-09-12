<?php 
    include_once "config.php";


    if(isset($_POST['userName']) && isset($_POST['userPassword'])) {
        $userName = mysqli_real_escape_string($conn,$_POST['userName']);
        $userPassword = mysqli_real_escape_string($conn,$_POST['userPassword']);
    }else {
        header("Location: ../index.php");
    }
    $sql = "SELECT * FROM mainusers";

    $query = mysqli_query($conn,$sql);
    $isFound = false;
    if(empty($userName) || empty($userPassword)) {
        echo 'أدخل جميع الحقول';
    }else {
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
            if($row['username'] === $userName && $row['password'] === $userPassword) {
                    $isFound = true;
                    session_start();
                    $_SESSION['user'] = $row['mainUserId'];
                    // store cookie for the whole domain ! '/' ;
                    setcookie('log_id',$_SESSION['user'],time() + (10 * 365 * 24 * 60 * 60) , '/');
                    echo 'success';
            }
            }
            if(!$isFound) {
                echo 'لم يتم العثور على المستخدم';
            }
        }else {
            echo "لا يوجد مستخدمين";
        }
    }


?>