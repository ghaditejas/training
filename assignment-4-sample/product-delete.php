<?php
//include the db.php
include('includes/db.php');

$productUploadFilePath = 'uploads/product';

$status = 'error';
$message = 'Error occured while deleting the record.';

//Single product delete
$category_id = 0;
$id = 0;
if(count($_GET) && array_key_exists('category_id', $_GET) && array_key_exists('id', $_GET)) {
    $category_id = (int) $_GET['category_id'];
    $id = (int) $_GET['id'];
    
    //Check if record exists.
    try {
        $sql = "SELECT * FROM a4_product WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($result) {
            $product = $stmt->fetchAll();
            if(!empty($product)) {
                if($product[0]['category_id'] == $category_id) {
                    $image = $product[0]['image'];
                    
                    $sql = "DELETE FROM a4_product WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    if($stmt->execute()) {
                        //If image then delete it too.
                        if($image) {
                            unlink(__DIR__.'/'.$productUploadFilePath.'/'.$image);
                        }
                        
                        header("Location: product-list.php?category_id=$category_id&message=Record is successfully deleted.");
                        exit();
                    }
                } else {
                    header("Location: product-list.php?category_id=$category_id&message=Invalid Product.");
                    exit();
                }
            } else {
                header("Location: product-list.php?category_id=$category_id&message=Record not found with id - $id");
                exit();
            }
        }
    } catch (Exception $ex) {

    }
} else {
    //Check if bulk product delete
    $ids = array();
    if(count($_POST) && array_key_exists('category_id', $_POST) && array_key_exists('ids', $_POST)) {
        $category_id = (int) $_POST['category_id'];
        $ids = (array) $_POST['ids'];

        //Check if records exist.
        try {
            if($category_id && !empty($ids)) {
                foreach($ids as $id) {
                    $sql = "SELECT * FROM a4_product WHERE id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();

                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    if($result) {
                        $product = $stmt->fetchAll();
                        if(!empty($product)) {
                            $image = $product[0]['image'];
                            
                            $sql = "DELETE FROM a4_product WHERE id = :id";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                            if($stmt->execute()) {
                                $status = 'success';
                                
                                //If image then delete it too.
                                if($image) {
                                    unlink(__DIR__.'/'.$productUploadFilePath.'/'.$image);
                                }
                            }
                        }
                    }
                }
                $message = 'Product(s) are successfully deleted.';
            } else {
                $message = 'Please select at least one product to delete.';
            }
            echo json_encode(array(
                'status' => $status,
                'message' => $message,
            ));
            exit();
        } catch (Exception $ex) {

        }
    } else {
        header("Location: product-list.php?category_id=$category_id&message=Invalid Request.");
        exit();
    }
}

header("Location: product-list.php?category_id=$category_id&message=$message");
exit();