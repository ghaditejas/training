<div class="section banner_section who_we_help">
    <div class="container">
        <h4>Edit Product</h4>
    </div>
</div>
<div class="section content_section">
    <div class="container">
        <div class="filable_form_container">
            <div class="form_container_block">
                <?php
                foreach ($list as $row) {
                    ?>
                    <form id="add_product" action="<?php echo base_url(); ?>product/add/<?php echo $row['id'] ?>" method="post" enctype="multipart/form-data" class="cmxform">
                        <ul>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Name</label>
                                    <input name="product_name" type="text" value="<?php echo $row['name'] ?>"> 
                                    <label class="error"><?php //echo $error_name;  ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Product Price</label>
                                    <input name="price" type="text" value = "<?php echo $row['price'] ?>"> 
                                    <label class="error"><?php //echo $error_price;  ?></label>
                                </div>
                            </li>
                            <li class="fileds">
                                <div class="upload_fileds">
                                    <label>Upload Image</label>
                                    <input name="upload" id="uploadFile" type="file" style="width:380px">
                                    <?php if (!empty($row['image']) && file_exists('./upload/' . $row['image'])) { ?>
                                        <img src="<?php echo base_url(); ?>upload/<?php echo $row['image']; ?>" style="width:80px; height:auto;" alt="Image NOT Available"><?php } ?>
                                    <label class="error"><?php //echo $error_ext;  ?></label>
                                </div>						
                            </li>
                            <li class="fileds">
                                <div class="name_fileds">
                                    <label>Select Category</label>
                                    <select name="category" class="category custom_dropdown required">
                                        <?php
                                        foreach ($cat as $row1) {
                                            ?>
                                            <option value="<?php echo $row1['id']; ?>"
                                            <?php
                                            if ($row['category'] == $row1['id']) {
                                                echo 'selected="selected"';
                                            }
                                            ?> >     
                                            <?php echo $row1['name']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <label class="error"><?php //echo $error_select;  ?></label>
                                </div>
                            </li>
                        </ul>
                        <div class="next_btn_block">
                            <div class="next_btn">
                                <input type="submit"value="Submit" class="btn-success"><img src="<?php echo base_url(); ?>assets/images/small_triangle.png" alt="small_triangle">
                                <input type="button" class="btn-danger" value="cancel" style="width:75px;height:36px;border:0px" onclick="javascript:window.location = 'list_product.php';"><img src="<?php echo base_url(); ?>assets/images/small_triangle.png" alt="small_triangle">
                            </div>
                        </div>
                    </form>
<?php } ?>
            </div>
        </div>
    </div>		
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/js/custom_validation.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/category_validation.js" type="text/javascript"></script>
