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
        include_once "config.php";
        if(!isset($_SESSION['user'])){
            header("location: loginAdmin.php");
        }else {
            // if you are not the admin u can't go to this page
            if(!($_SESSION['user'] == "13733695")) {
                header("location: ../index.php");
            }
        }
    ?>
<?php include_once "config.php"?>    
<body dir="rtl">
    <div class="admin-panel">
        <div class="header">
            <div class="title">صفحة الإدارة</div>
            <div class="logout"><a href="">تسجيل الخروج</a></div>
        </div>
        <div class="content" >
            <div class="tabs">
                <div class="tab"><a href="adminAdd.php">إضافة مستخدمين</a></div>
                <div class="tab active"><a href="adminUsers.php">بيانات مستخدمين</a></div>
            </div>
    
            <table class="users">
                <tr>
                    <th>إسم المستخدم</th>
                    <th>كلمة المرور</th>
                    <th>ملاحظات</th>
                    <th>إجراءات</th>
                
                </tr>
            <?php
                $sql = "SELECT * FROM mainusers";
                $query= mysqli_query($conn,$sql);
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_array($query)) {
                        echo "
                        <tr>
                            <td>
                            ".$row['username']."
                            <input class=\"userId\" type=\"text\" hidden value=".$row['mainUserId'].">
                            </td>
                            <td>".$row['password']."</td>
                            <td>".$row['notes']."</td>
                            <td>
                                <div class=\"deleBtn\">
                                    حذف
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                }
            ?>
               

            </table>
        </div>
    </div>
    <script src="../js/admin.js?v=<?php echo time();?>"></script>
</body>

</html>