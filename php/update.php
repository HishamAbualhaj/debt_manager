<?php 
    include_once "config.php";
    include_once "isSession.php";
    
    if(isset($_GET['id']) && isset($_GET['amount']) && isset($_GET['type']) && isset($_GET['description'])) {
        // get user id for update the values 
        $id = $_GET['id'];
        $amount = $_GET['amount'];
        $type = $_GET['type'];
        $transc_date = $_GET['transc_date'];
         // get the date
        if(empty($transc_date)) {
            $current_date = date('Y-m-d');
        }else {
            $current_date = $transc_date;
        }
        $description = $_GET['description'];

        // make sure this user is still in the system
        $isValid = "SELECT * FROM mainusers WHERE mainUserId = '$userId'";
        $q = mysqli_query($conn,$isValid);

        if(!(mysqli_num_rows($q) > 0)) {
            session_unset();
            session_destroy();
            echo 'deletedUser';
        // there is a user then do something !
        } else {
               // get user amount to update
            $sql = "SELECT amount FROM users WHERE id = $id";

            // get query for the current amount
            $current_amount = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($current_amount);

            if($type === 'add') {
                $new_amount = $row['amount'] + $amount;
                $type = 'إضافة';
                storeHistory($new_amount,$type);
                storeNewAmount($new_amount);
            } else if($type === 'off'){

                // make sure there's enough amount to take !
                $new_amount = $row['amount'] - $amount;
                $type = 'خصم';
                storeHistory($new_amount,$type);
                storeNewAmount($new_amount);
            }
        }

    }else {
        header("Location: ../index.php");
    }
    function storeHistory($new_amount,$type) {
        // accessing the global variables from function! 
        global $conn,$id,$amount,$type,$current_date,$description,$userId;
        $transaction_id = time() + rand(1,1000);
        $insert_query = mysqli_query($conn, "INSERT INTO history (mainUserId ,id,transc_id, transfer_type, amount_transfer,new_amount,date,description)
        VALUES ('{$userId}','{$id}','{$transaction_id}','{$type}', '{$amount}','{$new_amount}','{$current_date}','{$description}')");

        if(!$insert_query){
            echo 'error';
        }
    }

    // set the new amount
    function storeNewAmount($new_amount) {
        // accessing the global variables from function! 
        global $conn,$id;
        $sql2 = "UPDATE users SET amount = $new_amount WHERE id = $id"; 
        
        if (mysqli_query($conn, $sql2)) {
            echo 'success';
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    }

 
?>