<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Manager</title>
    <!-- css styling  -->
    <link rel="stylesheet" href="../css/styleRegistration.css?v= <?php echo time(); ?>">
    <!-- google font library  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;700&display=swap"
        rel="stylesheet">
</head>
    <?php 
        session_start();
        include_once "config.php";
        if(isset($_SESSION['user'])){
            $id = $_SESSION['user'];
            if($id === "13733695") {
                header("location: adminAdd.php");
            }else {
                header("location: userPanel.php");
            }
            
        }else {
            session_destroy();
            include_once "isLogedIn.php";
        }
    ?>
<body dir="rtl">

    <div class="admin-page">
    <h1 class = "title-main">الدخول للنظام</h1>
        <div class="tabs">
            <div class="tab active"><a href="loginAdmin.php">صفحة الإدارة</a></div>
            <div class="tab"><a href="../index.php">صفحة المستخدم</a></div>
        </div>
        <div class="container admin">
           
            <div class="title">صفحة المدير</div>
            <!-- passing form using ajax  -->
            <form class="admin-form">
                <div class="row">
                    <span>الرقم التعريفي : </span>
                    <input type="text" placeholder = "الرقم الخاص" name="idAdmin">
                </div>
                <div class="row">
                    <span>إسم المستخدم : </span>
                    <input type="text" placeholder = "الإسم" name="adminUser">
                </div>

                <div class="row">
                    <span>كلمة المرور : </span>
                    <input type="password" placeholder="*******" name="adminPassword">
                </div>
            </form>

            <div class="login loginAdmin">الدخول كمسؤول</div>
        </div>

    </div>
    <script src="../js/registration.js?v=<?php echo time();?>"></script>
</body>

</html>