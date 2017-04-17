<?php
/*
 * Deletes the checked products by setting status=0 
 */
if (isset($_POST['category_id'])) {
    
include '../Includes/db_config.php';
$sqlquery = "UPDATE assign_product SET status = 0 WHERE id  IN (";
$dd = implode(',',$_POST['category_id']);
$sqlquery.=$dd.")";
if ($conn->query($sqlquery)) {
    echo true;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error();
}
mysqli_close($conn);
}
?>