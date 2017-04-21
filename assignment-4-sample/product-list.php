<?php
$page_title = 'Product List';

//include the header.php
include('includes/header.php');

$message = '';
$products = array();

try {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = 0;
    $limit = $page_size;
    if($page > 1) {
        $offset = ($page - 1) * $page_size;
    }
    
    $category_id = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
    
    $where_condition = "";
    if($category_id) {
        $where_condition = "WHERE p.category_id = $category_id";
    }
    
    $sql = "SELECT p.*, c.name AS category_name"
        . " FROM a4_product p"
        . " INNER JOIN a4_category c ON c.id = p.category_id"
        . " $where_condition"
        . " ORDER BY p.id"
        . " LIMIT $limit OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($result) {
        $products = $stmt->fetchAll();
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
                    <li><a href="category-list.php">Go to Category List</a></li>
                    <li><a href="product-add.php?category_id=<?php echo $category_id; ?>">Create Product</a></li>
                    <li><a href="javascript:void(0);" id="bulk_delete_product" data-category_id="<?php echo $category_id; ?>">Delete</a></li>
                </ul>
            </div>
            
            <table width="100%" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">
                            <input type="checkbox" class="" id="select_all" />
                        </th>
                        <th style="width:5%">Id</th>
                        <th style="width:20%">Category Name</th>
                        <th style="width:20%">Product Name</th>
                        <th style="width:10%">Price</th>
                        <th style="width:10%">Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($products)) {
                            foreach($products as $product) {
                    ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select_single" value="<?php echo $product['id']; ?>" />
                                    </td>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo $product['category_name']; ?></td>
                                    <td><?php echo $product['name']; ?></td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td>
                                        <?php
                                            if($product['image']) {
                                                echo '<img class="product-image" src="'.($productUploadFilePath.'/'.$product['image']).'" />';
                                            } else {
                                                echo '&nbsp;';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="buttons">
                                            <a class="btn btn-warning" href="product-edit.php?category_id=<?php echo $category_id; ?>&id=<?php echo $product['id']; ?>">Edit</a>
                                            <a class="btn btn-danger delete-product" href="javascript:void(0);" data-category_id="<?php echo $category_id; ?>" data-id="<?php echo $product['id']; ?>">Delete</a>
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
                $sql = "SELECT COUNT(*) AS total_rows FROM a4_product";
                if($category_id)
                    $sql = "SELECT COUNT(*) AS total_rows FROM a4_product WHERE category_id = $category_id";
                else
                    $sql = "SELECT COUNT(*) AS total_rows FROM a4_product";
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
                            
                            echo '<li><a href="product-list.php?category_id='.$category_id.'">First</a></li>';
                            
                            $counter = 1;
                            for($counter = 1; $counter <= $pages; $counter++) {
                                $current_page_class = $counter == $page ? 'pagination_highlight' : '';
                                
                                echo '<li><a class="'.$current_page_class.'" href="product-list.php?category_id='.$category_id.'&page='.$counter.'">'.$counter.'</a></li>';
                            }
                            
                            echo '<li><a href="product-list.php?category_id='.$category_id.'&page='.--$counter.'">Last</a></li>';
                        } elseif($total_rows == 0) {
                            echo 'No records found';
                        }
                    ?>
                </ul>
            </div>
            <div class="pagination_listing" style="float:left; text-align:right; width:50%;">
                <ul>
                    <?php
                        if(!empty($products)) {
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