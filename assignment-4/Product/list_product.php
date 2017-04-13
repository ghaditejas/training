<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['category_id'];
}
include '../Includes/db_config.php';
include '../Includes/header.php';
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
                        if(empty($id)){
                        $sqlquery = "SELECT assign_product.id AS prod_id,assign_product.name,assign_product.image,  
                                     assign_product.price,assign_category.name AS cat_name 
                                     FROM   assign_category  
                                     LEFT JOIN assign_product  
                                     ON assign_category.id = assign_product.category WHERE assign_product.status = 1";
                        }
                        else{
                        $sqlquery="SELECT assign_product.id AS prod_id,assign_product.name,assign_product.image,  
                                     assign_product.price,assign_category.name AS cat_name 
                                     FROM   assign_category  
                                     LEFT JOIN assign_product  
                                     ON assign_category.id = assign_product.category where 
                                     assign_product.category='".$id."' AND assign_product.status = 1";    
                        }
                        $result = $conn->query($sqlquery);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox checkbox_check" id="<?php echo $row['prod_id'];?>" value="<?php echo $row['prod_id'];?>"> <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['prod_id']?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td style="text-align:center"><img src="../upload/<?php echo $row['image']?>" style="width:80px; height:auto;" alt="Image NOT Available"></td>
                                    <td style="text-align:right"><?php echo $row['price']?></td>
                                    <td><?php echo $row['cat_name']?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="edit_product.php">">Edit</a>
                                        </div>								
                                    </td>
                                </tr>
                             <?php
                            }
                          }mysqli_close($conn);
                        ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination_listing">
                        <ul>
                            <li><a href="#">first</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">Last</a></li>
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
            alert("Please check the category u want to delete");
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
<?php include '../Includes/footer.php'; ?>