<?php
if (isset($_POST['cat_ids'])) {
    
include '../Includes/db_config.php';
$i=0;
$sqlquery = "UPDATE assign_category SET status = 0 WHERE id  IN (";
$dd = implode(',',$_POST['cat_ids']);
echo $sqlquery.=$dd.")";
if ($conn->query($sqlquery)) {
    echo true;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error();
}
}
header('location:index.php');
?>