
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
                    <li><a href="<?php echo base_url()?>category/add">Create Category</a></li>
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
                        <?php foreach($list as $row){
//                                ?><tr>
                                    <td>
                                        <input class="checkbox checkbox_check" id="<?php echo $row['id'] ?>" type="checkbox" name="cat_ids[]" value="<?php echo $row['id'] ?>">
                                        <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['id'] ?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="<?php echo base_url()?>category/edit/<?php echo $row['id'];?>">Edit</a>
                                            <a class="btn1 btn-info" href="../Product/list_product.php?<?php //echo "category_id=" . $row['id']; ?>">Products</a>
                                        </div>								
                                    </td>
                                </tr>
                                <?php
                                }
                        ?>

                    </tbody>
                </table>
                <!--</form>-->
            </div>
            <div class="pagination">
                <ul>
                    <li><a href="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=1" ?>javascript:void(0)">first</a></li>
                    <?php
                    /*
                     * Pagination is implemented using 'count' query
                     */
//                    $sql= "SELECT count(*) as count from assign_category where status=1";
//                    $result = $conn->query($sql);
//                    $row= $result->fetch_assoc();
//                    $total_entry= $row['count'];
//                    do{
//                    ?>
                    <li><a href="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".($i+1); ?>javascript:void(0)"<?php //(($i*$limit)==($offset)){echo 'class="selected"';}?>><?php //echo $i+1;?></a>
                    <?php //$i++; 
//                    } while($i<$total_entry/$limit);
//                    mysqli_close($conn);?>    
                    <li><a href="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"])."?page=".$i ?>javascript:void(0)">last</a></li>
                </ul>
            </div>
        </div>
    </div>		
</div>
<script type="text/javascript">
    <?php $success= $this->session->flashdata('success');?>
    <?php if(!empty($success)){
        ?>
    alert('<?php echo $success;?>');
    <?php
    
    }?>
</script>
<script src="<?php echo base_url()?>assets/js/checkall.js" type="text/javascript"></script>
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
            console.log(arr);
            if (r)
                $.ajax({
                    url: '<?php echo base_url();?>category/delete',
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
</script>
  