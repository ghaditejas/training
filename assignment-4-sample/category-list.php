<?php
$page_title = 'Category List';

//include the header.php
include('includes/header.php');

$message = '';
$categories = array();

try {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = 0;
    $limit = $page_size;
    if($page > 1) {
        $offset = ($page - 1) * $page_size;
    }
    
    $sql = "SELECT * FROM a4_category ORDER BY id LIMIT $limit OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($result) {
        $categories = $stmt->fetchAll();
    }
    
    //If incase any message is sent using querystring.
    if(array_key_exists('message', $_GET)) {
        $message = $_GET['message'];
    }
} catch (Exception $ex) {
    
}
?>

<!-- Content Section Start-->
<div class="section content_section">
    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        
        <div class="filable_form_container">
            <div class="mange_buttons">
                <ul>
                    <li><a href="category-add.php">Create Category</a></li>
                    <li><a href="javascript:void(0);" id="bulk_delete_category">Delete</a></li>
                </ul>
            </div>
            
            <table width="100%" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">
                            <input type="checkbox" class="" id="select_all" />
                        </th>
                        <th style="width:5%">Id</th>
                        <th style="width:60%">Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($categories)) {
                            foreach($categories as $category) {
                    ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select_single" value="<?php echo $category['id']; ?>" />
                                    </td>
                                    <td><?php echo $category['id']; ?></td>
                                    <td><?php echo $category['name']; ?></td>
                                    <td>
                                        <div class="buttons">
                                            <a class="btn btn-primary" href="product-list.php?category_id=<?php echo $category['id']; ?>">List Products</a>
                                            <a class="btn btn-warning" href="category-edit.php?id=<?php echo $category['id']; ?>">Edit</a>
                                            <a class="btn btn-danger delete-category" href="javascript:void(0);" data-id="<?php echo $category['id']; ?>">Delete</a>
                                        </div>								
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>

            <?php
                $total_rows = 0;
                $sql = "SELECT COUNT(*) AS total_rows FROM a4_category";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                if($result) {
                    $countArray = $stmt->fetchAll();
                    if(!empty($countArray)) {
                        $total_rows = $countArray[0]['total_rows'];
                    }
                }
            ?>
            <div class="pagination_listing" style="float:left; width:50%;">
                <ul>
                    <?php
                        if($total_rows > 1) {
                            $pages = ceil($total_rows / $page_size);
                            
                            echo '<li><a href="category-list.php">First</a></li>';
                            
                            $counter = 1;
                            for($counter = 1; $counter <= $pages; $counter++) {
                                $current_page_class = $counter == $page ? 'pagination_highlight' : '';
                                
                                echo '<li><a class="'.$current_page_class.'" href="category-list.php?page='.$counter.'">'.$counter.'</a></li>';
                            }
                            
                            echo '<li><a href="category-list.php?page='.--$counter.'">Last</a></li>';
                        } elseif($total_rows == 0) {
                            echo 'No records found';
                        }
                    ?>
                </ul>
            </div>
            <div class="pagination_listing" style="float:left; text-align:right; width:50%;">
                <ul>
                    <?php
                        if(!empty($categories)) {
                            echo "Displaying: ".(($page * $page_size) - 1)." to ".(($page * $limit) > $total_rows ? $total_rows : ($page * $limit))." of $total_rows";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>		
</div>
<!-- Content Section End-->

<?php
//include the footer.php
include('includes/footer.php');