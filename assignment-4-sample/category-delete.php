<?php
//include the db.php
include('includes/db.php');

$status = 'error';
$message = 'Error occured while deleting the record.';

//Single category delete
$id = 0;
if(count($_GET) && array_key_exists('id', $_GET)) {
    $id = (int) trim(strip_tags($_GET['id']));
    
    //Check if record exists.
    try {
        $sql = "SELECT * FROM a4_category WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($result) {
            $category = $stmt->fetchAll();
            //echo '<pre>'; print_r($category); exit();
            if(!empty($category)) {
                $sql = "DELETE FROM a4_category WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()) {
                    header("Location: category-list.php?message=Record is successfully deleted.");
                    exit();
                }
            } else {
                header("Location: category-list.php?message=Record not found with id - $id");
                exit();
            }
        }
    } catch (Exception $ex) {

    }
} else {
    //Check if bulk category delete
    $ids = array();
    if(count($_POST) && array_key_exists('ids', $_POST)) {
        $ids = (array) $_POST['ids'];

        //Check if records exist.
        try {
            if(!empty($ids)) {
                foreach($ids as $id) {
                    $sql = "SELECT * FROM a4_category WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();

                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    if($result) {
                        $category = $stmt->fetchAll();
                        if(!empty($category)) {
                            $sql = "DELETE FROM a4_category WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                            if($stmt->execute()) {
                                $status = 'success';
                            }
                        }
                    }
                }
                $message = 'Category(s) are successfully deleted.';
            } else {
                $message = 'Please select at least one category to delete.';
            }
            echo json_encode(array(
                'status' => $status,
                'message' => $message,
            ));
            exit();
        } catch (Exception $ex) {

        }
    } else {
        header("Location: category-list.php?message=Invalid Request.");
        exit();
    }
}

header("Location: category-list.php?message=$message");
exit();