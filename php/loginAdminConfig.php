<?php 
    include_once "config.php";
    include_once "adminConfig.php";
    if(isset($_POST['idAdmin']) && isset($_POST['adminUser']) && isset($_POST['adminPassword'])) {
        $idAdmin = mysqli_real_escape_string($conn, $_POST['idAdmin']);
        $adminUser = mysqli_real_escape_string($conn, $_POST['adminUser']);
        $adminPassword = mysqli_real_escape_string($conn, $_POST['adminPassword']);
    }else {
        header("Location: ../index.php");
    }

    if(empty($idAdmin) || empty($adminUser) || empty($adminPassword)) {
        echo 'أدخل جميع الحقول';
    }else {
        if($idAdmin == id && $adminUser == user && $adminPassword == password) {
            session_start();
            $_SESSION['user'] = "13733695";
            // store cookie for the whole domain ! '/' ;
            setcookie('log_id',$_SESSION['user'],time() + (10 * 365 * 24 * 60 * 60) , '/');
            echo 'success';
        }else {
            echo 'تأكد من إدخال البيانات بشكل صحيح';
        }
    }
 
?>