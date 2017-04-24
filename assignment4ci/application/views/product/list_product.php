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
                                        <?php }
                                    } else {
                                        ?>    
                                        <img src="<?php echo base_url(); ?>assets/images/default-image.jpg" style="width:80px; height:auto;" alt="Image NOT Available"><?php  }  ?></td>
                                    <td style="text-align:right"><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['cat_name'] ?></td>
                                    <td>
                                        <div class="buttons">
                                            <button class="btn btn_edit" onclick="del_func()">Delete</button>
                                            <a  class="btn btn_delete" href="<?php echo base_url(); ?>product/edit/<?php echo $row['prod_id'];?>">">Edit</a>
                                        </div>								
                                    </td>
                                </tr>
                                <?php
                          }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        <ul>
                            <li><a href="<?php echo base_url()?>/product/view/<?php echo $category; ?>/1">first</a></li>
                            <?php
                            /*
                             * Pagination is implemented using 'count' query
                             */
                            $i=0;
                            while($i<$pages){
                                $selected= false;
                                if(($i*LIMIT)==($offset)){
                                    $selected = true;
                                }
                                if(!$selected){
                                    $_url =  base_url()."product/view/".$category."/".($i+1); 
                                }else{
                                    $_url="javascript:void(0)";
                                }
                            ?>
                            <li><a href="<?php echo $_url; ?>" <?php if($selected){echo 'class="selected"';}?>><?php echo $i+1;?></a>
                                <?php
                         
                        $i++;
                            }
                                ?>
                            <li><a href="<?php echo base_url()."/product/view/".$category."/".$pages;?>">last</a></li>
                        </ul>
                    </div>

                </div>
            </div>		
        </div>
        <script type="text/javascript">
        <?php $success = $this->session->flashdata('success'); ?>
        <?php if (!empty($success)) {
            ?>
                alert('<?php echo $success; ?>');
            <?php }
        ?>
</script>
<script src="<?php echo base_url()?>assets/js/checkall.js" type="text/javascript"></script>
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
                    url: '<?php echo base_url();?>product/delete',
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
