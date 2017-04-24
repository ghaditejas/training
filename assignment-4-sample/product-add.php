<style>
    input[type="text"] {
        margin-bottom: 0px !important;
    }
</style>

<?php
$page_title = 'Create Product';

$category_id = (int) (isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0);
if($category_id) {
    
} else {
    header("Location: category-list.php?message=Invalid Request.");
    exit();
}

//include the header.php
include('includes/header.php');

$message = '';

$category_name = '';

//Check if category record exists.
try {
    $sql = "SELECT name FROM a4_category WHERE id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($result) {
        $category = $stmt->fetchAll();
        if(!empty($category)) {
            $category_name = $category[0]['name'];
        } else {
            header("Location: category-list.php?message=Record not found with id - $category_id");
            exit();
        }
    }

    //If incase any message is sent using querystring.
    if(array_key_exists('message', $_GET)) {
        $message = $_GET['message'];
    }
} catch (Exception $ex) {
    header("Location: category-list.php?message=Invalid Request.");
    exit();
}

$id = 0;
$name = '';
$price = '';
$image = '';

if(count($_POST) && array_key_exists('name', $_POST)) {
    //echo '<pre>'; print_r($_POST); exit();
    $name = trim(strip_tags($_POST['name']));
    $price = trim(strip_tags($_POST['price']));
    $image = isset($_FILES['image']) ? $_FILES['image'] : array();
    if($name) {
        try {
            if(!empty($image) && $image['size'] > 0) {
                $temp_name = $image['tmp_name'];
                $image = generateUniqueFilename($image['name'], $productUploadFilePath);
                
                //Upload the file.
                if(move_uploaded_file($temp_name, $productUploadFilePath.'/'.$image)) {
                    //change the permission of the file, so that it can be deleted when record is deleted.
                    chmod($productUploadFilePath.'/'.$image, 0777);
                }
            } else {
                $image = '';
            }
            
            $sql = "INSERT INTO a4_product(category_id, name, price, image) VALUES(:category_id, :name, :price, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':image', $image, PDO::PARAM_STR);
            if($stmt->execute()) {
                $message = 'Product is successfully created.';
            } else {
                $message = 'Error occured while creating a new Product.';
            }
        } catch (Exception $ex) {
            $message = 'Error occured while creating a new Product.';
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
                    <li><a href="product-list.php?category_id=<?php echo $category_id; ?>">Go to Product List</a></li>
                </ul>
            </div>
            <div class="">
                <form method="POST" action="" name="product-add" id="product-add" enctype="multipart/form-data">
                    <table width="100%" class="table">
                        <tbody>
                            <tr>
                                <th><label for="category_id">Category Name:</label></th>
                                <td>
                                    <?php echo $category_name; ?>
                                    <input type="hidden" class="" name="category_id" id="category_id" value="<?php echo $category_id; ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th><label for="name">Name:</label></th>
                                <td>
                                    <input type="text" class="" name="name" id="name" maxlength="100" style="width:100%;" required autofocus />
                                </td>
                            </tr>
                            <tr>
                                <th><label for="price">Price:</label></th>
                                <td>
                                    <input type="number" step="1.00" class="" name="price" id="price" maxlength="11" style="width:100%;" required />
                                </td>
                            </tr>
                            <tr>
                                <th><label for="image">Image:</label></th>
                                <td>
                                    <input type="file" class="" name="image" id="image" style="width:100%;" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">
                                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Create" />
                                    <a href="product-list.php?category_id=<?php echo $category_id; ?>" class="btn btn-info" style="padding:9px 12px; border-radius:0;">Cancel</a>
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
