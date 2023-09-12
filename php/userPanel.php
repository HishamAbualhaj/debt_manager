<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debt Manager</title>
    <!-- css styling  -->
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
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
            header("location: ../index.php");
        }else {
            // if you are not a user u can't go to this page ! must be a user
            if(($_SESSION['user'] == "13733695")) {
                header("location: ../index.php");
            }
        }
    ?>
<?php include_once "config.php";?>
<body dir="rtl">
    <!-- start of website  -->
    <div class="website-wrapper">
        <!-- table of content  -->
        <div class="data-table">
            <div class="page-title">
                <h1>جدول المعاملات</h1>
            </div>
            <div class="btns">
                <div class="add btn"> إضافة مستخدم</div>
                <div class="logout"><a href="">تسجيل الخروج</a></div>
            </div>
            <div class="query-result"></div>
            <div class="data">
                <table>
                    <tr>
                        <th>الإسم</th>
                        <th>النوع</th>
                        <th>المبلغ الإجمالي</th>
                    </tr>

                    <?php 
                        $userId = $_SESSION['user'];
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE mainUserId = '{$userId}' ");
                        if(mysqli_num_rows($sql) > 0) {
                            while($row = mysqli_fetch_assoc($sql)) {
                            echo 
                            "<tr>
                                <td class = \"details\">
                                    ".$row['name']."
                                   
                                    <input type = \"text\" class = \"user_id\" name = \"user_id\"  hidden value = ".$row['id'].">
                                </td>
                                <td>".$row['type']."</td>
                                <td class = \"user_amount\">".$row['amount']."</td>
                            </tr>";
                            }
                        }

                    ?>
                </table>
       
                <?php 
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE mainUserId = $userId");
                 if(mysqli_num_rows($sql) > 0) {
                    $final = 0;
                    while($row = mysqli_fetch_assoc($sql)) {
                        $final = $final + $row['amount'];
                    }
                    echo "
                    <div class=\"showAll\">
                        المبلغ الكلي : 
                        <span>".$final."</span>
                    </div>
                    ";
                 }
                ?>    
            </div>
        <!-- table of content  -->

        </div>
    </div>

    <script src="../js/print.js?v=<?php echo time(); ?>"></script>
    <script src="../js/operations.js?v=<?php echo time(); ?>"></script>

</body>

</html>