<?php
$i=0;
$offset=0;
$limit=2;
if(isset($_GET['page']))
{
    $offset=($_GET['page']-1)*$limit;
}
if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
}
include '../includes/db_config.php';//Includes database Configuration php file
include '../includes/header.php';//Includes Header html file
?>
<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Manage Products</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="mange_buttons">
                <ul>
                    <li><a href="add_product.php">Create Product</a></li>
                    <li><a href="javascript:del_func();">Delete</a></li>
                </ul>
            </div>
            <div class="table_container_block">
                <table width="100%">
                    <thead>
                        <tr>
                            <th width="10%">
                                <input type="checkbox" class="checkbox uncheck" id="checkall"> <label class="css-label mandatory_checkbox_fildes" for="checkall"></label>
                            </th>
                            <th style="">Product Name <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                            <th style="">Product Image</th>
                            <th style="">Product Price</th>
                            <th style="">Product Category <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /*
                         * Displays the list of product as per the given category Id's after applying limit and offset on it 
                         */
                        if (empty($id)) {
                            $sqlquery = "SELECT assign_product.id AS prod_id,assign_product.name,assign_product.image,  
                                     assign_product.price,assign_category.name AS cat_name 
                                     FROM   assign_category  
                                     LEFT JOIN assign_product  
                                     ON assign_category.id = assign_product.category WHERE assign_product.status = 1 LIMIT ".$limit." OFFSET ".$offset;
                        } else {
                            $sqlquery = "SELECT assign_product.id AS prod_id,assign_product.name,assign_product.image,  
                                     assign_product.price,assign_category.name AS cat_name 
                                     FROM   assign_category  
                                     LEFT JOIN assign_product  
                                     ON assign_category.id = assign_product.category where 
                                     assign_product.category='" . $id . "' AND assign_product.status = 1 LIMIT ".$limit." OFFSET ".$offset;
                        }
                        $result = $conn->query($sqlquery);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox checkbox_check" id="<?php echo $row['prod_id']; ?>" value="<?php echo $row['prod_id']; ?>"> <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['prod_id'] ?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td style="text-align:center">
                                        <?php if (!empty($row['image'])) { ?>
                                            <?php if (!file_exists('../upload/' . $row['image'])) { ?>
                                                <img src="../images/default-image.jpg" style="width:80px; height:auto;" alt="Image NOT Available">
                                            <?php } else { ?>
                                                <img src="../upload/<?php echo $row['image'] ?>" style="width:80px; height:auto;" alt="Image NOT Available">
                                            <?php }
                                        } else { ?>    
                                            <img src="../images/default-image.jpg" style="width:80px; height:auto;" alt="Image NOT Available"><?php } ?></td>
                                    <td style="text-align:right"><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['cat_name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="edit_product.php?<?php echo "product_id=" . $row['prod_id'] . "" ?>">">Edit</a>
                                        </div>								
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <ul>
                    <li><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=1" ?>">first</a></li>
                    <?php 
                    /*
                     * Pagination is implemented using 'count' query
                     */
                    if (empty($id)){
                    $sql= "SELECT count(*) as count from assign_product where status=1";
                    }else{
                        $sql= "SELECT count(*) as count from assign_product where category=".$id." AND status=1";
                    }
                    $result = $conn->query($sql);
//                    print_r($result);
                    $row= $result->fetch_assoc();
                    $total_entry= $row['count'];
                    do{
                    ?>
                    <li><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".($i+1) ?>"<?php if(($i*$limit)==($offset)){echo 'class="selected"';}?>><?php echo $i+1;?></a>
                    <?php $i++; 
                    } while($i<$total_entry/$limit);
                    mysqli_close($conn);?>
                    <li><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".$i ?>">last</a></li>
                </ul>
            </div>

        </div>
    </div>		
</div>
<script type="text/javascript">
    function del_func() {
        var arr = [];
        $('input.checkbox_check:checkbox:checked').each(function () {
            arr.push($(this).val());
        });
        if (arr.length == 0) {
            alert("Please select the category you want to delete");
        } else {
            var r = confirm("Are you sure you want to delete");
            if (r)
                $.ajax({
                    url: 'del_product.php',
                    data: {category_id: arr},
                    type: 'post',
                    success: function (output) {
                        if (output == 1) {
                            alert("Selected category deleted successfully");
                            location.reload();
                        }

                    }
                });
        }
    }
    $(document).ready(function () {
        $("#checkall").change(function () {
            if (this.checked) {
                $("input.checkbox_check").each(function () {
                    this.checked = true;
                })
            } else {
                $("input.checkbox_check").each(function () {
                    this.checked = false;
                })
            }
        });
        $("input.checkbox_check:checkbox").click(function () {
            if (!this.checked) {
                $("#checkall").prop('checked', false);
            }
        });
    });
</script>
<?php include '../includes/footer.php'; ?>