<?php
//include the header.php
include('includes/db.php');

$availability = false;

$id = 0;
$name = '';
if(array_key_exists('name', $_POST)) {
    $name = trim(strip_tags($_POST['name']));
    if($name) {
        if(array_key_exists('id', $_POST)) {
            $id = (int) $_POST['id'];
        }
        
        try {
            if($id) {
                $sql = "SELECT id FROM a4_category WHERE id != $id AND name='$name' LIMIT 1";
            } else {
                $sql = "SELECT id FROM a4_category WHERE name='$name' LIMIT 1";
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            if($result) {
                $result = $stmt->fetchAll();
                if(count($result) == 0) {
                    $availability = true;
                }
            }
        } catch (Exception $ex) {
            
        }
    }
}

echo $availability ? 'true' : 'false';
exit();