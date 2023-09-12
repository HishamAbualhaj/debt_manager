<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Manager</title>
    <!-- css styling  -->
    <link rel="stylesheet" href="../css/styleRegistration.css?v=<?php echo time();?>">
    <!-- google font library  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@300;400;500;700&display=swap"
        rel="stylesheet">
</head>
    <?php 
        session_start();
        if(!isset($_SESSION['user'])){
            header("location: loginAdmin.php");
        }else {
            // if you are not the admin u can't go to this page
            if(!($_SESSION['user'] == "13733695")) {
                header("location: ../index.php");
            }
        }
    ?>  
<body dir="rtl">
    <div class="admin-panel">
        <div class="header">
            <div class="title">صفحة الإدارة</div>
            <div class="logout"><a href="">تسجيل الخروج</a></div>
        </div>
        <div class="content" >
            <div class="tabs">
                <div class="tab active"><a href="adminAdd.php">إضافة مستخدمين</a></div>
                <div class="tab"><a href="adminUsers.php">بيانات مستخدمين</a></div>
            </div>
            <form class="form-users">
                <div class="title">إضافة مستخدم للنظام</div>
                <div class="row">
                    <span>الإسم الشخصي : </span>
                    <input type="text" name="personal-name" placeholder="الإسم">
                </div>
                <div class="row">
                    <span>إسم المستخدم : </span>
                    <input type="text" name="user-name" placeholder="إسم المستخدم للدخول للنظام">
                </div>
                <div class="row">
                    <span>كلمة المرور : </span>
                    <input type="password" name="user-password" placeholder="******">
                </div>
                <div class="row">
                    <span>ملاحظات : </span>
                    <input type="text" name="notes" placeholder="ملاحظات">
                </div>
                <div class="add-user btn">إضافة</div>
            </form>
      
        </div>
    </div>
    <script src="../js/admin.js?v=<?php echo time();?>"></script>
</body>

</html>