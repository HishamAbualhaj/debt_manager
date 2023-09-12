<?php
include_once "config.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: ../index.php');
}

$query = "SELECT * FROM history WHERE id = $id ORDER BY created_at ASC";

$sql = mysqli_query($conn, $query);

// get current date for printing the report
$current_date = date('Y-m-d');


$query2 = "SELECT * FROM users WHERE id = $id";
$sql2 = mysqli_query($conn, $query2);
$row_name = mysqli_fetch_assoc($sql2);
$counter = 0;
if (mysqli_num_rows($sql) > 0) {
    echo
        "<div class=\"report-title\">
            <h1>كشف المعاملات</h1>
        </div>
        <div class=\"report-exist exist\">X</div>
        <div class=\"report-info\">
            <div class=\"row user-name bb-1\">الاسم : <span>" . $row_name['name'] . "</span></div>
            <div class=\"row report-date\">تاريخ طباعة التقرير : <span>" . $current_date . "</span></div>
        </div>

        <table class=\"report-table\">
            <tr class=\"table_header\">
                <th></th>
                <th>الرصيد المحول</th>
                <th>الرصيد الجديد</th>
                <th>تاريخ العملية</th>
                <th>وصف الحالة</th>
                <th>نوع العملية</th>
            </tr>
        ";
    while ($row = mysqli_fetch_assoc($sql)) {
        $counter++;
        // just for styling the transfer type field
        if ($row['transfer_type'] == 'إضافة') {
            echo "<tr>
                    <td class = \"deleTransc\" data-id = " . $row['transc_id'] . " data-number = \"$counter\">X</td>
                    <td>
                        " . $row['amount_transfer'] . "
                    </td>
                    <td>" . $row['new_amount'] . "</td>
                    <td class=\"date\"> " . $row['date'] . "</td>
                    <td class=\"description\"> " . $row['description'] . "</td>
                    <td class = \"op-type add\">" . $row['transfer_type'] . "</td>
                </tr>
                ";
        } else {
            echo "<tr>
                    <td class = \"deleTransc\" data-id = " . $row['transc_id'] . " data-number = \"$counter\" >X</td>
                    <td>
                        " . $row['amount_transfer'] . "
                    </td>
                    <td>" . $row['new_amount'] . "</td>
                    <td class=\"date\">" . $row['date'] . "</td>
                    <td class=\"description\"> " . $row['description'] . "</td>
                    <td class = \"op-type off\">" . $row['transfer_type'] . "</td>
                </tr>";
        }

    }
    echo "</table>";
    echo "<div class=\"print-rep btn\">طباعة التقرير</div>";
    // no values in the database then print the default table ! 
} else {
    echo "empty";
}
?>