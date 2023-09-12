<?php 
    include_once "config.php";
    if(isset($_GET['idTransc'])) {
        $id = $_GET['idTransc'];
        // update amount for user 
        $sql_amount = "SELECT * FROM history WHERE transc_id = '$id' ";
        $query_amount = mysqli_query($conn,$sql_amount);
        
        // you got a transaction then go this : 
        if ($query_amount) {
            // getting others transaction data ! 
            $row = mysqli_fetch_array($query_amount);
            $id_amount = $row['id'];

            $sql_current_amount = "SELECT amount FROM users WHERE id = $id_amount";
            $get_query_amount = mysqli_query($conn,$sql_current_amount);
            $current_amount = mysqli_fetch_array($get_query_amount);
            if ($row['transfer_type'] === 'إضافة') {
                $old_amount = $current_amount['amount'] - $row['amount_transfer'];
                $update_amount = "UPDATE users SET amount = $old_amount WHERE id = $id_amount ";

                // make sure update is done !
                $update_query = mysqli_query($conn,$update_amount);
                if($update_query) {
                    // delete transaction
                    $sql = "DELETE FROM history WHERE transc_id = '$id' ";
                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        echo 'success';
                    }
                    
                }else {
                    echo 'error';
                }
                
            } else if ($row['transfer_type'] === 'خصم') {
                $old_amount =  $current_amount['amount'] + $row['amount_transfer'];
                $update_amount = "UPDATE users SET amount = $old_amount WHERE id = $id_amount ";

                // make sure update is done !
                $update_query = mysqli_query($conn,$update_amount);
                if($update_query) {
                    // delete transaction
                    $sql = "DELETE FROM history WHERE transc_id = '$id' ";
                    $query = mysqli_query($conn, $sql);

                    if ($query) {
                        echo 'success';
                    }
                   
                }else {
                    echo 'error';
                }
                
            }
        } else {
            echo 'error';
        }
    
       
    } else {
        header('Location: ../index.php');
    }

?>