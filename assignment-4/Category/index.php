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
                    <li><a href="add_category.php">Create Category</a></li>
                    <li><a href="javascript:del_func()" id="deletebatch">Delete</a></li>
                </ul>
            </div>
            <div class="table_container_block">
                <!--<form id="frm_cate_list" action="deletebatch.php" method="post">-->
                <table width="100%">
                    <thead>
                        <tr>
                            <th width="10%">
                                <input class="checkbox uncheck" id="checkall" type="checkbox"> 
                                <label class="css-label mandatory_checkbox_fildes" for="checkall"></label>
                            </th>
                            <th style="width:60%">Name</th>
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
                                        <input class="checkbox checkbox_check" id="<?php echo $row['id'] ?>" type="checkbox" name="cat_ids[]" value="<?php echo $row['id']; ?>">
                                        <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['id'] ?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="edit_category.php?<?php echo "category_id=" . $row['id']; ?>">Edit</a>
                                            <a class="btn1 btn-info" href="#">Products</a>
                                        </div>								
                                    </td>
                                </tr>
                                <?php
                            }
                          }mysqli_close($conn);
                        ?>

                    </tbody>
                </table>
                <!--</form>-->
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
   /*
    * Deletes the selected categories
    */
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
                    url: 'deletebatch.php',
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
    /*
     *Checks the slave checkbox once the master s checked and unchecks the master if any of the slave is unchecked 
     */
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
  