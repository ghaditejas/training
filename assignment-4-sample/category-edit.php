<style>
    input[type="text"] {
        margin-bottom: 0px !important;
    }
</style>

<?php
$page_title = 'Update Category';

//include the header.php
include('includes/header.php');

$message = '';

$id = 0;
$name = '';
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
            if(!empty($category)) {
                $id = $category[0]['id'];
                $name = $category[0]['name'];
            } else {
                header("Location: category-list.php?message=Record not found with id - $id");
                exit();
            }
        }

        //If incase any message is sent using querystring.
        if(array_key_exists('message', $_GET)) {
            $message = $_GET['message'];
        }
    } catch (Exception $ex) {

    }
} else {
    header("Location: category-list.php?message=Invalid Request.");
    exit();
}


/**
 * On submit, update the record.
 */
if(count($_POST) && array_key_exists('id', $_POST) && array_key_exists('name', $_POST)) {
    //echo '<pre>'; print_r($_POST); exit();
    $id = (int) trim(strip_tags($_POST['id']));
    $name = trim(strip_tags($_POST['name']));
    if($id && $name) {
        try {
            $sql = "UPDATE a4_category SET name = :name WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            if($stmt->execute()) {
                $message = 'Category is successfully updated.';
            } else {
                $message = 'Error occured while updating the Category.';
            }
        } catch (Exception $ex) {
            $message = 'Error occured while updating the Category.';
        }
    }
}

?>

<!-- Content Section Start-->
<div class="section content_section">
    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        
        <div class="filable_form_container">
            <div class="mange_buttons">
                <ul>
                    <li><a href="category-list.php">Go to Category List</a></li>
                </ul>
            </div>
            <div class="">
                <form method="POST" action="" name="category-edit" id="category-edit">
                    <table width="100%" class="table">
                        <tbody>
                            <tr>
                                <th><label for="name">Name:</label></th>
                                <td>
                                    <input type="text" class="" name="name" id="name" maxlength="100" style="width:100%;" required autofocus value="<?php echo $name; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Update" />
                                    <a href="category-list.php" class="btn btn-info" style="padding:9px 12px; border-radius:0;">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>		
</div>
<!-- Content Section End-->

<?php
//include the footer.php
include('includes/footer.php');
