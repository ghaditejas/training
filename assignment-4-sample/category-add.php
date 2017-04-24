<style>
    input[type="text"] {
        margin-bottom: 0px !important;
    }
</style>

<?php
$page_title = 'Create Category';

//include the header.php
include('includes/header.php');

$message = '';

if(count($_POST) && array_key_exists('name', $_POST)) {
    //echo '<pre>'; print_r($_POST); exit();
    $name = trim(strip_tags($_POST['name']));
    if($name) {
        try {
            $sql = "INSERT INTO a4_category(name) VALUES(:name)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            if($stmt->execute()) {
                $message = 'Category is successfully created.';
            } else {
                $message = 'Error occured while creating a new Category.';
            }
        } catch (Exception $ex) {
            $message = 'Error occured while creating a new Category.';
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
                <form method="POST" action="" name="category-add" id="category-add">
                    <table width="100%" class="table">
                        <tbody>
                            <tr>
                                <th><label for="name">Name:</label></th>
                                <td>
                                    <input type="text" class="" name="name" id="name" maxlength="100" style="width:100%;" required autofocus />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center;">
                                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Create" />
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
