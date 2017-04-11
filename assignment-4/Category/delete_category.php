<?php

if (isset($_POST['category_id'])) {
    $id = $_POST['category_id'];
}
include '../Includes/db_config.php';
$sqlquery = "UPDATE assign_category SET status = 0 where id='" . $id . "'";

if ($conn->query($sqlquery)) {
    echo true;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error();
}
mysqli_close($conn);
?>