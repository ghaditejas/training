
<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Manage Category</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="mange_buttons">
                <form action="<?php echo base_url(); ?>" method="post">
                    <ul> 
                        <li> 
                        <li><input type="search" id="search" name="search" value="<?php echo $search; ?>" placeholder="SEARCH"></li>
                        <li><input class="btn btn-primary" type="button" onclick="$(this).closest('form').submit();" value="Search"></li>
                        <li><input class="btn btn-primary" type="button" onclick="location.href = '<?php echo base_url(); ?>'" value="Reset"></li>
                        </li>
                        <li><a href="<?php echo base_url() ?>category/add">Create Category</a></li>
                        <li><a href="javascript:del_func()" id="deletebatch">Delete</a></li>
                    </ul>
                </form>
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
                        if (!empty($list)) {
                            foreach ($list as $row) {
//                                
                                ?><tr>
                                    <td>
                                        <input class="checkbox checkbox_check" id="<?php echo $row['id'] ?>" type="checkbox" name="cat_ids[]" value="<?php echo $row['id'] ?>">
                                        <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['id'] ?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="<?php echo base_url() ?>category/edit/<?php echo $row['id']; ?>">Edit</a>
                                            <a class="btn1 btn-info" href="<?php echo base_url() ?>product/view/<?php echo $row['id']; ?>">Products</a>
                                        </div>								
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="6" style="text-align:center;">No Record Found ...!!!</td></tr>
<?php } ?>

                    </tbody>
                </table>
                <!--</form>-->
            </div>
            <div class="pagination">
                    <?php if ($pages > 1) { ?>
                    <ul>
                        <li><a class="page" href="javascript:void(0)" offset="1">first</a></li>
                        <?php
                        /*
                         * Pagination is implemented using 'count' query
                         */
                        $i = 0;
                        while ($i < $pages) {
                            $selected = false;
                            if (($i * LIMIT) == ($offset)) {
                                $selected = true;
                            }
                            if (!$selected) {
                                $_url = base_url() . "product/view/" . ($i + 1);
                            } else {
                                $_url = "javascript:void(0)";
                            }
                            ?>
                            <li><a class="page <?php if ($selected) {
                        echo "selected";
                    } ?>" href="javascript:void(0)" offset="<?php echo ($i + 1); ?>"><?php echo $i + 1; ?></a></li>
                            <?php
                            $i++;
                        }
                        ?>
                        <li><a  class="page" href="javascript:void(0)"offset="<?php echo $pages; ?>">last</a></li>
                    </ul>
<?php } ?>
            </div>
        </div>
    </div>		
</div>
<form id="frm_page" action="" style="display:none;" method="post">
    <input id="offset" name="offset" type="hidden" value="" /> 
    <input id="search"  name="search_saved" type="hidden" value="<?php echo $search; ?>" />
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.page').click(function () {
            var offset = $(this).attr('offset');
            $('#offset').val(offset);
            $('#frm_page').submit();
        });
    });
<?php $success = $this->session->flashdata('success'); ?>
<?php if (!empty($success)) {
    ?>
        alert('<?php echo $success; ?>');
    <?php }
?>
</script>
<script src="<?php echo base_url() ?>assets/js/checkall.js" type="text/javascript"></script>
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
                    url: '<?php echo base_url(); ?>category/delete',
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
