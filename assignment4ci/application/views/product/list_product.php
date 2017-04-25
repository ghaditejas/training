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
                    <li> <form  action="<?php echo base_url(); ?>product/view" method="post">
                            <li><input class="search_value" type="search" id="search" name="search" value="<?php echo $search;?>"></li>
                            <li><input class="btn btn-primary"type="submit" value="Search"></li>
                            <li><input class="btn btn-danger" type="button" onclick="location.href='<?php echo base_url();?>product/view'" value="Reset"></li>
                        </form></li>
                    <li><a href="<?php echo base_url(); ?>product/add">Create Product</a></li>
                    <li><a href="javascript:del_func()">Delete</a></li>
                </ul>
            </div>
            <div class="table_container_block">
                <table width="100%">
                    <thead>
                        <tr>
                            <th width="10%">
                                <input type="checkbox" class="checkbox uncheck" id="checkall"> <label class="css-label mandatory_checkbox_fildes" for="checkall"></label>
                            </th>
                            <th style="" class="makesort <?php
                            if ($sort_by == 'name') {
                                echo $sort_type;
                            }
                            ?>" data-name="name">Product Name <i class="fa fa-fw fa-sort"></i><!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                            <th style="">Product Image</th>
                            <th style="" class="makesort <?php
                            if ($sort_by == 'price') {
                                echo $sort_type;
                            }
                            ?>" data-name="price">Product Price<i class="fa fa-fw fa-sort"></i></th>
                            <th style="">Product Category <!--<a href="#" class="sort_icon"><img src="images/sort.png"></a>--></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($list)) {
                            /*
                             * Displays the list of product as per the given category Id's after applying limit and offset on it 
                             */
                            foreach ($list as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox checkbox_check" id="<?php echo $row['prod_id']; ?>" value="<?php echo $row['prod_id']; ?>"> <label class="css-label mandatory_checkbox_fildes" for="<?php echo $row['prod_id'] ?>"></label>
                                    </td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td style="text-align:center">
                                        <?php if (!empty($row['image'])) { ?>
                                            <?php if (!file_exists('./upload/' . $row['image'])) { ?>
                                                <img src="<?php echo base_url(); ?>assets/images/default-image.jpg" style="width:80px; height:auto;" alt="Image NOT Available">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>upload/<?php echo $row['image'] ?>" style="width:80px; height:auto;" alt="Image NOT Available">
                                                <?php
                                            }
                                        } else {
                                            ?>    
                                            <img src="<?php echo base_url(); ?>assets/images/default-image.jpg" style="width:80px; height:auto;" alt="Image NOT Available"><?php } ?></td>
                                    <td style="text-align:right"><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['cat_name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="<?php echo base_url(); ?>product/edit/<?php echo $row['prod_id']; ?>">">Edit</a>
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
            </div>

            <div class="pagination">
                <?php if ($pages > 1) { ?>
                    <ul>
                        <li><a class="page" href="javascript:void(0)" category_id="<?php echo $category; ?>" offset="1">first</a></li>
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
                                $_url = base_url() . "product/view/" . $category . "/" . ($i + 1);
                            } else {
                                $_url = "javascript:void(0)";
                            }
                            ?>
                            <li><a class="page <?php
                                if ($selected) {
                                    echo "selected";
                                }
                                ?>" href="javascript:void(0)" offset="<?php echo ($i + 1); ?>" category_id="<?php echo $category; ?>" ><?php echo $i + 1; ?></a></li>
                                <?php
                                $i++;
                            }
                            ?>
                        <li><a  class="page" href="javascript:void(0)" category_id="<?php echo $category; ?>" offset="<?php echo $pages; ?>">last</a></li>
                    </ul>
                <?php } ?>
            </div>

        </div>
    </div>		
</div>
<form id="frm_filter" action="" style="display:none;" method="post">
    <input id="sort_by" name="sort_by" type="hidden" value="<?php echo $sort_by; ?>" />
    <input id="sort_type"  name="sort_type" type="hidden" value="<?php echo $sort_type; ?>" />
    <!--</form>
    <form id="frm_page" action="" style="display:none;" method="post">-->
    <input id="offset" name="offset" type="hidden" value="<?php echo $page_num; ?>" />
    <input id="category_id"  name="category" type="hidden" value="<?php echo $category; ?>" />
    <input id="search"  name="search_saved" type="hidden" value="<?php echo $search; ?>" />
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('.makesort').click(function () {
            var sort_by = $(this).attr('data-name');
            var sort_type = 'asc';
            if ($(this).hasClass('asc')) {
                sort_type = 'desc';
            }
            $('#sort_by').val(sort_by);
            $('#sort_type').val(sort_type);
            $('#frm_filter').submit();
        });
        $('.page').click(function () {
            var offset = $(this).attr('offset');
            var category_id = $(this).attr('category_id');
            $('#offset').val(offset);
            $('#category_id').val(category_id);
            $('#frm_filter').submit();
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
                    url: '<?php echo base_url(); ?>product/delete',
                    data: {product_id: arr},
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
