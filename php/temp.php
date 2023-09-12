<?php 
    include_once "config.php";
    $type = "إضافة";
    $date = date("Y-m-d");
    for($i=1;$i<=19;$i++) {
        $rand_num = rand(10000,1000000);
        $rand_amount = rand(100,1000);
        $rand_amount_2 = rand(200,1000);
        $sql_query = "INSERT INTO `history`(`mainUserId`, `id`, `transc_id`, `transfer_type`, `amount_transfer`, `new_amount`, `date`, `description`, `created_at`) VALUES 
        ('342074875','7','$rand_num','$type','$rand_amount','$rand_amount_2','$date','','')";
        $done = mysqli_query($conn,$sql_query);

        if($done) {
            echo "Success";
        }
    }
?>