<?php
include '../Includes/db_config.php';
include '../Includes/header.php';
?>
<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Manage Category</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="mange_buttons">
                <ul>
                    <!--<li class="search_div">
             <div class="Search">
                    <input name="search" type="text" /> 
                    <input type="submit" class="submit" value="submit">
             </div>
                    </li> -->
                    <li><a href="add_category.php">Create Category</a></li>
                    <li><a href="javascript:void(0);" id="deletebatch">Delete</a></li>
                </ul>
            </div>
            <div class="table_container_block">
                <form id="frm_cate_list" action="deletebatch.php" method="post">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th width="10%">
                                    <input class="checkbox" id="0" type="checkbox"> 
                                    <label class="css-label mandatory_checkbox_fildes" for="0"></label>
                                </th>
                                <th style="width:60%">Name <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            <?php
                            $sqlquery = "SELECT id,name From assign_category where status = 1";
                            $result = $conn->query($sqlquery);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?><tr>
                                        <td>
                                            <input class="checkbox" id="<?php echo $row['id'] ?>" type="checkbox" name="cat_ids[]" value="<?php echo $row['id']; ?>">
                                            <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['id'] ?>"></label>
                                        </td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td>
                                            <div class="buttons">
                                                <button class="btn btn_edit" onclick="del_func(<?php echo $row['id'] ?>)">Delete</button>
                                                <a  class="btn btn_delete" href="edit_category.php?<?php echo "category_id=" . $row['id']; ?>">Edit</a>
                                                <button class="btn_products">Products</button>
                                            </div>								
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>

                        </tbody>
                    </table>
                </form>
            </div>

            <div class="pagination">
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
    function del_func(id) {
        var r = confirm("Are you sure you want to delete");
        if (r)
            $.ajax({
                url: 'delete_category.php',
                data: {category_id: id},
                type: 'post',
                success: function (output) {
                    if (output == 1) {
                        alert("category deleted successfully");
                        location.reload();
                    }

                }
            });
    }
    $(document).ready(function(){$('#deletebatch').click(function () {
        $('#frm_cate_list').submit();
    });});
</script>
<?php include '../Includes/footer.php'; ?>
  